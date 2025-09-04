<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{

public function run()
{
    // Création d'un utilisateur admin
    User::create([
        'name' => 'Josue',
        'email' => 'admin@example.com',
        'password' => Hash::make('8645'),
        'is_admin' => true
    ]);
}

}

