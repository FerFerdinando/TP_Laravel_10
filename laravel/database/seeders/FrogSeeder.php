<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\model_frog;

class FrogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        model_frog::create([
            'name' => 'Kermit',
            'color' => 'Green',
            'age' => 2,
            'habitat' => 'Pond',
            'is_poisonous' => false,
            'description' => 'A friendly green frog',
            'weight' => 0.5
        ]);

        model_frog::create([
            'name' => 'Freddie',
            'color' => 'Brown',
            'age' => 3,
            'habitat' => 'Swamp',
            'is_poisonous' => true,
            'description' => 'A poisonous dart frog',
            'weight' => 0.2
        ]);

        model_frog::create([
            'name' => 'Ribbit',
            'color' => 'Yellow',
            'age' => 1,
            'habitat' => 'Forest',
            'is_poisonous' => false,
            'description' => 'A small yellow tree frog',
            'weight' => 0.3
        ]);

        model_frog::create([
            'name' => 'Jumpy',
            'color' => 'Blue',
            'age' => 4,
            'habitat' => 'River',
            'is_poisonous' => false,
            'description' => 'A rare blue frog',
            'weight' => 0.4
        ]);

        model_frog::create([
            'name' => 'Croaker',
            'color' => 'Red',
            'age' => 2,
            'habitat' => 'Jungle',
            'is_poisonous' => true,
            'description' => 'A bright red poison frog',
            'weight' => 0.25
        ]);
    }
}
