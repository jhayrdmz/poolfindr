<?php

namespace Database\Seeders;

use App\Models\Host;
use App\Models\Property;
use App\Models\User;
use Illuminate\Database\Seeder;

class TestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call(DatabaseSeeder::class);

        User::factory()->count(100)->create();
        Host::factory()->count(100)->create();

        Property::factory()->count(300)->create([
            'host_id' => Host::inRandomOrder()->first()
        ]);
    }
}
