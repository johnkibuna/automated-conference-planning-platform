<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $announcement->title }}</title>
</head>
<body style="margin:0;background:#f3f8fc;font-family:Arial,sans-serif;color:#132238;">
<div style="max-width:640px;margin:0 auto;padding:32px 20px;">
    <div style="background:#ffffff;border:1px solid #dbe4ee;border-radius:24px;padding:32px;">
        <div style="display:inline-block;padding:8px 14px;border-radius:999px;background:#eef5ff;color:#0f4c81;font-weight:700;margin-bottom:18px;">
            Event update
        </div>

        <h1 style="margin:0 0 12px;font-size:28px;line-height:1.2;">{{ $announcement->title }}</h1>

        <p style="margin:0 0 18px;line-height:1.8;color:#51667d;">
            Hi {{ $registration->participant?->name }}, here is the latest update for {{ $announcement->conference->title }}.
        </p>

        <div style="padding:20px;border:1px solid #dbe4ee;border-radius:18px;background:#f7fbff;line-height:1.8;color:#24364a;margin-bottom:22px;">
            {{ $announcement->message }}
        </div>

        <div style="margin-bottom:24px;">
            <div style="margin-bottom:10px;"><strong>Venue:</strong> {{ $announcement->conference->venue }}</div>
            <div><strong>Starts:</strong> {{ $announcement->conference->start_datetime?->format('M d, Y h:i A') }}</div>
        </div>

        <a href="{{ route('conferences.portal.show', ['conference' => $registration->conference, 'registrationCode' => $registration->registration_code]) }}"
           style="display:inline-block;background:#0f4c81;color:#ffffff;text-decoration:none;padding:14px 22px;border-radius:14px;font-weight:700;">
            Open My Event
        </a>
    </div>
</div>
</body>
</html>
