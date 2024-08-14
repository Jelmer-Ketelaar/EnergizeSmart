<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EnergyUsage extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'timestamp',
        'energy_consumed',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getFormattedTimestampAttribute(): string
    {
        return \Carbon\Carbon::parse($this->timestamp)->format('M d, Y H:i');
    }
}
