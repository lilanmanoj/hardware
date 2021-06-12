<?php

namespace App\Models\Stores;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpeningHour extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id',
        'day',
        'open_at',
        'close_at',
        'full_day_open',
        'full_day_close'
    ];

    protected $appends = [
        'picker_disabled'
    ];

    protected $visible = [
        'id',
        'day',
        'open_at',
        'close_at',
        'full_day_open',
        'full_day_close',
        'store',
        'picker_disabled'
    ];

    protected $casts = [
        'full_day_open' => 'boolean',
        'full_day_close' => 'boolean',
        'picker_disabled' => 'boolean',
        'open_at' => 'datetime',
        'close_at' => 'datetime'
    ];

    protected $searchable = [
        'columns' => [
            'opening_hours.day' => 10
        ]
    ];

    public function getPickerDisabledAttribute()
    {
        return $this->full_day_open || $this->full_day_close;
    }

    /**
     * Get the store that owns the opening_hours.
     */
    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
