<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesHeader extends Model
{
    use HasFactory;
    protected $table = 'sales_headers';
    public $timestamps = true;
    protected $fillable = [
        'member_no',
        'number',
        'tanggal',
        'store_code',
        'pos',
        'trans',
        'created_at',
        'file_name',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }

    public function card()
    {
        return $this->belongsTo(Card::class, 'number', 'number');
    }

    public function salesDetails()
    {
        return $this->hasMany(SalesDetail::class, 'trans', 'trans');
    }

}
