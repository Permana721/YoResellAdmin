<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleMenu extends Model
{
    use HasFactory;
    protected $table = 'role_menus';
    public $timestamps = true;
    protected $fillable = [
        'role_id',
        'menu_id',
        'c',
        'r',
        'u',
        'd',
        'created_at',
        'updated_at',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }

}
