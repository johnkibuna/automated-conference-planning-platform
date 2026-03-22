<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $conference?->title ?? 'SummitAfrica' }}</title>

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
            background:
                radial-gradient(circle at top right, rgba(44, 177, 166, 0.16), transparent 28%),
                radial-gradient(circle at left center, rgba(15, 76, 129, 0.10), transparent 24%),
                linear-gradient(135deg, #ffffff 0%, #eef6fb 100%);
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

        .hero-energy {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 8px;
        }

        .hero-energy-chip {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 16px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.92);
            border: 1px solid rgba(15, 76, 129, 0.10);
            box-shadow: 0 10px 26px rgba(15, 76, 129, 0.08);
            color: var(--text-dark);
            font-weight: 600;
        }

        .hero-stage {
            position: relative;
        }

        .hero-carousel {
            overflow: hidden;
            border-radius: 24px;
            box-shadow: 0 20px 55px rgba(15, 76, 129, 0.16);
            border: 1px solid rgba(15, 76, 129, 0.08);
        }

        .hero-slide {
            position: relative;
            height: 440px;
        }

        .hero-slide::after {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(15, 76, 129, 0.10) 0%, rgba(15, 76, 129, 0.68) 100%);
        }

        .hero-slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .hero-slide-copy {
            position: absolute;
            left: 28px;
            right: 28px;
            bottom: 26px;
            z-index: 2;
            color: #fff;
        }

        .hero-slide-copy span {
            display: inline-block;
            padding: 8px 14px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.16);
            backdrop-filter: blur(8px);
            font-size: 0.85rem;
            font-weight: 700;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            margin-bottom: 12px;
        }

        .hero-slide-copy h4 {
            font-size: 1.7rem;
            font-weight: 800;
            margin-bottom: 8px;
        }

        .hero-slide-copy p {
            margin-bottom: 0;
            color: rgba(255, 255, 255, 0.88);
            line-height: 1.7;
        }

        .hero-float-chip {
            position: absolute;
            z-index: 3;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 14px 16px;
            border-radius: 18px;
            background: rgba(255, 255, 255, 0.94);
            color: var(--text-dark);
            box-shadow: 0 16px 34px rgba(15, 76, 129, 0.14);
            border: 1px solid rgba(15, 76, 129, 0.08);
            animation: floatY 6s ease-in-out infinite;
        }

        .hero-float-chip strong {
            display: block;
            font-size: 0.95rem;
        }

        .hero-float-chip small {
            display: block;
            color: var(--text-muted);
        }

        .hero-float-chip.one {
            top: -12px;
            right: 24px;
        }

        .hero-float-chip.two {
            left: -20px;
            bottom: 34px;
            animation-delay: 1.3s;
        }

        @keyframes floatY {
            0%, 100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
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
        .conference-card,
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
        .conference-card h5,
        .speaker-card h5,
        .schedule-card h5,
        .announcement-card h5 {
            font-weight: 700;
            margin-bottom: 12px;
        }

        .feature-card p,
        .conference-card p,
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

        .status-draft {
            background: rgba(108, 117, 125, 0.12);
            color: #6c757d;
        }

        .status-published {
            background: rgba(25, 135, 84, 0.12);
            color: #198754;
        }

        .status-closed {
            background: rgba(220, 53, 69, 0.12);
            color: #dc3545;
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

        .conference-card .meta-line {
            color: var(--text-muted);
            font-size: 0.95rem;
            margin-bottom: 10px;
        }

        .conference-card .meta-line:last-child {
            margin-bottom: 0;
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

            .hero-slide {
                height: 360px;
            }

            .hero-float-chip.two {
                left: 12px;
                bottom: 18px;
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

            .hero-slide,
            .hero-image,
            .section-image {
                height: 220px;
            }

            .hero-slide-copy {
                left: 18px;
                right: 18px;
                bottom: 18px;
            }

            .hero-slide-copy h4 {
                font-size: 1.3rem;
            }

            .hero-float-chip {
                position: static;
                margin-top: 14px;
                width: 100%;
                justify-content: center;
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
                <li class="nav-item"><a class="nav-link" href="#conferences">Conferences</a></li>
                <li class="nav-item"><a class="nav-link" href="#features">Features</a></li>
                <li class="nav-item"><a class="nav-link" href="#schedule">Schedule</a></li>
                <li class="nav-item"><a class="nav-link" href="#speakers">Speakers</a></li>
                <li class="nav-item"><a class="nav-link" href="#updates">Updates</a></li>
                <li class="nav-item ms-lg-2">
                    <a href="{{ $conference ? route('conferences.register', $conference) : '#conferences' }}" class="btn btn-primary-custom">Register</a>
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
                <span class="hero-badge">
                    {{ $conference ? 'Now spotlighting' : 'Fresh vibes for bold events' }}
                </span>
                <h1 class="hero-title mb-3">{{ $conference?->title ?? 'Big ideas, good people, and memorable conference energy.' }}</h1>
                <p class="hero-text mb-4">{{ $conference?->description ?? 'Discover vibrant events, inspiring speakers, and smooth schedules all in one place.' }}</p>
                <div class="hero-meta mb-4">
                    <div class="hero-meta-item"><i class="bi bi-geo-alt-fill me-2 text-primary"></i>{{ $conference?->venue ?? 'Venue will appear here' }}</div>
                    <div class="hero-meta-item"><i class="bi bi-calendar-event-fill me-2 text-primary"></i>{{ $conference?->start_datetime?->format('M d, Y h:i A') ?? 'Start date will appear here' }}</div>
                    <div class="hero-meta-item"><i class="bi bi-hourglass-split me-2 text-primary"></i>Registration closes: {{ $conference?->registration_deadline?->format('M d, Y') ?? 'Deadline will appear here' }}</div>
                </div>
                <div class="d-flex flex-column flex-md-row gap-3 mb-4">
                    <a href="{{ $conference ? route('conferences.register', $conference) : '#conferences' }}" class="btn btn-primary-custom">Register Now</a>
                    <a href="#schedule" class="btn btn-outline-custom">Catch the Lineup</a>
                </div>
                <div class="hero-energy">
                    <div class="hero-energy-chip">
                        <i class="bi bi-stars text-primary"></i>
                        <span>Good energy</span>
                    </div>
                    <div class="hero-energy-chip">
                        <i class="bi bi-people-fill text-primary"></i>
                        <span>{{ $conference?->speakers_count ?? $speakers->count() }} speakers in the mix</span>
                    </div>
                    <div class="hero-energy-chip">
                        <i class="bi bi-lightning-charge-fill text-primary"></i>
                        <span>{{ $conference?->sessions_count ?? $sessions->count() }} sessions to catch</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="hero-stage">
                    <div class="hero-float-chip one">
                        <i class="bi bi-mic-fill text-primary"></i>
                        <div>
                            <strong>{{ $conference?->speakers_count ?? $speakers->count() }} speaker{{ (($conference?->speakers_count ?? $speakers->count()) === 1) ? '' : 's' }}</strong>
                            <small>Fresh voices on stage</small>
                        </div>
                    </div>

                    <div id="heroCarousel" class="carousel slide hero-carousel" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div>

                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="hero-slide">
                                    <img src="{{ asset('images/hero_section.jpg') }}" alt="Crowd arriving at the conference">
                                    <div class="hero-slide-copy">
                                        <span>Arrive</span>
                                        <h4>Step into a conference that feels alive</h4>
                                        <p>From the first welcome to the last session, the vibe should feel smooth, modern, and exciting.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="hero-slide">
                                    <img src="{{ asset('images/speaker.jpg') }}" alt="Speaker moment">
                                    <div class="hero-slide-copy">
                                        <span>Listen</span>
                                        <h4>Meet voices worth paying attention to</h4>
                                        <p>Explore talks, connect with speakers, and catch ideas that stick with you after the event.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="hero-slide">
                                    <img src="{{ asset('images/updates.jpg') }}" alt="Audience and event moments">
                                    <div class="hero-slide-copy">
                                        <span>Move</span>
                                        <h4>Stay in the flow without missing a moment</h4>
                                        <p>Schedules, updates, and key moments stay easy to follow so the experience feels effortless.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="hero-float-chip two">
                        <i class="bi bi-calendar2-event-fill text-primary"></i>
                        <div>
                            <strong>{{ $conference?->start_datetime?->format('M d') ?? 'Coming soon' }}</strong>
                            <small>Save the date</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Conferences -->
<section class="section pt-0" id="conferences">
    <div class="container">
        <h2 class="section-title">Available Conferences</h2>
        <p class="section-subtitle">
            Pick the experience that fits your mood, your schedule, and the kind of crowd you want to be around.
        </p>

        <div class="row g-4">
            @if($conference)
                <div class="col-lg-6">
                    <div class="conference-card">
                        <span class="status-badge status-{{ $conference->status }}">{{ ucfirst($conference->status) }}</span>
                        <h5 class="mt-3">{{ $conference->title }}</h5>
                        <p class="mb-4">{{ $conference->description }}</p>
                        <div class="meta-line"><i class="bi bi-geo-alt-fill me-2 text-primary"></i>{{ $conference->venue }}</div>
                        <div class="meta-line"><i class="bi bi-calendar-event-fill me-2 text-primary"></i>{{ $conference->start_datetime?->format('M d, Y h:i A') }} to {{ $conference->end_datetime?->format('M d, Y h:i A') }}</div>
                        <div class="meta-line"><i class="bi bi-person-video3 me-2 text-primary"></i>{{ $conference->speakers_count ?? $speakers->count() }} speakers and {{ $conference->sessions_count ?? $sessions->count() }} sessions</div>
                        <div class="mt-4">
                            <a href="{{ route('conferences.register', $conference) }}" class="btn btn-primary-custom">Register for This Event</a>
                        </div>
                    </div>
                </div>
            @endif

            @forelse($otherConferences as $otherConference)
                <div class="col-lg-6">
                    <div class="conference-card">
                        <span class="status-badge status-{{ $otherConference->status }}">{{ ucfirst($otherConference->status) }}</span>
                        <h5 class="mt-3">{{ $otherConference->title }}</h5>
                        <p class="mb-4">{{ $otherConference->description }}</p>
                        <div class="meta-line"><i class="bi bi-geo-alt-fill me-2 text-primary"></i>{{ $otherConference->venue }}</div>
                        <div class="meta-line"><i class="bi bi-calendar-event-fill me-2 text-primary"></i>{{ $otherConference->start_datetime?->format('M d, Y h:i A') }}</div>
                        <div class="meta-line"><i class="bi bi-hourglass-split me-2 text-primary"></i>Registration deadline: {{ $otherConference->registration_deadline?->format('M d, Y') }}</div>
                        <div class="mt-4">
                            <a href="{{ route('conferences.register', $otherConference) }}" class="btn btn-primary-custom">Register for This Event</a>
                        </div>
                    </div>
                </div>
            @empty
                @unless($conference)
                    <div class="col-12">
                        <div class="conference-card text-center">
                            <h5>No conferences published yet</h5>
                            <p>Fresh conference experiences will appear here soon.</p>
                        </div>
                    </div>
                @endunless
            @endforelse
        </div>
    </div>
</section>

<!-- Features -->
<section class="section" id="features">
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
            <a href="{{ $conference ? route('conferences.register', $conference) : '#conferences' }}" class="btn btn-light btn-lg px-4 py-3 fw-semibold">
                Register Now
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
