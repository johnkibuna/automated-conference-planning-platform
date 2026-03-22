<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Speaker extends Model
{
    protected $fillable = [
        'conference_id',
        'name',
        'email',
        'bio',
    ];

    public function conference(): BelongsTo
    {
        return $this->belongsTo(Conference::class);
    }

    public function sessions(): HasMany
    {
        return $this->hasMany(Session::class);
    }
}
