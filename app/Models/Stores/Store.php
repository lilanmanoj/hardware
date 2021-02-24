<?php

namespace App\Models\Stores;

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
        'latitude',
        'longitude',
        'nic',
        'owner_name',
        'br_no',
        'credit_limit'
    ];

    protected $visible = [
        'id',
        'name',
        'address',
        'latitude',
        'longitude',
        'nic',
        'owner_name',
        'br_no',
        'credit_limit'
    ];

    protected $searchable = [
        'name',
        'address',
        'owner_name'
    ];
}
