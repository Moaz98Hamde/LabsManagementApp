<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Lab;
use App\Device;
use App\Issue;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        DB::table('users')->insert([
        'name' => "user",
        'email' => "admin@test.com",
        'email_verified_at' => now(),
        'password' => Hash::make('secret'), // secret
        'img' => 'user_placeholder.png',
        'remember_token' => Str::random(10),
    ]);
        factory(App\User::class, 10)->create();

    }
}