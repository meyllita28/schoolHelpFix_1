<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            ['name' => 'Admin', 'email' => 'admin@schoolhelp.com', 'password' => bcrypt('admin'), 'level_user' => 'master_admin'],
        ];
        DB::table('users')->insert($user);
    }
}
