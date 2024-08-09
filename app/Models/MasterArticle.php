<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterArticle extends Model
{
    use HasFactory;
    protected $table = 'master_article';
    public $timestamps = true;
    protected $fillable = [
        'article_code',
        'till_code',
        'article_desc',
        'art_type_system',
        'div',
        'div desc',
        'subcat',
        'subcat_desc',
        'cat',
        'cat_desc',
        'family',
        'sync_at',
    ];

    public function salesDetail()
    {
        return $this->hasMany(SalesDetail::class, 'plu', 'article_code');
    }
}
