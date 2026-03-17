<?php

namespace Database\Seeders;

use App\Enums\AudienceType;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SystemUsersSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->count(91)->create();

        User::create([
            'name' => 'Admin Principal',
            'email' => 'admin1@ueap.local',
            'cpf' => '00000000001',
            'audience' => null,
            'is_admin' => true,
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'Admin Secundário',
            'email' => 'admin2@ueap.local',
            'cpf' => '00000000002',
            'audience' => null,
            'is_admin' => true,
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);

        foreach (AudienceType::cases() as $index => $audience) {
            User::firstOrCreate(
                ['cpf' => '9999999990' . ($index + 1)],
                [
                    'name' => 'Usuário ' . $audience->label(),
                    'email' => 'audiencia' . ($index + 1) . '@ueap.local',
                    'audience' => $audience->value,
                    'is_admin' => false,
                    'email_verified_at' => now(),
                    'password' => Hash::make('password'),
                ]
            );
        }
    }
}
