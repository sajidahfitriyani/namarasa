<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Menu;
use App\Models\User;

class Cart extends Model
{
    protected $table = 'carts';
    protected $fillable = [
        'user_id',
        'menu_id',
        'quantity',
        'created_at',
        'updated_at'
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
