<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Ejecutar seeders en orden para mantener las relaciones
        $this->call([
            UserTypeSeeder::class,
            UserSeeder::class,
            DoctorProfileSeeder::class,
            PatientProfileSeeder::class,
        ]);
    }
}