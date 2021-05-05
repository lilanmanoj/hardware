<?php

namespace App\Models\Areas;

use App\Models\Stores\Store;
use App\Models\Districts\District;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;
class Area extends Model
{
    use HasFactory;
    use SearchableTrait;

    protected $fillable = [
        'name',
        'district_id',
        'latitude',
        'longitude'
    ];

    protected $visible = [
        'id',
        'name',
        'latitude',
        'longitude',
        'district'
    ];

    protected $searchable = [
        'columns' => [
            'areas.name' => 10
        ]
    ];

    /**
     * Get the stores which in this area.
     */
    public function stores()
    {
        return $this->hasMany(Store::class);
    }

    /**
     * Get the district which the area belongs to.
     */
    public function district()
    {
        return $this->belongsTo(District::class);
    }
}
