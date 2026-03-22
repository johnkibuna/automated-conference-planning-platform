<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration Confirmed</title>
</head>
<body style="margin:0;background:#f3f8fc;font-family:Arial,sans-serif;color:#132238;">
<div style="max-width:640px;margin:0 auto;padding:32px 20px;">
    <div style="background:#ffffff;border:1px solid #dbe4ee;border-radius:24px;padding:32px;">
        <div style="display:inline-block;padding:8px 14px;border-radius:999px;background:#e9f7f5;color:#198579;font-weight:700;margin-bottom:18px;">
            Registration confirmed
        </div>

        <h1 style="margin:0 0 12px;font-size:30px;line-height:1.2;">You are in for {{ $registration->conference->title }}</h1>

        <p style="margin:0 0 18px;line-height:1.8;color:#51667d;">
            Hi {{ $registration->participant?->name }}, your place is confirmed. Keep your registration code ready and use the button below to open your attendee page whenever you need your pass, updates, schedule, or materials.
        </p>

        <div style="padding:18px 20px;border:1px solid #dbe4ee;border-radius:18px;background:#f7fbff;margin-bottom:22px;">
            <div style="font-size:13px;color:#64748b;text-transform:uppercase;letter-spacing:0.08em;margin-bottom:8px;">Registration code</div>
            <div style="font-size:24px;font-weight:800;letter-spacing:0.06em;">{{ $registration->registration_code }}</div>
        </div>

        <div style="margin-bottom:24px;">
            <div style="margin-bottom:10px;"><strong>Venue:</strong> {{ $registration->conference->venue }}</div>
            <div><strong>Starts:</strong> {{ $registration->conference->start_datetime?->format('M d, Y h:i A') }}</div>
        </div>

        <a href="{{ route('conferences.portal.show', ['conference' => $registration->conference, 'registrationCode' => $registration->registration_code]) }}"
           style="display:inline-block;background:#0f4c81;color:#ffffff;text-decoration:none;padding:14px 22px;border-radius:14px;font-weight:700;">
            Open My Event
        </a>
    </div>
</div>
</body>
</html>
