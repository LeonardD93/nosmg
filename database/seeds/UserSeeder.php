<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::updateOrCreate([
            'name' => 'Leonard'
        ], [
            'email' => 'leonard77dam@yahoo.it'
        ], [
            'password' => bcrypt('secret') //non prende password 
        ],[
            'type' => 'admin'
        ]);
    }
}
