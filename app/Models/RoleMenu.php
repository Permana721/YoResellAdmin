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

    // RoleMenu.php (model)
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id'); // Assuming 'role_id' is the foreign key
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id'); // Assuming 'menu_id' is the foreign key
    }

}
