<?php

namespace App\Models\Districts;

use App\Models\Stores\Store;
use App\Models\Areas\Area;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;
class District extends Model
{
    use HasFactory;
    use SearchableTrait;

    protected $fillable = [
        'name',
        'latitude',
        'longitude'
    ];

    protected $visible = [
        'id',
        'name',
        'latitude',
        'longitude'
    ];

    protected $searchable = [
        'columns' => [
            'districts.name' => 10
        ]
    ];

    /**
     * Get the stores which in this district.
     */
    public function stores()
    {
        return $this->hasMany(Store::class);
    }

    /**
     * Get the areas which in this district.
     */
    public function areas()
    {
        return $this->hasMany(Area::class);
    }
}
