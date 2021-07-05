<?php

namespace Database\Seeders;

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
        $this->call([
            ClubSeeder::class,
            OauthClientSeeder::class,
        ]);
    }
}
