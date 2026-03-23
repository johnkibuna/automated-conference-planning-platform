<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\AdminFocusWidget;
use App\Filament\Widgets\OperationsOverviewWidget;
use App\Filament\Widgets\RecentRegistrationsWidget;
use App\Filament\Widgets\UpcomingConferencesWidget;

class Dashboard extends \Filament\Pages\Dashboard
{
    public function getColumns(): int | array
    {
        return [
            'md' => 2,
            'xl' => 2,
        ];
    }

    public function getWidgets(): array
    {
        return [
            OperationsOverviewWidget::class,
            AdminFocusWidget::class,
            UpcomingConferencesWidget::class,
            RecentRegistrationsWidget::class,
        ];
    }
}
