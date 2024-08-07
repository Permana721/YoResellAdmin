<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegionStore extends Model
{
    use HasFactory;
    protected $table = 'region_stores';
    public $timestamps = true;
    protected $fillable = [
        'region_id',
        'store_code',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
    ];

    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id');
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_code', 'store_code');
    }
}
