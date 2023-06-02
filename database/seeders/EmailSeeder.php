<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EmailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('users')->delete();

        $name = 'Yousif';
        $email = 'yousifhakel50@gmail.com';
        $password = Hash::make('01004121711');

        User::create([
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ]);
    }
}
