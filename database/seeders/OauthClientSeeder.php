<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OauthClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('oauth_clients')->insert([
            'name' => 'sample',
            'secret' => 'q0TQSnghYYktXAogkclyeRSoQBhMJrtfbBTyLG4c',
            'provider' => 'rooms',
            'redirect' => 'http://localhost',
            'personal_access_client' => 0,
            'password_client' => 1,
            'revoked' => 0,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
