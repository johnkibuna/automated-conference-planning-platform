<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Event | {{ $conference->title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #0f4c81;
            --primary-deep: #0b365b;
            --accent: #2cb1a6;
            --muted: #64748b;
            --border: #dbe4ee;
            --soft: #f7fbff;
        }

        body {
            font-family: 'Inter', sans-serif;
            background:
                radial-gradient(circle at top left, rgba(44, 177, 166, 0.12), transparent 24%),
                radial-gradient(circle at top right, rgba(15, 76, 129, 0.10), transparent 24%),
                linear-gradient(180deg, #f8fbff 0%, #eef5fb 100%);
            color: #132238;
        }

        .page-shell {
            min-height: 100vh;
            padding: 46px 0 68px;
        }

        .hero-card,
        .content-card {
            background: rgba(255, 255, 255, 0.96);
            border: 1px solid rgba(15, 76, 129, 0.08);
            border-radius: 30px;
            box-shadow: 0 24px 64px rgba(15, 76, 129, 0.10);
        }

        .hero-card {
            overflow: hidden;
            margin-bottom: 26px;
        }

        .hero-grid {
            display: grid;
            grid-template-columns: 1.35fr .9fr;
        }

        .hero-main {
            padding: 34px;
            background:
                radial-gradient(circle at top left, rgba(44, 177, 166, 0.22), transparent 36%),
                linear-gradient(135deg, #ffffff 0%, #f5fbff 100%);
        }

        .hero-side {
            padding: 34px;
            background: linear-gradient(160deg, var(--primary), var(--primary-deep));
            color: #fff;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 14px;
            border-radius: 999px;
            background: rgba(44, 177, 166, 0.12);
            color: var(--accent);
            font-size: .9rem;
            font-weight: 800;
            margin-bottom: 18px;
        }

        .hero-title {
            font-size: 2.4rem;
            font-weight: 800;
            margin-bottom: 14px;
        }

        .hero-copy,
        .side-copy,
        .section-copy,
        .meta-text {
            color: var(--muted);
            line-height: 1.8;
        }

        .side-copy {
            color: rgba(255, 255, 255, 0.82);
        }

        .meta-row {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin: 22px 0 26px;
        }

        .meta-chip,
        .status-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border-radius: 999px;
            padding: 11px 15px;
            font-weight: 700;
        }

        .meta-chip {
            background: var(--soft);
            border: 1px solid var(--border);
        }

        .status-pill {
            background: rgba(255, 255, 255, 0.14);
            color: #fff;
            margin-bottom: 18px;
        }

        .status-pill.ready {
            background: rgba(44, 177, 166, 0.18);
        }

        .status-pill.done {
            background: rgba(25, 135, 84, 0.18);
        }

        .portal-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        .btn-primary-custom,
        .btn-outline-custom,
        .btn-soft-custom {
            border-radius: 16px;
            padding: 14px 22px;
            font-weight: 700;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-primary-custom {
            background: var(--primary);
            color: #fff;
            border: 0;
        }

        .btn-outline-custom {
            background: #fff;
            color: var(--primary);
            border: 2px solid rgba(15, 76, 129, 0.18);
        }

        .btn-soft-custom {
            background: rgba(255, 255, 255, 0.12);
            color: #fff;
            border: 1px solid rgba(255, 255, 255, 0.16);
        }

        .pass-box {
            border-radius: 24px;
            padding: 22px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.12);
        }

        .code-pill {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            border-radius: 999px;
            padding: 14px 18px;
            background: rgba(255, 255, 255, 0.96);
            color: var(--primary);
            font-weight: 800;
            letter-spacing: 0.08em;
            margin-bottom: 18px;
        }

        .qr-wrap {
            display: inline-flex;
            padding: 16px;
            border-radius: 24px;
            background: #fff;
        }

        .qr-wrap img {
            width: 180px;
            height: 180px;
        }

        .section-block {
            margin-bottom: 24px;
        }

        .section-head {
            display: flex;
            justify-content: space-between;
            align-items: end;
            gap: 16px;
            margin-bottom: 16px;
        }

        .section-title {
            font-size: 1.35rem;
            font-weight: 800;
            margin-bottom: 4px;
        }

        .content-card {
            padding: 28px;
        }

        .announcement-card,
        .session-card {
            border-radius: 22px;
            border: 1px solid var(--border);
            background: #fff;
            padding: 22px;
            height: 100%;
        }

        .announcement-type {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            border-radius: 999px;
            background: rgba(15, 76, 129, 0.08);
            color: var(--primary);
            padding: 7px 12px;
            font-size: .88rem;
            font-weight: 700;
            margin-bottom: 12px;
        }

        .detail-list {
            display: grid;
            gap: 12px;
        }

        .detail-line {
            display: flex;
            justify-content: space-between;
            gap: 14px;
            padding-bottom: 12px;
            border-bottom: 1px solid rgba(15, 76, 129, 0.08);
        }

        .detail-line:last-child {
            border-bottom: 0;
            padding-bottom: 0;
        }

        .detail-line span {
            color: var(--muted);
        }

        .session-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin: 14px 0 16px;
        }

        .session-chip {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 12px;
            border-radius: 14px;
            background: var(--soft);
            border: 1px solid var(--border);
            font-size: .92rem;
            font-weight: 600;
        }

        .material-list {
            display: grid;
            gap: 12px;
            margin-top: 18px;
        }

        .material-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            border-radius: 18px;
            border: 1px solid var(--border);
            padding: 14px 16px;
            background: #fbfdff;
        }

        .material-copy h6 {
            margin-bottom: 4px;
            font-weight: 700;
        }

        .material-copy p {
            margin-bottom: 0;
            color: var(--muted);
            font-size: .94rem;
        }

        .empty-card {
            border-radius: 22px;
            border: 1px dashed rgba(15, 76, 129, 0.22);
            background: #fbfdff;
            padding: 24px;
        }

        @media (max-width: 991px) {
            .hero-grid {
                grid-template-columns: 1fr;
            }

            .hero-title {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
<div class="page-shell">
    <div class="container">
        <div class="hero-card">
            <div class="hero-grid">
                <div class="hero-main">
                    <div class="eyebrow">
                        <i class="bi bi-stars"></i>
                        <span>My Event</span>
                    </div>

                    <h1 class="hero-title">{{ $conference->title }}</h1>
                    <p class="hero-copy">
                        Everything for your event day is here in one place: your pass, latest updates, session schedule, materials, and any online join links for hybrid sessions.
                    </p>

                    <div class="meta-row">
                        <div class="meta-chip"><i class="bi bi-person-badge-fill text-primary"></i>{{ $registration->participant?->name }}</div>
                        <div class="meta-chip"><i class="bi bi-geo-alt-fill text-primary"></i>{{ $conference->venue }}</div>
                        <div class="meta-chip"><i class="bi bi-calendar-event-fill text-primary"></i>{{ $conference->start_datetime?->format('M d, Y h:i A') }}</div>
                        @if($isHybrid)
                            <div class="meta-chip"><i class="bi bi-broadcast-pin text-primary"></i>Hybrid access available</div>
                        @endif
                    </div>

                    <div class="portal-actions">
                        <a href="{{ route('conferences.registration.success', [$conference, $registration->registration_code]) }}" class="btn btn-primary-custom">
                            <i class="bi bi-ticket-detailed-fill"></i>Open Event Pass
                        </a>
                        <button type="button" class="btn btn-outline-custom" onclick="window.print()">
                            <i class="bi bi-printer"></i>Print My Pass
                        </button>
                        <a href="{{ route('home') }}" class="btn btn-outline-custom">
                            <i class="bi bi-house-door-fill"></i>Back Home
                        </a>
                    </div>
                </div>

                <div class="hero-side">
                    <span class="status-pill {{ $registration->checkin ? 'done' : 'ready' }}">
                        <i class="bi {{ $registration->checkin ? 'bi-check2-circle' : 'bi-qr-code-scan' }}"></i>
                        {{ $registration->checkin ? 'Attendance confirmed' : 'Ready for check-in' }}
                    </span>

                    <h3 class="fw-bold mb-3">Your access pass</h3>
                    <p class="side-copy mb-4">
                        Keep this code and QR close on your phone, or print them out if you prefer a paper pass.
                    </p>

                    <div class="pass-box">
                        <div class="code-pill">
                            <i class="bi bi-ticket-detailed-fill"></i>
                            <span>{{ $registration->registration_code }}</span>
                        </div>

                        <div class="qr-wrap">
                            <img src="{{ $qrCodeDataUri }}" alt="Event check-in QR code">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-4">
                <div class="content-card h-100">
                    <div class="section-block">
                        <div class="section-head">
                            <div>
                                <div class="section-title">Registration details</div>
                                <div class="section-copy">Your saved attendee info and current event status.</div>
                            </div>
                        </div>

                        <div class="detail-list">
                            <div class="detail-line">
                                <span>Name</span>
                                <strong>{{ $registration->participant?->name }}</strong>
                            </div>
                            <div class="detail-line">
                                <span>Email</span>
                                <strong>{{ $registration->participant?->email }}</strong>
                            </div>
                            <div class="detail-line">
                                <span>Status</span>
                                <strong>{{ ucfirst($registration->status) }}</strong>
                            </div>
                            <div class="detail-line">
                                <span>Check-in</span>
                                <strong>{{ $registration->checkin ? 'Completed' : 'Pending' }}</strong>
                            </div>
                        </div>
                    </div>

                    @if($registration->answers->isNotEmpty())
                        <div class="section-block mb-0">
                            <div class="section-head">
                                <div>
                                    <div class="section-title">Your submitted form</div>
                                    <div class="section-copy">The answers you used while registering.</div>
                                </div>
                            </div>

                            <div class="detail-list">
                                @foreach($registration->answers as $answer)
                                    <div class="detail-line">
                                        <span>{{ $answer->field?->label }}</span>
                                        <strong>{{ filled($answer->value) ? $answer->value : 'Not provided' }}</strong>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-lg-8">
                <div class="content-card mb-4">
                    <div class="section-head">
                        <div>
                            <div class="section-title">Announcements</div>
                            <div class="section-copy">Fresh updates from the event team, all in one place.</div>
                        </div>
                        <div class="meta-text">{{ $announcements->count() }} update{{ $announcements->count() === 1 ? '' : 's' }}</div>
                    </div>

                    <div class="row g-3">
                        @forelse($announcements as $announcement)
                            <div class="col-md-6">
                                <div class="announcement-card">
                                    <span class="announcement-type">
                                        <i class="bi bi-megaphone-fill"></i>{{ str($announcement->type)->replace('_', ' ')->title() }}
                                    </span>
                                    <h5 class="fw-bold">{{ $announcement->title }}</h5>
                                    <p class="meta-text mb-3">{{ $announcement->message }}</p>
                                    <div class="meta-text small">{{ $announcement->created_at?->format('M d, Y h:i A') }}</div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="empty-card">
                                    No announcements yet. When the event team posts updates, they will appear here.
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>

                @php
                    $materialsLibrary = $sessions->flatMap(function ($session) {
                        return $session->materials->map(function ($material) use ($session) {
                            return [
                                'material' => $material,
                                'session_title' => $session->title,
                            ];
                        });
                    });
                @endphp

                <div class="content-card mb-4">
                    <div class="section-head">
                        <div>
                            <div class="section-title">Materials library</div>
                        </div>
                        <div class="meta-text">{{ $materialsLibrary->count() }} item{{ $materialsLibrary->count() === 1 ? '' : 's' }}</div>
                    </div>

                    @if($materialsLibrary->isNotEmpty())
                        <div class="material-list mt-0">
                            @foreach($materialsLibrary as $entry)
                                <div class="material-item">
                                    <div class="material-copy">
                                        <h6>{{ $entry['material']->file_name }}</h6>
                                        <p>{{ $entry['session_title'] }} • {{ strtoupper($entry['material']->file_type) }}</p>
                                    </div>
                                    <a href="{{ route('conferences.portal.material', [$conference, $registration->registration_code, $entry['material']]) }}" class="btn btn-outline-custom">
                                        <i class="bi bi-download"></i>Open
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-card">
                            No session materials have been shared yet. As soon as the event team uploads them in admin, they will appear here.
                        </div>
                    @endif
                </div>

                <div class="content-card">
                    <div class="section-head">
                        <div>
                            <div class="section-title">Session schedule</div>
                            <div class="section-copy">Your agenda, session timing, materials, and hybrid join links.</div>
                        </div>
                        <div class="meta-text">{{ $sessions->count() }} session{{ $sessions->count() === 1 ? '' : 's' }}, {{ $materialsCount }} material{{ $materialsCount === 1 ? '' : 's' }}</div>
                    </div>

                    <div class="row g-3">
                        @forelse($sessions as $session)
                            <div class="col-12">
                                <div class="session-card">
                                    <div class="d-flex flex-column flex-lg-row justify-content-between gap-3">
                                        <div>
                                            <h4 class="fw-bold mb-2">{{ $session->title }}</h4>
                                            <p class="meta-text mb-0">{{ $session->description ?: 'Session details will appear here.' }}</p>
                                        </div>
                                        <div class="text-lg-end">
                                            <span class="announcement-type">
                                                <i class="bi bi-circle-fill small"></i>{{ str($session->status)->title() }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="session-meta">
                                        <div class="session-chip"><i class="bi bi-clock-fill text-primary"></i>{{ $session->start_time?->format('M d, h:i A') }} - {{ $session->end_time?->format('h:i A') }}</div>
                                        <div class="session-chip"><i class="bi bi-mic-fill text-primary"></i>{{ $session->speaker?->name ?? 'Speaker to be announced' }}</div>
                                        @if(filled($session->online_link))
                                            <div class="session-chip"><i class="bi bi-broadcast-pin text-primary"></i>Join online available</div>
                                        @endif
                                    </div>

                                    @if(filled($session->online_link))
                                        <div class="mb-3">
                                            <a href="{{ $session->online_link }}" target="_blank" rel="noopener noreferrer" class="btn btn-primary-custom">
                                                <i class="bi bi-camera-video-fill"></i>Join Online Session
                                            </a>
                                        </div>
                                    @endif

                                    @if($session->materials->isNotEmpty())
                                        <div class="material-list">
                                            @foreach($session->materials as $material)
                                                <div class="material-item">
                                                    <div class="material-copy">
                                                        <h6>{{ $material->file_name }}</h6>
                                                        <p>{{ strtoupper($material->file_type) }} file{{ $material->uploaded_at ? ' • Added ' . $material->uploaded_at->format('M d, Y') : '' }}</p>
                                                    </div>
                                                    <a href="{{ route('conferences.portal.material', [$conference, $registration->registration_code, $material]) }}" class="btn btn-outline-custom">
                                                        <i class="bi bi-download"></i>Open
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="empty-card mt-3">
                                            Materials for this session have not been uploaded yet.
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="empty-card">
                                    The schedule has not been published yet. Once sessions are added, they will appear here automatically.
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
