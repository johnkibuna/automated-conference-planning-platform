<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $conference->title ?? 'SummitAfrica' }}</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    <style>
        :root {
            --primary: #0F4C81;
            --accent: #2CB1A6;
            --bg-light: #F8FAFC;
            --text-dark: #1E293B;
            --text-muted: #64748B;
            --card-bg: #FFFFFF;
            --border-color: #E2E8F0;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-light);
            color: var(--text-dark);
        }

        .navbar {
            background: #fff;
            box-shadow: 0 2px 12px rgba(15, 76, 129, 0.08);
        }

        .navbar-brand {
            font-weight: 800;
            color: var(--primary) !important;
            font-size: 1.4rem;
        }

        .nav-link {
            color: var(--text-dark) !important;
            font-weight: 500;
        }

        .btn-primary-custom {
            background-color: var(--primary);
            border-color: var(--primary);
            color: #fff;
            border-radius: 10px;
            padding: 12px 24px;
            font-weight: 600;
        }

        .btn-primary-custom:hover {
            background-color: #0b3d68;
            border-color: #0b3d68;
            color: #fff;
        }

        .btn-outline-custom {
            border: 2px solid var(--primary);
            color: var(--primary);
            border-radius: 10px;
            padding: 12px 24px;
            font-weight: 600;
            background: transparent;
        }

        .btn-outline-custom:hover {
            background-color: var(--primary);
            color: #fff;
        }

        .hero {
            padding: 100px 0 70px;
            background: linear-gradient(135deg, #ffffff 0%, #eef6fb 100%);
        }

        .hero-badge {
            display: inline-block;
            background: rgba(44, 177, 166, 0.12);
            color: var(--accent);
            padding: 8px 14px;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 18px;
        }

        .hero-title {
            font-size: 3rem;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 18px;
        }

        .hero-text {
            color: var(--text-muted);
            font-size: 1.08rem;
            line-height: 1.8;
            max-width: 600px;
            margin-bottom: 28px;
        }

        .hero-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            margin-bottom: 28px;
        }

        .hero-meta-item {
            background: #fff;
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 0.95rem;
            font-weight: 500;
            color: var(--text-dark);
        }

        .hero-card {
            background: #fff;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 16px 40px rgba(15, 76, 129, 0.12);
            border: 1px solid rgba(15, 76, 129, 0.08);
        }

        .hero-stat {
            text-align: center;
            padding: 18px;
            border-radius: 16px;
            background: var(--bg-light);
        }

        .hero-stat h3 {
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--primary);
            margin-bottom: 6px;
        }

        .hero-stat p {
            margin-bottom: 0;
            color: var(--text-muted);
            font-size: 0.95rem;
        }

        .section {
            padding: 80px 0;
        }

        .section-title {
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 12px;
            text-align: center;
        }

        .section-subtitle {
            color: var(--text-muted);
            text-align: center;
            max-width: 700px;
            margin: 0 auto 50px;
            line-height: 1.7;
        }

        .feature-card,
        .speaker-card,
        .schedule-card,
        .announcement-card {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 18px;
            padding: 25px;
            box-shadow: 0 8px 24px rgba(15, 76, 129, 0.05);
            height: 100%;
        }

        .feature-icon {
            width: 56px;
            height: 56px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(15, 76, 129, 0.1);
            color: var(--primary);
            border-radius: 14px;
            font-size: 1.4rem;
            margin-bottom: 18px;
        }

        .feature-card h5,
        .speaker-card h5,
        .schedule-card h5,
        .announcement-card h5 {
            font-weight: 700;
            margin-bottom: 12px;
        }

        .feature-card p,
        .speaker-card p,
        .schedule-card p,
        .announcement-card p {
            color: var(--text-muted);
            margin-bottom: 0;
            line-height: 1.7;
        }

        .schedule-time {
            display: inline-block;
            background: rgba(44, 177, 166, 0.12);
            color: var(--accent);
            font-weight: 700;
            font-size: 0.9rem;
            padding: 8px 12px;
            border-radius: 10px;
            margin-bottom: 16px;
        }

        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 600;
            margin-top: 14px;
        }

        .status-scheduled {
            background: rgba(15, 76, 129, 0.1);
            color: var(--primary);
        }

        .status-delayed {
            background: rgba(255, 193, 7, 0.18);
            color: #9a6700;
        }

        .status-ongoing {
            background: rgba(25, 135, 84, 0.12);
            color: #198754;
        }

        .speaker-avatar {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 1.3rem;
            margin-bottom: 18px;
        }

        .announcement-card.warning {
            border-left: 5px solid #ffc107;
        }

        .announcement-card.info {
            border-left: 5px solid var(--primary);
        }

        .announcement-card.general {
            border-left: 5px solid var(--accent);
        }

        .cta-section {
            background: linear-gradient(135deg, var(--primary), #1363a1);
            color: #fff;
            border-radius: 24px;
            padding: 60px 30px;
            text-align: center;
        }

        .cta-section p {
            color: rgba(255, 255, 255, 0.88);
            max-width: 700px;
            margin: 0 auto 24px;
            line-height: 1.8;
        }

        .footer {
            background: #fff;
            border-top: 1px solid var(--border-color);
            padding: 30px 0;
            color: var(--text-muted);
        }

        .hero-image,
        .section-image {
            width: 100%;
            border-radius: 20px;
            object-fit: cover;
            box-shadow: 0 16px 40px rgba(15, 76, 129, 0.12);
            border: 1px solid rgba(15, 76, 129, 0.08);
            display: block;
        }

        .hero-image {
            width: 100%;
            height: 400px;
            object-fit: cover;
        }

        .section-image {
            height: 280px;
        }

        .image-card {
            background: #fff;
            border-radius: 20px;
            padding: 12px;
            box-shadow: 0 16px 40px rgba(15, 76, 129, 0.10);
            border: 1px solid rgba(15, 76, 129, 0.08);
            height: 100%;
        }

        .schedule-image-wrapper,
        .speaker-image-wrapper,
        .updates-image-wrapper {
            margin-bottom: 30px;
        }

        @media (max-width: 991px) {
            .hero-title {
                font-size: 2.3rem;
            }

            .hero {
                padding: 80px 0 50px;
            }
        }

        @media (max-width: 767px) {
            .hero-title {
                font-size: 2rem;
            }

            .hero-meta {
                flex-direction: column;
            }

            .btn-primary-custom,
            .btn-outline-custom {
                width: 100%;
                margin-bottom: 10px;
            }

            .hero-image,
            .section-image {
                height: 220px;
            }
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
        <a class="navbar-brand" href="#home">
            <i class="bi bi-calendar-event-fill me-2"></i>SummitAfrica
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
                <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#features">Features</a></li>
                <li class="nav-item"><a class="nav-link" href="#schedule">Schedule</a></li>
                <li class="nav-item"><a class="nav-link" href="#speakers">Speakers</a></li>
                <li class="nav-item"><a class="nav-link" href="#updates">Updates</a></li>
                <li class="nav-item ms-lg-2">
                    <a href="#" class="btn btn-primary-custom">Register</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Hero -->
<section class="hero" id="home">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-7">
                <span class="hero-badge">Smart Conference Management Platform</span>
                <h1 class="hero-title mb-3">{{ $conference->title ?? 'Annual Technology Conference 2026' }}</h1>
                <p class="hero-text mb-4">{{ $conference->description ?? 'A modern platform for conference registration, QR-code attendance tracking, session scheduling, speaker management, and real-time event updates.' }}</p>
                <div class="hero-meta mb-4">
                    <div class="hero-meta-item"><i class="bi bi-geo-alt-fill me-2 text-primary"></i>{{ $conference->venue ?? 'Nairobi Conference Centre' }}</div>
                    <div class="hero-meta-item"><i class="bi bi-calendar-event-fill me-2 text-primary"></i>{{ isset($conference) ? \Carbon\Carbon::parse($conference->start_datetime)->format('M d, Y h:i A') : 'Jul 15, 2026 09:00 AM' }}</div>
                    <div class="hero-meta-item"><i class="bi bi-hourglass-split me-2 text-primary"></i>Registration closes: {{ isset($conference) ? \Carbon\Carbon::parse($conference->registration_deadline)->format('M d, Y') : 'Jul 10, 2026' }}</div>
                </div>
                <div class="d-flex flex-column flex-md-row gap-3 mb-4">
                    <a href="#" class="btn btn-primary-custom">Register Now</a>
                    <a href="#schedule" class="btn btn-outline-custom">View Schedule</a>
                </div>
{{--                <div class="hero-card mt-4">--}}
{{--                    <h4 class="fw-bold mb-4">Conference Overview</h4>--}}
{{--                    <div class="row g-3 mb-3">--}}
{{--                        <div class="col-6"><div class="hero-stat"><p>Speakers</p></div></div>--}}
{{--                        <div class="col-6"><div class="hero-stat"><p>Sessions</p></div></div>--}}
{{--                        <div class="col-6"><div class="hero-stat"><p>Registrations</p></div></div>--}}
{{--                        <div class="col-6"><div class="hero-stat"><p>Updates</p></div></div>--}}
{{--                    </div>--}}
{{--                    <hr class="my-4">--}}
{{--                    <p class="mb-0 text-muted" style="line-height: 1.8;">Participants can register online, view the conference agenda, access speaker materials, and receive live event updates from one central platform.</p>--}}
{{--                </div>--}}
            </div>
            <div class="col-lg-5">
                <div class="image-card mb-4">
                    <img src="{{ asset('images/hero_section.jpg') }}" alt="Conference Hero Image" class="hero-image">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features -->
<section class="section">
    <div class="container">
        <h2 class="section-title">Why Use SummitAfrica?</h2>
        <p class="section-subtitle">
            The system simplifies conference management by combining registration, attendance tracking,
            speaker scheduling, and announcements in one place.
        </p>

        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-person-plus-fill"></i>
                    </div>
                    <h5>Easy Registration</h5>
                    <p>Participants can register online quickly using a simple and user-friendly registration form.</p>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-qr-code-scan"></i>
                    </div>
                    <h5>QR Check-In</h5>
                    <p>Attendees confirm their physical presence by scanning a QR code at the conference venue.</p>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-easel-fill"></i>
                    </div>
                    <h5>Speaker Sessions</h5>
                    <p>View the full session lineup, speaker order, and presentation details from the platform.</p>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-bell-fill"></i>
                    </div>
                    <h5>Live Updates</h5>
                    <p>Participants can see schedule changes, delays, and important announcements in real time.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Schedule -->
<section class="section pt-0" id="schedule">
    <div class="container">
        <h2 class="section-title">Conference Schedule</h2>
        <p class="section-subtitle">
            Browse the planned sessions and speaker lineup for the conference.
        </p>

        <div class="schedule-image-wrapper">
            <div class="image-card">
                <img src="{{ asset('images/schedule.jpg') }}" alt="Conference Schedule Image" class="section-image">
            </div>
        </div>

        <div class="row g-4">
            @forelse($sessions ?? [] as $session)
                <div class="col-md-6 col-lg-4">
                    <div class="schedule-card">
                        <span class="schedule-time">
                            {{ \Carbon\Carbon::parse($session->start_time)->format('h:i A') }}
                        </span>

                        <h5>{{ $session->title }}</h5>

                        <p class="mb-2">
                            {{ $session->description ?? 'Session details will be provided here.' }}
                        </p>

                        <small class="text-muted d-block mt-3">
                            <i class="bi bi-person-fill me-1"></i>
                            {{ $session->speaker->name ?? 'Speaker To Be Announced' }}
                        </small>

                        <span class="status-badge
                            @if(($session->status ?? '') === 'delayed') status-delayed
                            @elseif(($session->status ?? '') === 'ongoing') status-ongoing
                            @else status-scheduled
                            @endif">
                            {{ ucfirst($session->status ?? 'scheduled') }}
                        </span>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="schedule-card text-center">
                        <h5>No sessions added yet</h5>
                        <p>The conference schedule will appear here once sessions are created.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Speakers -->
<section class="section" id="speakers">
    <div class="container">
        <h2 class="section-title">Featured Speakers</h2>
        <p class="section-subtitle">
            Meet the professionals and presenters leading the conference sessions.
        </p>

        <div class="speaker-image-wrapper">
            <div class="image-card">
                <img src="{{ asset('images/speaker.jpg') }}" alt="Conference Speaker Image" class="section-image">
            </div>
        </div>

        <div class="row g-4">
            @forelse($speakers ?? [] as $speaker)
                <div class="col-md-6 col-lg-4">
                    <div class="speaker-card">
                        <div class="speaker-avatar">
                            {{ strtoupper(substr($speaker->name, 0, 1)) }}
                        </div>

                        <h5>{{ $speaker->name }}</h5>

                        <p class="mb-2">
                            {{ $speaker->title ?? 'Conference Speaker' }}
                        </p>

                        <small class="text-muted d-block mb-3">
                            <i class="bi bi-envelope-fill me-1"></i>
                            {{ $speaker->email ?? 'No email provided' }}
                        </small>

                        <p>
                            {{ $speaker->bio ?? 'Speaker profile information will appear here once added by the administrator.' }}
                        </p>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="speaker-card text-center">
                        <h5>No speakers available yet</h5>
                        <p>Speaker profiles will appear here once they are added to the system.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Updates -->
<section class="section pt-0" id="updates">
    <div class="container">
        <h2 class="section-title">Latest Updates</h2>
        <p class="section-subtitle">
            Stay informed about schedule changes, delays, and conference announcements.
        </p>

        <div class="updates-image-wrapper">
            <div class="image-card">
                <img src="{{ asset('images/updates.jpg') }}" alt="Conference Updates Image" class="section-image">
            </div>
        </div>

        <div class="row g-4">
            @forelse($announcements ?? [] as $announcement)
                <div class="col-md-6">
                    <div class="announcement-card {{ $announcement->type ?? 'general' }}">
                        <h5>{{ $announcement->title }}</h5>
                        <p>{{ $announcement->message }}</p>
                        <small class="text-muted d-block mt-3">
                            <i class="bi bi-clock-history me-1"></i>
                            {{ $announcement->created_at ? $announcement->created_at->format('M d, Y h:i A') : '' }}
                        </small>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="announcement-card general text-center">
                        <h5>No announcements yet</h5>
                        <p>Conference updates and important notices will be shown here.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- CTA -->
<section class="section">
    <div class="container">
        <div class="cta-section">
            <h2 class="fw-bold mb-3">Ready to Attend the Conference?</h2>
            <p>
                Register now to secure your spot, receive your QR code for attendance confirmation,
                and stay updated with the latest conference information.
            </p>
            <a href="#" class="btn btn-light btn-lg px-4 py-3 fw-semibold">
                Register for Conference
            </a>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="footer">
    <div class="container text-center">
        <p class="mb-1 fw-semibold text-dark">SummitAfrica</p>
        <p class="mb-1">Automated Conference Management System</p>
        <p class="mb-0">&copy; {{ now()->year }} All rights reserved.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>