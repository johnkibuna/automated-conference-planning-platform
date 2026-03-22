<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Confirmed | {{ $conference->title }}</title>
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
            padding: 52px 0;
        }

        .success-card,
        .detail-card {
            background: rgba(255, 255, 255, 0.96);
            border: 1px solid rgba(15, 76, 129, 0.08);
            border-radius: 28px;
            box-shadow: 0 22px 60px rgba(15, 76, 129, 0.10);
        }

        .success-card {
            padding: 34px;
            text-align: center;
        }

        .detail-card {
            padding: 28px;
        }

        .checkmark {
            width: 78px;
            height: 78px;
            margin: 0 auto 22px;
            border-radius: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(44, 177, 166, 0.14);
            color: var(--accent);
            font-size: 2rem;
        }

        .title {
            font-size: 2.3rem;
            font-weight: 800;
            margin-bottom: 12px;
        }

        .copy {
            color: var(--muted);
            line-height: 1.8;
            max-width: 560px;
            margin: 0 auto 28px;
        }

        .code-pill {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            border-radius: 999px;
            padding: 14px 18px;
            background: #f4f9ff;
            border: 1px solid var(--border);
            font-weight: 800;
            letter-spacing: 0.08em;
        }

        .qr-bundle {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 22px;
            flex-wrap: wrap;
            margin-bottom: 22px;
        }

        .qr-wrap {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 18px;
            border-radius: 24px;
            background: #fff;
            border: 1px solid var(--border);
            box-shadow: 0 16px 32px rgba(15, 76, 129, 0.08);
            margin-bottom: 18px;
        }

        .qr-wrap img,
        .qr-wrap svg {
            width: 220px;
            height: 220px;
        }

        @media (max-width: 767px) {
            .qr-bundle {
                flex-direction: column;
            }
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

        .btn-primary-custom {
            background: var(--primary);
            color: #fff;
            border-radius: 16px;
            padding: 14px 22px;
            font-weight: 700;
            border: 0;
        }

        .btn-outline-custom {
            border: 2px solid rgba(15, 76, 129, 0.18);
            color: var(--primary);
            border-radius: 16px;
            padding: 14px 22px;
            font-weight: 700;
            background: #fff;
        }

        .ticket-note {
            color: var(--muted);
            font-size: 0.98rem;
            margin-bottom: 24px;
        }

        @media print {
            body {
                background: #fff;
            }

            .page-shell {
                padding: 0;
            }

            .success-card,
            .detail-card {
                box-shadow: none;
                border-color: #d7e0eb;
            }

            .no-print {
                display: none !important;
            }
        }
    </style>
</head>
<body>
<div class="page-shell">
    <div class="container">
        <div class="row g-4 justify-content-center">
            <div class="col-lg-7">
                <div class="success-card">
                    <div class="checkmark">
                        <i class="bi bi-check2-circle"></i>
                    </div>

                    <h1 class="title">You’re in for {{ $conference->title }}</h1>
                    <p class="copy">
                        Your registration is confirmed. Keep this QR code and registration code ready when you arrive so check-in is quick and easy.
                    </p>

                    <div class="qr-bundle">
                        <div class="code-pill">
                            <i class="bi bi-ticket-detailed-fill text-primary"></i>
                            <span>{{ $registration->registration_code }}</span>
                        </div>

                        <div class="qr-wrap">
                            <img src="{{ $qrCodeDataUri }}" alt="Registration QR code">
                        </div>
                    </div>

                    <p class="copy mb-4">
                        Show this QR at the event entrance so the team can scan it and confirm your attendance.
                    </p>

                    <p class="ticket-note">
                        A confirmation email with your event pass has also been prepared for <strong>{{ $registration->participant?->email }}</strong>.
                    </p>

                    <div class="d-flex flex-column flex-md-row justify-content-center gap-3 no-print">
                        <a href="{{ route('conferences.portal.show', [$conference, $registration->registration_code]) }}" class="btn btn-primary-custom">
                            <i class="bi bi-grid-1x2-fill me-2"></i>Open My Event
                        </a>
                        <button type="button" class="btn btn-outline-custom" onclick="window.print()">
                            <i class="bi bi-printer me-2"></i>Print Event Pass
                        </button>
                        <a href="{{ route('home') }}" class="btn btn-outline-custom">Back to Home</a>
                        <a href="{{ route('conferences.register', $conference) }}" class="btn btn-outline-custom">Register Another Person</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="detail-card">
                    <h4 class="fw-bold mb-3">Registration details</h4>

                    <div class="detail-line">
                        <span>Conference</span>
                        <strong>{{ $conference->title }}</strong>
                    </div>
                    <div class="detail-line">
                        <span>Name</span>
                        <strong>{{ $registration->participant?->name }}</strong>
                    </div>
                    <div class="detail-line">
                        <span>Email</span>
                        <strong>{{ $registration->participant?->email }}</strong>
                    </div>
                    <div class="detail-line">
                        <span>Venue</span>
                        <strong>{{ $conference->venue }}</strong>
                    </div>
                    <div class="detail-line">
                        <span>Starts</span>
                        <strong>{{ $conference->start_datetime?->format('M d, Y h:i A') }}</strong>
                    </div>
                    <div class="detail-line">
                        <span>Status</span>
                        <strong>{{ ucfirst($registration->status) }}</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
