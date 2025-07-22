<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaymentResource\Pages;
use App\Models\Payment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;

class PaymentResource extends Resource
{
    protected static ?string $model = Payment::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';
    
    protected static ?string $navigationLabel = 'Payments';
    
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Payment Information')
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->label('Member')
                            ->relationship('user', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        Forms\Components\Select::make('membership_id')
                            ->label('Membership')
                            ->relationship('membership', 'card_number')
                            ->searchable()
                            ->preload(),
                        Forms\Components\TextInput::make('amount')
                            ->label('Amount')
                            ->numeric()
                            ->prefix('UGX ')
                            ->required(),
                                                 Forms\Components\Select::make('payment_type')
                             ->label('Payment Type')
                             ->options([
                                 'registration' => 'Registration Fee',
                                 'monthly' => 'Monthly Fee',
                                 'renewal' => 'Renewal Fee',
                                 'late_fee' => 'Late Fee',
                             ])
                             ->required(),
                                                 Forms\Components\Select::make('status')
                             ->label('Status')
                             ->options([
                                 'pending' => 'Pending',
                                 'paid' => 'Paid',
                                 'overdue' => 'Overdue',
                                 'cancelled' => 'Cancelled',
                             ])
                             ->required(),
                        Forms\Components\TextInput::make('reference_number')
                            ->label('Reference Number')
                            ->disabled(),
                        Forms\Components\DateTimePicker::make('due_date')
                            ->label('Due Date'),
                                                 Forms\Components\DatePicker::make('payment_date')
                             ->label('Payment Date'),
                        Forms\Components\Textarea::make('notes')
                            ->label('Notes')
                            ->rows(3),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Member')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('reference_number')
                    ->label('Reference')
                    ->searchable(),
                Tables\Columns\TextColumn::make('amount')
                    ->label('Amount')
                    ->money('UGX')
                    ->sortable(),
                                 Tables\Columns\BadgeColumn::make('payment_type')
                     ->label('Type')
                     ->colors([
                         'primary' => 'registration',
                         'success' => 'monthly',
                         'warning' => 'renewal',
                         'info' => 'late_fee',
                     ]),
                                 Tables\Columns\BadgeColumn::make('status')
                     ->colors([
                         'warning' => 'pending',
                         'success' => 'paid',
                         'danger' => 'overdue',
                         'secondary' => 'cancelled',
                     ]),
                Tables\Columns\TextColumn::make('due_date')
                    ->label('Due Date')
                    ->date()
                    ->sortable(),
                                 Tables\Columns\TextColumn::make('payment_date')
                     ->label('Payment Date')
                     ->date()
                     ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                                 Tables\Filters\SelectFilter::make('status')
                     ->options([
                         'pending' => 'Pending',
                         'paid' => 'Paid',
                         'overdue' => 'Overdue',
                         'cancelled' => 'Cancelled',
                     ]),
                 Tables\Filters\SelectFilter::make('payment_type')
                     ->label('Type')
                     ->options([
                         'registration' => 'Registration',
                         'monthly' => 'Monthly',
                         'renewal' => 'Renewal',
                         'late_fee' => 'Late Fee',
                     ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Action::make('mark_paid')
                    ->label('Mark as Paid')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Mark Payment as Completed')
                    ->modalDescription('Are you sure you want to mark this payment as completed?')
                                         ->action(function (Payment $record) {
                         $record->update([
                             'status' => 'paid',
                             'payment_date' => now(),
                         ]);

                         // If this is a registration payment, activate the membership
                         if ($record->payment_type === 'registration' && $record->membership) {
                             $record->membership->update(['status' => 'active']);
                         }

                        Notification::make()
                            ->title('Payment Updated')
                            ->body('Payment has been marked as completed.')
                            ->success()
                            ->send();
                    })
                    ->visible(fn (Payment $record) => $record->status === 'pending'),
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
            'index' => Pages\ListPayments::route('/'),
            'create' => Pages\CreatePayment::route('/create'),
            'view' => Pages\ViewPayment::route('/{record}'),
            'edit' => Pages\EditPayment::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        $count = static::getModel()::where('status', 'pending')->count();
        return $count > 0 ? (string) $count : null;
    }
}
