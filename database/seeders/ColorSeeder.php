<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Color;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Color::create(['name' => 'Red']);
        Color::create(['name' => 'Green']);
        Color::create(['name' => 'Blue']);
        Color::create(['name' => 'Yellow']);
    }
}
