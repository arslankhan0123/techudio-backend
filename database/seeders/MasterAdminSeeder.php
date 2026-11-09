<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MasterAdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => env('MASTER_ADMIN_EMAIL', 'admin@techudio.com')],
            [
                'name' => 'Master Admin',
                'role' => User::ROLE_MASTER_ADMIN,
                'password' => Hash::make(env('MASTER_ADMIN_PASSWORD', 'password')),
                'email_verified_at' => now(),
            ]
        );
    }
}
