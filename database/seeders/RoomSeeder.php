<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Room::query()->create([
            'name' => 'サンプル部',
            'login_id' => 'sample',
            'password' => Hash::make('password'),
            'is_admin' => true
        ]);
    }
}
