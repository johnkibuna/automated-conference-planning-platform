<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ConferenceRegistrationField extends Model
{
    protected $fillable = [
        'conference_id',
        'field_key',
        'label',
        'field_type',
        'is_required',
        'options_json',
        'sort_order',
    ];

    protected $casts = [
        'is_required' => 'boolean',
        'options_json' => 'array',
    ];

    public function conference(): BelongsTo
    {
        return $this->belongsTo(Conference::class);
    }

    public function answers(): HasMany
    {
        return $this->hasMany(RegistrationAnswer::class, 'field_id');
    }
}
