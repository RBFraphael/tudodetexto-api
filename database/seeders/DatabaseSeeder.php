<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use App\Models\VipArea;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'first_name' => 'Tudo de Texto',
            'last_name' => 'Admin',
            'document_number' => '12345678901',
            'birthdate' => "1970-01-01",
            'email' => 'admin@tudodetexto.com.br',
            'email_verified_at' => now(),
            'phone' => '1112345678',
            'cellphone' => '11912345678',
            'password' => 'abcd1234',
            'role' => UserRole::ADMIN,
        ]);

        User::factory(25)->create();

        VipArea::factory()->create([
            'name' => "Área VIP Tabapuã"
        ]);
        VipArea::factory()->create([
            'name' => "Área VIP CNU"
        ]);
        VipArea::factory()->create([
            'name' => "Área VIP Alunos"
        ]);
    }
}
