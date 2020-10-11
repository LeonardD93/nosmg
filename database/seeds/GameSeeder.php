<?php

use Illuminate\Database\Seeder;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nostale = \App\Game::updateOrCreate([
            'name' => 'Nostale'
        ], [
            'description' => 'a game',
        ]);
        \App\Game::updateOrCreate([
            'name' => 'Dota 2'
        ], [
            'description' => 'Kinda ok',
        ]);

            $admin = \App\User::firstOrCreate([
                'email' => 'leonard77dam@yahoo.it',
            ], [
                'name' => 'Leonard',
                'password' => bcrypt('secret'), //non prende password
                'type' => 'admin',
            ]);
            $admin->players()->firstOrCreate([
                'name' => 'prova',
                'game_id' => $nostale->id,
            ], [
                'level' =>   1,
                'class' => 'mage',
            ]);
    }
}
