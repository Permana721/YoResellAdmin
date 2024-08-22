<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    protected $table = 'members';
    public $timestamps = true;
    protected $fillable = [
        'username',
        'password',
        'otp',
        'full_name',
        'address',
        'zipcode_id',
        'phone_1',
        'phone_2',
        'email',
        'nric_type_id',
        'nric',
        'store_code',
        'total_points',
        'total_undians',
        'registered_at',
        'first_logged_in_at',
        'question_1',
        'question_2',
        'answer1',
        'answer2',
        'is_blocked',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
        'favourite_stores',
        'store_site_code_sales',
        'password_md5',
        'total_tokens',
        'keterangan',
        'approve_cso',
        'approve_admin',
        'approve_cso_at',
        'approve_admin_at',
        'approve_cso_by',
        'approve_admin_by',
        'tokopedia',
        'shopee',
        'bukalapak',
        'lain-lain',
        'remember_token',
        'photo',
        'type_costumer',
        'brand',
    ];

    public function card()
    {
        return $this->hasOne(Card::class, 'member_id');
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_code', 'store_code');
    }

    public function salesDetails()
    {
        return $this->hasMany(SalesDetail::class, 'member_id');
    }

}
