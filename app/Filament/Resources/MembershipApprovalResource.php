<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MembershipApprovalResource\Pages;
use App\Models\Membership;
use App\Models\Payment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class MembershipApprovalResource extends Resource
{
    protected static ?string $model = Membership::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';
    
    protected static ?string $navigationLabel = 'Membership Approvals';
    
    protected static ?string $modelLabel = 'Membership Approval';
    
    protected static ?string $pluralModelLabel = 'Membership Approvals';

    protected static ?int $navigationSort = 1;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('status', 'pending');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Member Information')
                    ->schema([
                        Forms\Components\TextInput::make('user.name')
                            ->label('Member Name')
                            ->disabled(),
                        Forms\Components\TextInput::make('user.email')
                            ->label('Email')
                            ->disabled(),
                        Forms\Components\TextInput::make('user.phone')
                            ->label('Phone')
                            ->disabled(),
                        Forms\Components\DatePicker::make('user.date_of_birth')
                            ->label('Date of Birth')
                            ->disabled(),
                    ])->columns(2),

                Forms\Components\Section::make('Membership Details')
                    ->schema([
                        Forms\Components\TextInput::make('package.name')
                            ->label('Package')
                            ->disabled(),
                        Forms\Components\TextInput::make('package.price')
                            ->label('Package Price')
                            ->prefix('UGX ')
                            ->disabled(),
                        Forms\Components\DatePicker::make('start_date')
                            ->disabled(),
                        Forms\Components\DatePicker::make('end_date')
                            ->disabled(),
                        Forms\Components\TextInput::make('card_number')
                            ->label('Card Number')
                            ->disabled(),
                    ])->columns(2),

                Forms\Components\Section::make('Payment Information')
                    ->schema([
                        Forms\Components\TextInput::make('registration_fee')
                            ->label('Registration Fee')
                            ->prefix('UGX ')
                            ->disabled(),
                        Forms\Components\TextInput::make('monthly_fee')
                            ->label('Monthly Fee')
                            ->prefix('UGX ')
                            ->disabled(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Member Name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.email')
                    ->label('Email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.phone')
                    ->label('Phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('package.name')
                    ->label('Package')
                    ->badge(),
                Tables\Columns\TextColumn::make('registration_fee')
                    ->label('Registration Fee')
                    ->money('UGX')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Applied Date')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'pending',
                    ]),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('package')
                    ->relationship('package', 'name'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Action::make('approve')
                    ->label('Approve')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Approve Membership')
                    ->modalDescription('Are you sure you want to approve this membership? This will activate the membership and generate the member card.')
                    ->action(function (Membership $record) {
                        try {
                            DB::beginTransaction();

                            // Update membership status
                            $record->update(['status' => 'active']);

                                                         // Update any pending payments to completed
                             Payment::where('membership_id', $record->id)
                                 ->where('status', 'pending')
                                 ->update(['status' => 'paid', 'payment_date' => now()]);

                            DB::commit();

                            Notification::make()
                                ->title('Membership Approved')
                                ->body("Membership for {$record->user->name} has been approved and activated.")
                                ->success()
                                ->send();

                        } catch (\Exception $e) {
                            DB::rollback();
                            Notification::make()
                                ->title('Error')
                                ->body('Failed to approve membership. Please try again.')
                                ->danger()
                                ->send();
                        }
                    }),
                Action::make('reject')
                    ->label('Reject')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalHeading('Reject Membership')
                    ->modalDescription('Are you sure you want to reject this membership? This action cannot be undone.')
                    ->action(function (Membership $record) {
                        try {
                            DB::beginTransaction();

                            // Update membership status
                            $record->update(['status' => 'cancelled']);

                            // Cancel any pending payments
                            Payment::where('membership_id', $record->id)
                                ->where('status', 'pending')
                                ->update(['status' => 'cancelled']);

                            DB::commit();

                            Notification::make()
                                ->title('Membership Rejected')
                                ->body("Membership for {$record->user->name} has been rejected.")
                                ->success()
                                ->send();

                        } catch (\Exception $e) {
                            DB::rollback();
                            Notification::make()
                                ->title('Error')
                                ->body('Failed to reject membership. Please try again.')
                                ->danger()
                                ->send();
                        }
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMembershipApprovals::route('/'),
            'view' => Pages\ViewMembershipApproval::route('/{record}'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', 'pending')->count();
    }
} 