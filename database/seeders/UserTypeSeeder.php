<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserType;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            [
                'name' => 'admin',
                'description' => 'Administrador del sistema'
            ],
            [
                'name' => 'doctor',
                'description' => 'Doctor o médico'
            ],
            [
                'name' => 'enfermero',
                'description' => 'Enfermero o asistente médico'
            ],
            [
                'name' => 'recepcionista',
                'description' => 'Recepcionista de la clínica'
            ],
            [
                'name' => 'paciente',
                'description' => 'Paciente del sistema'
            ],
        ];

        foreach ($types as $type) {
            UserType::create($type);
        }
    }
}