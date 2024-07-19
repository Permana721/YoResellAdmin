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
        'full_name',
        'username',
        'email',
        'password',
        'role',
        'phone',
        'created_at',
        'updated_at',
    ];
}
