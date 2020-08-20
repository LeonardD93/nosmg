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
        \App\Game::updateOrCreate([
            'name' => 'Nostale'
        ], [
            'description' => 'Nostale besta game evah',
        ]);
        \App\Game::updateOrCreate([
            'name' => 'Dota 2'
        ], [
            'description' => 'Kinda ok',
        ]);
    }
}
