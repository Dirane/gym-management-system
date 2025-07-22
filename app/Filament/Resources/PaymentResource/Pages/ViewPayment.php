<?php

namespace App\Filament\Resources\PaymentResource\Pages;

use App\Filament\Resources\PaymentResource;
use Filament\Resources\Pages\ViewRecord;
use Filament\Pages\Actions;
use Filament\Pages\Actions\Action;
use Filament\Notifications\Notification;
use App\Models\Payment;

class ViewPayment extends ViewRecord
{
    protected static string $resource = PaymentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Action::make('mark_paid')
                ->label('Mark as Paid')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->requiresConfirmation()
                ->modalHeading('Mark Payment as Completed')
                ->modalDescription('Are you sure you want to mark this payment as completed?')
                ->action(function () {
                    $this->record->update([
                        'status' => 'paid',
                        'payment_date' => now(),
                    ]);

                    // If this is a registration payment, activate the membership
                    if ($this->record->payment_type === 'registration' && $this->record->membership) {
                        $this->record->membership->update(['status' => 'active']);
                    }

                    Notification::make()
                        ->title('Payment Updated')
                        ->body('Payment has been marked as completed.')
                        ->success()
                        ->send();
                })
                ->visible(fn () => $this->record->status === 'pending'),
        ];
    }
} 