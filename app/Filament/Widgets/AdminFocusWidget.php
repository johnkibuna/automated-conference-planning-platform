<?php

namespace App\Filament\Widgets;

use App\Models\Conference;
use App\Models\Registration;
use App\Models\Session;
use App\Models\Speaker;
use Filament\Widgets\Widget;

class AdminFocusWidget extends Widget
{
    protected string $view = 'filament.widgets.admin-focus-widget';

    protected int | string | array $columnSpan = 'full';

    protected function getViewData(): array
    {
        $conference = Conference::query()
            ->withCount(['registrations', 'checkins', 'sessions', 'announcements'])
            ->where('status', 'published')
            ->where('end_datetime', '>=', now())
            ->orderBy('start_datetime')
            ->first()
            ?? Conference::query()
                ->withCount(['registrations', 'checkins', 'sessions', 'announcements'])
                ->latest('start_datetime')
                ->first();

        $setupProgress = [
            'conferences' => Conference::query()->count() > 0,
            'sessions' => Session::query()->count() > 0,
            'speakers' => Speaker::query()->count() > 0,
            'registrations' => Registration::query()->count() > 0,
        ];

        $completedSetupSteps = collect($setupProgress)->filter()->count();

        return [
            'conference' => $conference,
            'checkinRate' => $conference && $conference->registrations_count > 0
                ? (int) round(($conference->checkins_count / $conference->registrations_count) * 100)
                : 0,
            'completedSetupSteps' => $completedSetupSteps,
            'totalSetupSteps' => count($setupProgress),
            'setupProgress' => $setupProgress,
        ];
    }
}
