<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CreateAdminUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin Namarasa',
            'email' => 'admin@namarasa.com',
            'email_verified_at' => now(),
            'password' => bcrypt('admin123'), // Password: admin123
            'remember_token' => Str::random(10),
            'is_admin' => 1
        ]);
    }
}
