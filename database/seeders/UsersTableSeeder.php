<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $user = User::create([
            'name' => 'Admin User',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
        ]);

        $token = $user->createToken('Test Token')->plainTextToken;

        $this->command->info("Email: admin@admin.com");
        $this->command->info("Password: password");
        $this->command->info("API Token: " . $token);
    }

}

