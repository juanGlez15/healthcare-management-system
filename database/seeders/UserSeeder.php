<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\UserType;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener IDs de tipos de usuario
        $adminTypeId = UserType::where('name', 'admin')->first()->id;
        $doctorTypeId = UserType::where('name', 'doctor')->first()->id;
        $enfermeroTypeId = UserType::where('name', 'enfermero')->first()->id;
        $recepcionistaTypeId = UserType::where('name', 'recepcionista')->first()->id;
        $pacienteTypeId = UserType::where('name', 'paciente')->first()->id;

        // Crear usuario administrador
        User::create([
            'name' => 'Admin Principal',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
            'user_type_id' => $adminTypeId,
            'email_verified_at' => now(),
        ]);

        // Crear doctores
        $doctors = [
            [
                'name' => 'Dr. Juan Pérez',
                'email' => 'juan.perez@example.com',
                'password' => Hash::make('password123'),
                'user_type_id' => $doctorTypeId,
            ],
            [
                'name' => 'Dra. María González',
                'email' => 'maria.gonzalez@example.com',
                'password' => Hash::make('password123'),
                'user_type_id' => $doctorTypeId,
            ],
            [
                'name' => 'Dr. Carlos Rodríguez',
                'email' => 'carlos.rodriguez@example.com',
                'password' => Hash::make('password123'),
                'user_type_id' => $doctorTypeId,
            ],
        ];

        foreach ($doctors as $doctor) {
            User::create($doctor);
        }

        // Crear enfermeros
        $enfermeros = [
            [
                'name' => 'Enfermera Ana López',
                'email' => 'ana.lopez@example.com',
                'password' => Hash::make('password123'),
                'user_type_id' => $enfermeroTypeId,
            ],
            [
                'name' => 'Enfermero Roberto Díaz',
                'email' => 'roberto.diaz@example.com',
                'password' => Hash::make('password123'),
                'user_type_id' => $enfermeroTypeId,
            ],
        ];

        foreach ($enfermeros as $enfermero) {
            User::create($enfermero);
        }

        // Crear recepcionistas
        $recepcionistas = [
            [
                'name' => 'Laura Martínez',
                'email' => 'laura.martinez@example.com',
                'password' => Hash::make('password123'),
                'user_type_id' => $recepcionistaTypeId,
            ],
        ];

        foreach ($recepcionistas as $recepcionista) {
            User::create($recepcionista);
        }

        // Crear pacientes
        $pacientes = [
            [
                'name' => 'Pedro Sánchez',
                'email' => 'pedro.sanchez@example.com',
                'password' => Hash::make('password123'),
                'user_type_id' => $pacienteTypeId,
            ],
            [
                'name' => 'Lucía Fernández',
                'email' => 'lucia.fernandez@example.com',
                'password' => Hash::make('password123'),
                'user_type_id' => $pacienteTypeId,
            ],
            [
                'name' => 'Miguel Torres',
                'email' => 'miguel.torres@example.com',
                'password' => Hash::make('password123'),
                'user_type_id' => $pacienteTypeId,
            ],
            [
                'name' => 'Carmen Jiménez',
                'email' => 'carmen.jimenez@example.com',
                'password' => Hash::make('password123'),
                'user_type_id' => $pacienteTypeId,
            ],
            [
                'name' => 'Jorge Ruiz',
                'email' => 'jorge.ruiz@example.com',
                'password' => Hash::make('password123'),
                'user_type_id' => $pacienteTypeId,
            ],
        ];

        foreach ($pacientes as $paciente) {
            User::create($paciente);
        }
    }
}