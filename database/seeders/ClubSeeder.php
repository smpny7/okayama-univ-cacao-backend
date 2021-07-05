<?php

namespace Database\Seeders;

use App\Models\Club;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ClubSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Club::query()->create([
            'name' => 'サンプル部',
            'login_id' => 'sample',
            'password' => Hash::make('password'),
        ]);
    }
}
