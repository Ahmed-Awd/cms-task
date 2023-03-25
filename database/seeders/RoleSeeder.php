<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run()
    {
        DB::table('roles')->insertOrIgnore([
            ['name' => 'admin','guard_name'=> 'web'],
            ['name' => 'operator','guard_name'=> 'web'],
        ]);
    }
}
