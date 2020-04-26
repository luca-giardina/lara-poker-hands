<?php

use Illuminate\Database\Seeder;

class PlayerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('players')->insert([
            'name' => 'Player 1',
            'created_at' => new DateTime,
        ]);

        DB::table('players')->insert([
            'name' => 'Player 2',
            'created_at' => new DateTime,
        ]);
    }
}
