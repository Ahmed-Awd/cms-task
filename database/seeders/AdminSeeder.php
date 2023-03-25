<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $user = User::create([
            'name' => 'admin',
            'username' => 'admin',
            'password' => '12345678',
        ]);
        $user->assignRole('admin');
    }
}
