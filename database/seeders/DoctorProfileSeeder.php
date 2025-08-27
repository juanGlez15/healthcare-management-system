<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserType;
use App\Models\DoctorProfile;

class DoctorProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener tipo de usuario doctor
        $doctorTypeId = UserType::where('name', 'doctor')->first()->id;
        
        // Obtener todos los usuarios doctores
        $doctorUsers = User::where('user_type_id', $doctorTypeId)->get();
        
        // Datos de especialidades para asignar
        $specialties = [
            'Cardiología',
            'Dermatología',
            'Neurología',
            'Ginecología',
            'Pediatría',
            'Traumatología',
            'Oftalmología',
            'Oncología',
        ];
        
        // Crear perfiles para cada doctor
        foreach ($doctorUsers as $index => $doctorUser) {
            $specialtyIndex = $index % count($specialties);
            
            DoctorProfile::create([
                'user_id' => $doctorUser->id,
                'specialty' => $specialties[$specialtyIndex],
                'license_number' => 'MED' . rand(10000, 99999),
                'education' => 'Universidad ' . ['Nacional', 'Autónoma', 'Central', 'Estatal'][rand(0, 3)] . ' - ' . ['Medicina General', 'Especialidad Médica'][rand(0, 1)],
                'experience_years' => rand(2, 25),
                'bio' => 'Profesional médico con experiencia en atención de pacientes y procedimientos clínicos. Especializado en ' . $specialties[$specialtyIndex] . ' con enfoque en tratamientos modernos y atención centrada en el paciente.',
            ]);
        }
    }
}