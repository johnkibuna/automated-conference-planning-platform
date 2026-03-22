<?php

namespace App\Http\Controllers;

use App\Models\Conference;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        $conference = $this->featuredConference();

        $sessions = $conference?->sessions()
            ->with('speaker')
            ->orderBy('start_time')
            ->get() ?? collect();

        $speakers = $conference?->speakers()
            ->orderBy('name')
            ->get() ?? collect();

        $announcements = $conference?->announcements()
            ->latest()
            ->get() ?? collect();

        $otherConferences = Conference::query()
            ->where('status', 'published')
            ->when($conference, fn ($query) => $query->whereKeyNot($conference->id))
            ->orderBy('start_datetime')
            ->take(3)
            ->get();

        return view('welcome', [
            'conference' => $conference,
            'sessions' => $sessions,
            'speakers' => $speakers,
            'announcements' => $announcements,
            'otherConferences' => $otherConferences,
            'stats' => $this->statsFor($conference, $sessions, $speakers, $announcements),
        ]);
    }

    private function featuredConference(): ?Conference
    {
        $query = Conference::query()
            ->withCount(['speakers', 'sessions', 'announcements', 'registrations'])
            ->where('status', 'published');

        return $query->where('end_datetime', '>=', now())
            ->orderBy('start_datetime')
            ->first()
            ?? $query->latest('start_datetime')->first()
            ?? Conference::query()
                ->withCount(['speakers', 'sessions', 'announcements', 'registrations'])
                ->latest('start_datetime')
                ->first();
    }

    private function statsFor(
        ?Conference $conference,
        Collection $sessions,
        Collection $speakers,
        Collection $announcements,
    ): array {
        return [
            [
                'label' => 'Speakers',
                'value' => $conference?->speakers_count ?? $speakers->count(),
            ],
            [
                'label' => 'Sessions',
                'value' => $conference?->sessions_count ?? $sessions->count(),
            ],
            [
                'label' => 'Registrations',
                'value' => $conference?->registrations_count ?? 0,
            ],
            [
                'label' => 'Updates',
                'value' => $conference?->announcements_count ?? $announcements->count(),
            ],
        ];
    }
}
