<?php

namespace App\Models\Stores;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $attributes = [
        'address_formatted' => ''
    ];

    protected $fillable = [
        'name',
        'address',
        'address_formatted',
        'latitude',
        'longitude',
        'fixed_no',
        'mobile_no',
        'fax_no',
        'email',
        'admin_id',
        'br_no'
    ];

    protected $visible = [
        'id',
        'name',
        'address',
        'address_formatted',
        'latitude',
        'longitude',
        'fixed_no',
        'mobile_no',
        'fax_no',
        'email',
        'br_no',
        'admin'
    ];

    protected $searchable = [
        'id',
        'name',
        'address',
        'email'
    ];

    /**
     * Get the admin that owns the store.
     */
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
