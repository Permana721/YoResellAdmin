<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;
    protected $table = 'cards';
    public $timestamps = true;
    protected $fillable = [
        'member_id',
        'number',
        'created_at',
        'updated_at',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id', 'id');
    }

    public function salesHeaders()
{
    return $this->hasMany(SalesHeader::class, 'number', 'number');
}
}
