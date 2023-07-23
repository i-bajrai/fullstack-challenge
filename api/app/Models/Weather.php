<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Weather extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'weather' => 'array',
        'main' => 'array',
        'wind' => 'array',
        'clouds' => 'array',
        'sys' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
