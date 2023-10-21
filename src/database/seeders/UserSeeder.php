<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
        [
            'name' => 'test-user',
            'email' => 'test@test.com',
            'password' => Hash::make('abcd1234'),
        ],
        [
            'name' => 'test2-user',
            'email' => 'test2@test2.com',
            'password' => Hash::make('abcd1234'),
        ]
    ]);
    }
}
