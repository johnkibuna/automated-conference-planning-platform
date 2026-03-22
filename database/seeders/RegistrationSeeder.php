<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Registration;
use App\Models\Conference;
use App\Models\RegistrationAnswer;

class RegistrationSeeder extends Seeder
{
    public function run(): void
    {
        $conference = Conference::first();
        $registration = Registration::create([
            'conference_id' => $conference->id,
            'registration_code' => 'REG2026-001',
            'participant_name' => 'Alice Johnson',
            'participant_email' => 'alice.johnson@example.com',
            'confirmed' => true,
        ]);

        RegistrationAnswer::create([
            'registration_id' => $registration->id,
            'conference_registration_field_id' => $conference->registrationFields()->where('label', 'Full Name')->first()->id,
            'answer' => 'Alice Johnson',
        ]);
        RegistrationAnswer::create([
            'registration_id' => $registration->id,
            'conference_registration_field_id' => $conference->registrationFields()->where('label', 'Email')->first()->id,
            'answer' => 'alice.johnson@example.com',
        ]);
    }
}
