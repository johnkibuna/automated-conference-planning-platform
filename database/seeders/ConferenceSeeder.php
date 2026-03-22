<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Conference;
use App\Models\Speaker;
use App\Models\Session;
use App\Models\Announcement;
use App\Models\ConferenceRegistrationField;

class ConferenceSeeder extends Seeder
{
    public function run(): void
    {
        $conference = Conference::create([
            'title' => 'AI Summit 2026',
            'description' => 'Annual conference on AI advancements.',
            'venue' => 'Tech Convention Center',
            'start_datetime' => now()->addDays(30),
            'end_datetime' => now()->addDays(32),
            'registration_deadline' => now()->addDays(25),
            'status' => 'published',
            'created_by' => 1,
        ]);

        ConferenceRegistrationField::create([
            'conference_id' => $conference->id,
            'label' => 'Full Name',
            'field_key' => 'full_name',
            'field_type' => 'text',
            'is_required' => true,
        ]);
        ConferenceRegistrationField::create([
            'conference_id' => $conference->id,
            'label' => 'Email',
            'field_key' => 'email',
            'field_type' => 'email',
            'is_required' => true,
        ]);

        $speaker = Speaker::create([
            'conference_id' => $conference->id,
            'name' => 'Dr. Jane Smith',
            'bio' => 'Expert in Machine Learning.',
        ]);

        $session = Session::create([
            'conference_id' => $conference->id,
            'speaker_id' => $speaker->id,
            'title' => 'Future of AI',
            'description' => 'Exploring upcoming trends in AI.',
            'start_time' => now()->addDays(30)->addHours(10),
            'end_time' => now()->addDays(30)->addHours(12),
        ]);

        Announcement::create([
            'conference_id' => $conference->id,
            'title' => 'Welcome!',
            'message' => 'We look forward to seeing you at the AI Summit 2026.',
        ]);
    }
}
