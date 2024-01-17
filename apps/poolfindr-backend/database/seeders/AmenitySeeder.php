<?php

namespace Database\Seeders;

use App\Models\Amenity;
use Illuminate\Database\Seeder;

class AmenitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $amenities = [
            ['name' => 'Wifi'],
            ['name' => 'Air condition'],
            ['name' => 'Videoke'],
            ['name' => 'Kiddie pool'],
            ['name' => 'Jacuzzi'],
            ['name' => 'Billiard'],
            ['name' => 'Griller']
        ];

        foreach ($amenities as $key => $amenity) {
            Amenity::create(['name' => $amenity['name']]);
        }
    }
}
