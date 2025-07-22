<?php

namespace App\Filament\Resources\MembershipApprovalResource\Pages;

use App\Filament\Resources\MembershipApprovalResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Pages\Actions;

class ListMembershipApprovals extends ListRecords
{
    protected static string $resource = MembershipApprovalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // No create action needed for approvals
        ];
    }
} 