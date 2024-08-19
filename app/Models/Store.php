<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;
    protected $table = 'stores';
    public $timestamps = true;
    protected $fillable = [
        'name',
        'store_code',
        'initial_store',
        'address',
        'city',
        'phone',
        'region_code',
        'created_at',
        'updated_at',
        'latitude',
        'longtitude',
        'createdAt',
        'updatedAt',
        'is_fnb',
        'is_fashion',
        'is_supermarket',
        'is_yogya_electronic',
        'is_food_court',
        'open_hour',
        'store_image1',
        'store_image2',
        'store_image3',
        'store_description',
        'is_active',
        'type_store',
        'sm',
    ];

    public function regionStores()
    {
        return $this->hasMany(RegionStore::class);
    }

    public function salesDetail()
    {
        return $this->hasMany(SalesDetail::class, 'store_code', 'store_code');
    }

}
