<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        /**
         * Seeder user
         */
        $user = [
            'name' => 'Admin', 'email' => 'admin@schoolhelp.com', 'password' => Hash::make('admin'), 'level_user' => 'master_admin', 'username' => 'masteradmin'
        ];
        User::create($user);
    }
}
