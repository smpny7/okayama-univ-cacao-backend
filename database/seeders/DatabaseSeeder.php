<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\Club;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Club::factory(20)->create();
        Activity::factory(1000)->create();
        $this->call([
            ClubSeeder::class,
            OauthClientSeeder::class,
        ]);
    }
}
