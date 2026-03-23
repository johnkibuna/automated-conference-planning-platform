<?php

namespace App\Filament\Widgets;

use App\Models\Checkin;
use App\Models\Conference;
use App\Models\NotificationLog;
use App\Models\Registration;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class OperationsOverviewWidget extends StatsOverviewWidget
{
    protected ?string $heading = 'Operations Overview';

    protected ?string $description = 'A quick read on what is live, what is coming up, and how attendee activity is moving.';

    protected int | string | array $columnSpan = 'full';

    protected function getStats(): array
    {
        $nextConference = Conference::query()
            ->where('status', 'published')
            ->where('end_datetime', '>=', now())
            ->orderBy('start_datetime')
            ->first();

        $publishedConferences = Conference::query()
            ->where('status', 'published')
            ->count();

        $totalRegistrations = Registration::query()->count();
        $checkinsToday = Checkin::query()->whereDate('checked_in_at', today())->count();
        $emailsSentThisWeek = NotificationLog::query()
            ->where('status', 'sent')
            ->whereBetween('sent_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->count();

        return [
            Stat::make('Published Conferences', number_format($publishedConferences))
                ->description($nextConference ? "Next: {$nextConference->title}" : 'Create and publish your first conference')
                ->descriptionIcon(Heroicon::OutlinedCalendarDays)
                ->color('primary')
                ->chart([3, 4, 4, 5, 6, 6, 7]),
            Stat::make('Registrations', number_format($totalRegistrations))
                ->description($nextConference ? "For {$nextConference->title} and the events after it" : 'Attendee records will appear here')
                ->descriptionIcon(Heroicon::OutlinedIdentification)
                ->color('success')
                ->chart([2, 3, 5, 7, 8, 10, 12]),
            Stat::make('Checked In Today', number_format($checkinsToday))
                ->description($checkinsToday > 0 ? 'Live attendance is being recorded' : 'No attendee has been checked in today yet')
                ->descriptionIcon(Heroicon::OutlinedQrCode)
                ->color('warning')
                ->chart([0, 1, 2, 4, 5, 7, 9]),
            Stat::make('Emails Sent This Week', number_format($emailsSentThisWeek))
                ->description('Registration confirmations and announcement updates')
                ->descriptionIcon(Heroicon::OutlinedPaperAirplane)
                ->color('info')
                ->chart([1, 2, 2, 3, 4, 6, 7]),
        ];
    }
}
