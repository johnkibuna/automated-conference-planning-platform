<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check-In Desk | {{ $conference->title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #0f4c81;
            --accent: #2cb1a6;
            --muted: #64748b;
            --border: #dbe4ee;
        }

        body {
            font-family: 'Inter', sans-serif;
            background:
                radial-gradient(circle at top left, rgba(44, 177, 166, 0.12), transparent 24%),
                linear-gradient(180deg, #f8fbff 0%, #eef5fb 100%);
            color: #132238;
        }

        .page-shell {
            min-height: 100vh;
            padding: 56px 0;
        }

        .desk-card,
        .result-card {
            background: rgba(255, 255, 255, 0.97);
            border: 1px solid rgba(15, 76, 129, 0.08);
            border-radius: 28px;
            box-shadow: 0 24px 64px rgba(15, 76, 129, 0.10);
        }

        .desk-card {
            padding: 34px;
            margin-bottom: 26px;
        }

        .result-card {
            padding: 22px;
            height: 100%;
        }

        .stat-chip {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 12px 16px;
            border-radius: 18px;
            background: #f4f9ff;
            border: 1px solid var(--border);
            font-weight: 700;
            margin: 0 12px 12px 0;
        }

        .hero-copy {
            color: var(--muted);
            line-height: 1.8;
            max-width: 760px;
        }

        .search-box {
            border-radius: 22px;
            padding: 22px;
            background: linear-gradient(135deg, #0f4c81, #1363a1);
            color: #fff;
        }

        .search-box p {
            color: rgba(255, 255, 255, 0.88);
            line-height: 1.7;
        }

        .search-field {
            border-radius: 16px;
            border: 0;
            padding: 14px 16px;
            min-height: 54px;
        }

        .btn-search,
        .btn-open,
        .btn-backend {
            border-radius: 16px;
            font-weight: 700;
            padding: 14px 20px;
            border: 0;
        }

        .btn-search,
        .btn-open {
            background: var(--accent);
            color: #fff;
        }

        .btn-backend {
            background: #fff;
            color: var(--primary);
            border: 2px solid rgba(15, 76, 129, 0.12);
        }

        .meta-line {
            color: var(--muted);
            margin-bottom: 6px;
        }

        .status-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border-radius: 999px;
            padding: 7px 12px;
            font-size: 0.9rem;
            font-weight: 700;
        }

        .status-pill.ready {
            background: rgba(44, 177, 166, 0.14);
            color: #198579;
        }

        .status-pill.done {
            background: rgba(25, 135, 84, 0.12);
            color: #198754;
        }
    </style>
</head>
<body>
<div class="page-shell">
    <div class="container">
        <div class="desk-card">
            <div class="d-flex flex-column flex-lg-row justify-content-between gap-4 mb-4">
                <div>
                    <div class="text-uppercase fw-bold text-primary small mb-2">Staff Check-In Desk</div>
                    <h1 class="fw-bold mb-3">{{ $conference->title }}</h1>
                </div>

                <div class="text-lg-end">
                    <div class="stat-chip"><i class="bi bi-people-fill text-primary"></i>{{ $conference->registrations_count }} registered</div>
                    <div class="stat-chip"><i class="bi bi-check2-square text-primary"></i>{{ $conference->checkins_count }} checked in</div>
                </div>
            </div>

            <div class="search-box">
                <div class="row g-3 align-items-end">
                    <div class="col-lg-8">
                        <label for="lookup" class="form-label fw-semibold">Find attendee</label>
                        <input
                            id="lookup"
                            name="lookup"
                            form="search-form"
                            type="text"
                            class="form-control search-field"
                            value="{{ $lookup }}"
                            placeholder="Search registration code, full name, or email">
                    </div>
                    <div class="col-lg-4 d-flex flex-column flex-md-row gap-3">
                        <form id="search-form" method="GET" action="{{ route('conferences.checkin.desk', $conference) }}" class="w-100">
                            <button type="submit" class="btn btn-search w-100">
                                <i class="bi bi-search me-2"></i>Find Attendee
                            </button>
                        </form>
                        <a href="/admin" class="btn btn-backend w-100 text-center">
                            <i class="bi bi-arrow-left-circle me-2"></i>Back to Admin
                        </a>
                    </div>
                </div>
            </div>
        </div>

        @php
            $cards = filled($lookup) ? $results : $recentRegistrations;
            $heading = filled($lookup) ? 'Search results' : 'Recent registrations';
        @endphp

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="fw-bold mb-0">{{ $heading }}</h3>
            @if(filled($lookup))
                <span class="text-muted">{{ $results->count() }} match{{ $results->count() === 1 ? '' : 'es' }}</span>
            @endif
        </div>

        <div class="row g-4">
            @forelse($cards as $registration)
                <div class="col-lg-6">
                    <div class="result-card">
                        <div class="d-flex justify-content-between align-items-start gap-3 mb-3">
                            <div>
                                <h4 class="fw-bold mb-1">{{ $registration->participant?->name }}</h4>
                                <div class="meta-line">{{ $registration->participant?->email }}</div>
                                <div class="meta-line">Code: {{ $registration->registration_code }}</div>
                            </div>

                            <span class="status-pill {{ $registration->checkin ? 'done' : 'ready' }}">
                                <i class="bi {{ $registration->checkin ? 'bi-check2-circle' : 'bi-qr-code-scan' }}"></i>
                                {{ $registration->checkin ? 'Checked in' : 'Ready' }}
                            </span>
                        </div>

                        <div class="meta-line"><strong>Registered:</strong> {{ $registration->created_at?->format('M d, Y h:i A') }}</div>
                        @if($registration->checkin)
                            <div class="meta-line"><strong>Checked in at:</strong> {{ $registration->checkin->checked_in_at?->format('M d, Y h:i A') }}</div>
                        @endif

                        <div class="mt-4">
                            <a href="{{ route('conferences.checkin.show', [$conference, $registration->registration_code]) }}" class="btn btn-open w-100">
                                {{ $registration->checkin ? 'View Check-In' : 'Open Check-In Screen' }}
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="result-card">
                        <h4 class="fw-bold mb-2">No attendees found yet</h4>
                        <p class="mb-0 text-muted">
                            @if(filled($lookup))
                                No one matched “{{ $lookup }}”. Try the registration code, the attendee’s name, or their email address.
                            @else
                                New registrations will appear here so the check-in team can open them quickly on event day.
                            @endif
                        </p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>
</body>
</html>
