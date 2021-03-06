<?php

namespace App\Models\Stores;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Store extends Model
{
    use HasFactory;
    use Searchable;

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
        'name',
        'address'
    ];

    public $asYouType = false;

    public function toSearchableArray()
    {
        $array = $this->searchable;

        return $array;
    }

    /**
     * Get the admin that owns the store.
     */
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
