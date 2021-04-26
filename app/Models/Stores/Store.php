<?php

namespace App\Models\Stores;

use App\Models\User;
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
        'creator'
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
}
