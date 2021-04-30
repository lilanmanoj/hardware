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

    protected $visible = [
        'id',
        'day',
        'open_at',
        'close_at',
        'full_day_open',
        'full_day_close',
        'store'
    ];

    protected $searchable = [
        'columns' => [
            'poening_hours.day' => 10
        ]
    ];

    /**
     * Get the store that owns the opening_hours.
     */
    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
