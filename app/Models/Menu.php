<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $table = 'menus';
    public $timestamps = true;
    protected $fillable = [
        'name',
        'group_name',
        'url',
        'icon',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
    ];

    public function roleMenus()
    {
        return $this->hasMany(RoleMenu::class); 
    }
}
