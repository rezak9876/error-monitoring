<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
                'name' => 'fullsana',
                'email' => 'rezakarimi376@gmail.com',
                'password' => Hash::make('1'),
            ]
        );

        User::first()->projects()->create([
            'title' => 'fullsana',
            'token' => 'a2918bf3b6d6867d96385add0a8cc5042f35a4e6',
        ]);
    }
}
