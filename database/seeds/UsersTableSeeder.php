<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Администратор',
            'email' => 'faxriddinqodirov077@gmail.com',
            'password' => bcrypt('faxriddin077'),
            'is_admin' => 1,
        ]);
    }
}
