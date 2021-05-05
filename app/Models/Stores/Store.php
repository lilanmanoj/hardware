<?php

namespace App\Models\Stores;

use App\Models\User;
use App\Models\Districts\District;
use App\Models\Areas\Area;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Store extends Model
{
    use HasFactory;
    use SearchableTrait;

    protected $attributes = [
        'address_formatted' => ''
    ];

    protected $fillable = [
        'code',
        'name',
        'description',
        'address',
        'address_formatted',
        'latitude',
        'longitude',
        'fixed_no',
        'mobile_no',
        'fax_no',
        'email',
        'admin_id',
        'br_no',
        'area_id',
        'district_id',
        'special_notes',
        'created_by',
        'status'
    ];

    protected $visible = [
        'id',
        'code',
        'name',
        'description',
        'address',
        'address_formatted',
        'latitude',
        'longitude',
        'fixed_no',
        'mobile_no',
        'fax_no',
        'email',
        'br_no',
        'special_notes',
        'status',
        'admin',
        'creator',
        'opening_hours',
        'district',
        'area'
    ];

    protected $searchable = [
        'columns' => [
            'stores.name' => 10,
            'stores.address' => 10,
            'stores.email' => 5
        ]
    ];

    /**
     * Get the admin that owns the store.
     */
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    /**
     * Get the created user that created the store.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the opening hours for the store.
     */
    public function openingHours()
    {
        return $this->hasMany(OpeningHour::class);
    }

    /**
     * Get the district that the store belongs to.
     */
    public function district()
    {
        return $this->belongsTo(District::class);
    }

    /**
     * Get the area that the store belongs to.
     */
    public function area()
    {
        return $this->belongsTo(Area::class);
    }
}
