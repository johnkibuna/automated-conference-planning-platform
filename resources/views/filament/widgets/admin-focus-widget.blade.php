<x-filament-widgets::widget>
    <style>
        .admin-focus-shell {
            display: grid;
            gap: 1.5rem;
        }

        @media (min-width: 1100px) {
            .admin-focus-shell {
                grid-template-columns: minmax(0, 1.35fr) minmax(320px, 0.9fr);
            }
        }

        .admin-focus-panel,
        .admin-focus-aside {
            border: 1px solid rgba(148, 163, 184, 0.25);
            border-radius: 1.5rem;
            background: #ffffff;
            box-shadow: 0 18px 48px rgba(15, 23, 42, 0.06);
            overflow: hidden;
        }

        .admin-focus-panel {
            background:
                radial-gradient(circle at top left, rgba(251, 191, 36, 0.16), transparent 32%),
                radial-gradient(circle at top right, rgba(14, 165, 233, 0.12), transparent 26%),
                linear-gradient(135deg, #fffdf6 0%, #ffffff 55%, #f8fbff 100%);
        }

        .admin-focus-inner,
        .admin-focus-aside-inner {
            padding: 1.5rem;
        }

        .admin-focus-eyebrow {
            display: inline-flex;
            align-items: center;
            padding: 0.45rem 0.8rem;
            border-radius: 999px;
            background: rgba(245, 158, 11, 0.14);
            color: #b45309;
            font-size: 0.85rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .admin-focus-title {
            font-size: 1.85rem;
            line-height: 1.2;
            font-weight: 800;
            color: #0f172a;
            margin: 0 0 0.6rem;
        }

        .admin-focus-meta,
        .admin-focus-copy,
        .admin-focus-note {
            color: #475569;
            line-height: 1.75;
        }

        .admin-focus-summary {
            display: grid;
            gap: 1rem;
            margin-top: 1.4rem;
        }

        @media (min-width: 900px) {
            .admin-focus-summary {
                grid-template-columns: minmax(0, 1fr) minmax(260px, 0.9fr);
                align-items: end;
            }
        }

        .admin-focus-stats {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 0.75rem;
        }

        .admin-focus-stat {
            border-radius: 1rem;
            border: 1px solid rgba(255, 255, 255, 0.8);
            background: rgba(255, 255, 255, 0.82);
            padding: 0.95rem 1rem;
        }

        .admin-focus-stat-label {
            color: #64748b;
            font-size: 0.84rem;
            margin-bottom: 0.2rem;
        }

        .admin-focus-stat-value {
            font-size: 1.35rem;
            font-weight: 800;
            color: #0f172a;
        }

        .admin-focus-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            margin-top: 1.4rem;
        }

        .admin-focus-action {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 46px;
            padding: 0.8rem 1rem;
            border-radius: 1rem;
            text-decoration: none;
            font-weight: 700;
            font-size: 0.94rem;
            transition: 160ms ease;
        }

        .admin-focus-action-primary {
            background: #f59e0b;
            color: #ffffff;
        }

        .admin-focus-action-primary:hover {
            background: #d97706;
        }

        .admin-focus-action-secondary {
            border: 1px solid rgba(148, 163, 184, 0.28);
            background: #ffffff;
            color: #334155;
        }

        .admin-focus-action-secondary:hover {
            border-color: rgba(245, 158, 11, 0.45);
            color: #b45309;
        }

        .admin-focus-aside-title {
            font-size: 1.25rem;
            font-weight: 800;
            color: #0f172a;
            margin: 0.15rem 0 0.5rem;
        }

        .admin-focus-kicker {
            color: #b45309;
            font-size: 0.8rem;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .admin-focus-progress {
            display: grid;
            gap: 0.75rem;
            margin-top: 1.2rem;
        }

        .admin-focus-progress-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            border: 1px solid rgba(148, 163, 184, 0.22);
            border-radius: 1rem;
            padding: 0.9rem 1rem;
            background: #ffffff;
        }

        .admin-focus-progress-label {
            color: #334155;
            font-weight: 600;
            text-transform: capitalize;
        }

        .admin-focus-progress-pill {
            display: inline-flex;
            align-items: center;
            padding: 0.38rem 0.7rem;
            border-radius: 999px;
            font-size: 0.78rem;
            font-weight: 700;
        }

        .admin-focus-progress-pill-ready {
            background: rgba(16, 185, 129, 0.12);
            color: #047857;
        }

        .admin-focus-progress-pill-pending {
            background: rgba(148, 163, 184, 0.12);
            color: #475569;
        }

        .admin-focus-note {
            margin-top: 1.2rem;
            padding: 1rem;
            border-radius: 1rem;
            background: #f8fafc;
        }
    </style>

    <div class="admin-focus-shell">
        <section class="admin-focus-panel">
            <div class="admin-focus-inner">
                <div class="admin-focus-eyebrow">Today's Focus</div>

                @if($conference)
                    <div class="admin-focus-summary">
                        <div>
                            <h2 class="admin-focus-title">{{ $conference->title }}</h2>
                            <p class="admin-focus-meta">{{ $conference->venue }} • {{ $conference->start_datetime?->format('M d, Y h:i A') }}</p>
                            <p class="admin-focus-copy">
                                Keep this event moving smoothly by watching registrations, pushing updates, and opening the check-in desk when attendees arrive.
                            </p>
                        </div>

                        <div class="admin-focus-stats">
                            <div class="admin-focus-stat">
                                <div class="admin-focus-stat-label">Registrations</div>
                                <div class="admin-focus-stat-value">{{ $conference->registrations_count }}</div>
                            </div>
                            <div class="admin-focus-stat">
                                <div class="admin-focus-stat-label">Check-ins</div>
                                <div class="admin-focus-stat-value">{{ $conference->checkins_count }}</div>
                            </div>
                            <div class="admin-focus-stat">
                                <div class="admin-focus-stat-label">Sessions</div>
                                <div class="admin-focus-stat-value">{{ $conference->sessions_count }}</div>
                            </div>
                            <div class="admin-focus-stat">
                                <div class="admin-focus-stat-label">Check-in rate</div>
                                <div class="admin-focus-stat-value">{{ $checkinRate }}%</div>
                            </div>
                        </div>
                    </div>

                    <div class="admin-focus-actions">
                        <a href="{{ route('conferences.checkin.desk', $conference) }}" target="_blank" rel="noopener noreferrer" class="admin-focus-action admin-focus-action-primary">
                            Open Check-In Desk
                        </a>
                        <a href="{{ route('filament.admin.resources.announcements.create') }}" class="admin-focus-action admin-focus-action-secondary">
                            Send an Update
                        </a>
                        <a href="{{ route('filament.admin.resources.conferences.edit', ['record' => $conference]) }}" class="admin-focus-action admin-focus-action-secondary">
                            Edit Conference
                        </a>
                        <a href="{{ route('filament.admin.resources.registrations.index') }}" class="admin-focus-action admin-focus-action-secondary">
                            View Registrations
                        </a>
                    </div>
                @else
                    <h2 class="admin-focus-title">Your dashboard is ready for the first event</h2>
                    <p class="admin-focus-copy">
                        Start by creating a conference, adding the registration form, then loading in sessions and speakers so the public pages and attendee portal have something real to show.
                    </p>

                    <div class="admin-focus-actions">
                        <a href="{{ route('filament.admin.resources.conferences.create') }}" class="admin-focus-action admin-focus-action-primary">
                            Create Conference
                        </a>
                        <a href="{{ route('filament.admin.resources.conference-registration-fields.index') }}" class="admin-focus-action admin-focus-action-secondary">
                            Build Registration Form
                        </a>
                    </div>
                @endif
            </div>
        </section>
    </div>
</x-filament-widgets::widget>
