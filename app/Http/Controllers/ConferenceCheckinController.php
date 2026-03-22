<?php

namespace App\Http\Controllers;

use App\Models\Checkin;
use App\Models\Conference;
use App\Models\Registration;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ConferenceCheckinController extends Controller
{
    public function desk(Request $request, Conference $conference): View
    {
        $this->authorizeStaffAccess();

        $conference->loadCount(['registrations', 'checkins']);

        $lookup = trim((string) $request->string('lookup'));
        $results = filled($lookup)
            ? $this->searchRegistrations($conference, $lookup)
            : collect();

        $recentRegistrations = Registration::query()
            ->with(['participant', 'checkin'])
            ->where('conference_id', $conference->id)
            ->latest()
            ->limit(8)
            ->get();

        return view('conferences.check-in-desk', [
            'conference' => $conference,
            'lookup' => $lookup,
            'results' => $results,
            'recentRegistrations' => $recentRegistrations,
        ]);
    }

    public function show(Conference $conference, string $registrationCode): View
    {
        $this->authorizeStaffAccess();

        $registration = $this->registration($conference, $registrationCode);

        return view('conferences.check-in', [
            'conference' => $conference,
            'registration' => $registration,
            'checkin' => $registration->checkin,
        ]);
    }

    public function store(Conference $conference, string $registrationCode): RedirectResponse
    {
        $this->authorizeStaffAccess();

        $registration = $this->registration($conference, $registrationCode);

        Checkin::updateOrCreate(
            ['registration_id' => $registration->id],
            [
                'conference_id' => $conference->id,
                'checked_in_at' => now(),
                'checked_in_by' => auth()->id() ?? $conference->created_by,
                'checkin_method' => 'qr',
            ],
        );

        return redirect()
            ->route('conferences.checkin.show', [$conference, $registrationCode])
            ->with('checkin_success', true);
    }

    private function searchRegistrations(Conference $conference, string $lookup): Collection
    {
        return Registration::query()
            ->with(['participant', 'checkin'])
            ->where('conference_id', $conference->id)
            ->where(function ($query) use ($lookup): void {
                $query
                    ->where('registration_code', 'like', "%{$lookup}%")
                    ->orWhereHas('participant', function ($participantQuery) use ($lookup): void {
                        $participantQuery
                            ->where('name', 'like', "%{$lookup}%")
                            ->orWhere('email', 'like', "%{$lookup}%");
                    });
            })
            ->latest()
            ->limit(12)
            ->get();
    }

    private function registration(Conference $conference, string $registrationCode): Registration
    {
        return Registration::query()
            ->with(['participant', 'checkin'])
            ->where('conference_id', $conference->id)
            ->where('registration_code', $registrationCode)
            ->firstOrFail();
    }

    private function authorizeStaffAccess(): void
    {
        abort_unless(auth()->check(), 403);
    }
}
