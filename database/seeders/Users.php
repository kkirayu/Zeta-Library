<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class Users extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user =
        [
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('zeta123'),
                'role' => 'admin'
            ],
            [
                'name' => 'Muhammad Danil',
                'email' => 'zeta@gmail.com',
                'password' => Hash::make('zeta123'),
                'role' => 'petugas'
            ],
            [
                'name' => 'Zeta',
                'email' => 'pmbucket@gmail.com',
                'password' => Hash::make('pm12345'),
                'role' => 'admin'
            ],
        ];
        foreach ($user as $user) {
            User::create($user);
        }
    }
}
