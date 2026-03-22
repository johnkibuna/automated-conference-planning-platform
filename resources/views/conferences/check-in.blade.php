<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check In | {{ $conference->title }}</title>
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
                radial-gradient(circle at top right, rgba(44, 177, 166, 0.12), transparent 24%),
                linear-gradient(180deg, #f8fbff 0%, #eef5fb 100%);
            color: #132238;
        }

        .page-shell {
            min-height: 100vh;
            padding: 56px 0;
        }

        .checkin-card {
            background: rgba(255, 255, 255, 0.97);
            border: 1px solid rgba(15, 76, 129, 0.08);
            border-radius: 30px;
            box-shadow: 0 24px 64px rgba(15, 76, 129, 0.10);
            padding: 34px;
        }

        .badge-soft {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 14px;
            border-radius: 999px;
            font-size: 0.9rem;
            font-weight: 700;
            margin-bottom: 18px;
        }

        .badge-soft.ready {
            background: rgba(44, 177, 166, 0.12);
            color: var(--accent);
        }

        .badge-soft.done {
            background: rgba(25, 135, 84, 0.12);
            color: #198754;
        }

        .title {
            font-size: 2.2rem;
            font-weight: 800;
            margin-bottom: 12px;
        }

        .copy {
            color: var(--muted);
            line-height: 1.8;
            max-width: 640px;
            margin-bottom: 26px;
        }

        .detail-card {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 24px;
            padding: 24px;
            height: 100%;
        }

        .detail-line {
            display: flex;
            justify-content: space-between;
            gap: 16px;
            padding: 14px 0;
            border-bottom: 1px solid rgba(15, 76, 129, 0.08);
        }

        .detail-line:last-child {
            border-bottom: 0;
            padding-bottom: 0;
        }

        .detail-line span {
            color: var(--muted);
        }

        .detail-line strong {
            text-align: right;
        }

        .event-box {
            border-radius: 24px;
            padding: 24px;
            background: linear-gradient(135deg, #0f4c81, #1363a1);
            color: #fff;
            height: 100%;
        }

        .event-box p {
            color: rgba(255, 255, 255, 0.88);
            line-height: 1.8;
        }

        .event-chip {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 14px;
            border-radius: 14px;
            background: rgba(255, 255, 255, 0.12);
            margin: 0 10px 12px 0;
        }

        .btn-checkin {
            background: var(--accent);
            color: #fff;
            border: 0;
            border-radius: 16px;
            padding: 14px 22px;
            font-weight: 800;
        }

        .btn-checkin:hover {
            background: #23998f;
            color: #fff;
        }

        .btn-home {
            border: 2px solid rgba(15, 76, 129, 0.18);
            color: var(--primary);
            border-radius: 16px;
            padding: 14px 22px;
            font-weight: 800;
            background: #fff;
        }
    </style>
</head>
<body>
<div class="page-shell">
    <div class="container">
        <div class="checkin-card">
            <span class="badge-soft {{ $checkin ? 'done' : 'ready' }}">
                <i class="bi {{ $checkin ? 'bi-check2-circle' : 'bi-qr-code-scan' }}"></i>
                {{ $checkin ? 'Already checked in' : 'Ready for QR check-in' }}
            </span>

            <h1 class="title">
                {{ $checkin ? 'Attendance already confirmed' : 'Confirm attendee check-in' }}
            </h1>

            <p class="copy">
                {{ $checkin
                    ? 'This registration has already been scanned and marked present for the event.'
                    : 'Review the attendee details below and confirm check-in to record attendance for this event.' }}
            </p>

            @if(session('checkin_success'))
                <div class="alert alert-success rounded-4 border-0 mb-4">
                    Check-in saved successfully.
                </div>
            @endif

            <div class="row g-4">
                <div class="col-lg-7">
                    <div class="detail-card">
                        <h4 class="fw-bold mb-3">Attendee details</h4>

                        <div class="detail-line">
                            <span>Name</span>
                            <strong>{{ $registration->participant?->name }}</strong>
                        </div>
                        <div class="detail-line">
                            <span>Email</span>
                            <strong>{{ $registration->participant?->email }}</strong>
                        </div>
                        <div class="detail-line">
                            <span>Registration code</span>
                            <strong>{{ $registration->registration_code }}</strong>
                        </div>
                        <div class="detail-line">
                            <span>Status</span>
                            <strong>{{ ucfirst($registration->status) }}</strong>
                        </div>
                        <div class="detail-line">
                            <span>Confirmed</span>
                            <strong>{{ $registration->confirmed ? 'Yes' : 'No' }}</strong>
                        </div>
                        @if($checkin)
                            <div class="detail-line">
                                <span>Checked in at</span>
                                <strong>{{ $checkin->checked_in_at?->format('M d, Y h:i A') }}</strong>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="event-box">
                        <h4 class="fw-bold mb-3">{{ $conference->title }}</h4>
                        <p class="mb-4">Use this page at the venue entrance to confirm the attendee is here and ready for the event. Only signed-in staff can use this check-in screen.</p>

                        <div class="event-chip"><i class="bi bi-geo-alt-fill"></i>{{ $conference->venue }}</div>
                        <div class="event-chip"><i class="bi bi-calendar-event-fill"></i>{{ $conference->start_datetime?->format('M d, Y h:i A') }}</div>

                        <div class="d-flex flex-column gap-3 mt-4">
                            @if(! $checkin)
                                <form method="POST" action="{{ route('conferences.checkin.store', [$conference, $registration->registration_code]) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-checkin w-100">
                                        Confirm Check-In
                                    </button>
                                </form>
                            @endif

                            <a href="{{ route('conferences.checkin.desk', $conference) }}" class="btn btn-home text-center">Back to Check-In Desk</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
