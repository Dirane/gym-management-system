<?php

namespace App\Filament\Resources\MembershipApprovalResource\Pages;

use App\Filament\Resources\MembershipApprovalResource;
use Filament\Resources\Pages\ViewRecord;
use Filament\Pages\Actions;
use Filament\Pages\Actions\Action;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\DB;
use App\Models\Payment;

class ViewMembershipApproval extends ViewRecord
{
    protected static string $resource = MembershipApprovalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('approve')
                ->label('Approve Membership')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->requiresConfirmation()
                ->modalHeading('Approve Membership')
                ->modalDescription('Are you sure you want to approve this membership? This will activate the membership and generate the member card.')
                ->action(function () {
                    try {
                        DB::beginTransaction();

                        // Update membership status
                        $this->record->update(['status' => 'active']);

                                                 // Update any pending payments to completed
                         Payment::where('membership_id', $this->record->id)
                             ->where('status', 'pending')
                             ->update(['status' => 'paid', 'payment_date' => now()]);

                        DB::commit();

                        Notification::make()
                            ->title('Membership Approved')
                            ->body("Membership for {$this->record->user->name} has been approved and activated.")
                            ->success()
                            ->send();

                        return redirect($this->getResource()::getUrl('index'));

                    } catch (\Exception $e) {
                        DB::rollback();
                        Notification::make()
                            ->title('Error')
                            ->body('Failed to approve membership. Please try again.')
                            ->danger()
                            ->send();
                    }
                })
                ->visible(fn () => $this->record->status === 'pending'),

            Action::make('reject')
                ->label('Reject Membership')
                ->icon('heroicon-o-x-circle')
                ->color('danger')
                ->requiresConfirmation()
                ->modalHeading('Reject Membership')
                ->modalDescription('Are you sure you want to reject this membership? This action cannot be undone.')
                ->action(function () {
                    try {
                        DB::beginTransaction();

                        // Update membership status
                        $this->record->update(['status' => 'cancelled']);

                        // Cancel any pending payments
                        Payment::where('membership_id', $this->record->id)
                            ->where('status', 'pending')
                            ->update(['status' => 'cancelled']);

                        DB::commit();

                        Notification::make()
                            ->title('Membership Rejected')
                            ->body("Membership for {$this->record->user->name} has been rejected.")
                            ->success()
                            ->send();

                        return redirect($this->getResource()::getUrl('index'));

                    } catch (\Exception $e) {
                        DB::rollback();
                        Notification::make()
                            ->title('Error')
                            ->body('Failed to reject membership. Please try again.')
                            ->danger()
                            ->send();
                    }
                })
                ->visible(fn () => $this->record->status === 'pending'),
        ];
    }
} 