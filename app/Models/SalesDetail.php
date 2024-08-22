<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesDetail extends Model
{
    use HasFactory;
    protected $table = 'sales_details';
    public $timestamps = true;
    protected $fillable = [
        'tanggal',
        'store_code',
        'pos',
        'trans',
        'plu',
        'description',
        'gross',
        'disc',
        'qty',
        'file_name',
        'created_at',
        'price',
        'sku',
        'sv',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_code', 'store_code');
    }

    public function masterArticle()
    {
        return $this->belongsTo(MasterArticle::class, 'plu', 'article_code');
    }

    public function salesHeader()
    {
        return $this->belongsTo(SalesHeader::class, 'store_code', 'store_code');
    }

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }

    public function salesHeaders()
    {
        return $this->belongsTo(SalesHeader::class, 'sales_header_id', 'id');
    }
}