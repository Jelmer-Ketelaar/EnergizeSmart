<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EnergyPrediction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'prediction_date',
        'predicted_value',
        'actual_value',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function usages(): HasMany
    {
        return $this->hasMany(EnergyUsage::class, 'user_id', 'user_id')
            ->whereDate('timestamp', $this->prediction_date);
    }

    public function calculateActualValue(): float
    {
        return $this->usages->sum('energy_consumed');
    }
}
