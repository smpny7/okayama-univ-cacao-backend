<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\Room;
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
        Room::factory(20)->create();
        Activity::factory(1000)->create();
        $this->call([
            RoomSeeder::class,
            OauthClientSeeder::class,
        ]);
    }
}
