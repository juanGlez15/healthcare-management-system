<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserType;
use App\Models\PatientProfile;

class PatientProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener tipo de usuario paciente
        $pacienteTypeId = UserType::where('name', 'paciente')->first()->id;
        
        // Obtener todos los usuarios pacientes
        $pacienteUsers = User::where('user_type_id', $pacienteTypeId)->get();
        
        // Tipos de sangre posibles
        $bloodTypes = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];
        
        // Géneros
        $genders = ['male', 'female', 'other'];
        
        // Posibles alergias
        $allergiesList = [
            'Ninguna',
            'Penicilina',
            'Aspirina',
            'Mariscos',
            'Nueces',
            'Polen',
            'Lactosa',
            'Gluten'
        ];
        
        // Crear perfiles para cada paciente
        foreach ($pacienteUsers as $pacienteUser) {
            // Generar fecha de nacimiento aleatoria (entre 18 y 85 años)
            $years = rand(18, 85);
            $dateOfBirth = now()->subYears($years)->subDays(rand(0, 365));
            
            // Seleccionar alergias aleatorias (0 a 3)
            $numAllergies = rand(0, 3);
            $selectedAllergies = [];
            
            for ($i = 0; $i < $numAllergies; $i++) {
                $alergia = $allergiesList[rand(1, count($allergiesList) - 1)]; // Evitar "Ninguna" si se seleccionan múltiples
                if (!in_array($alergia, $selectedAllergies)) {
                    $selectedAllergies[] = $alergia;
                }
            }
            
            if (count($selectedAllergies) == 0) {
                $selectedAllergies[] = 'Ninguna';
            }
            
            $allergiesString = implode(', ', $selectedAllergies);
            
            // Historia médica aleatoria
            $medicalHistories = [
                'Sin antecedentes médicos significativos',
                'Hipertensión controlada con medicación',
                'Diabetes tipo 2 diagnosticada hace ' . rand(1, 10) . ' años',
                'Cirugía de apendicitis en ' . (date('Y') - rand(1, 20)),
                'Asma desde la infancia',
                'Migrañas ocasionales',
                'Fractura de ' . ['brazo', 'pierna', 'muñeca', 'tobillo'][rand(0, 3)] . ' hace ' . rand(1, 15) . ' años',
                'Problemas de tiroides',
            ];
            
            PatientProfile::create([
                'user_id' => $pacienteUser->id,
                'date_of_birth' => $dateOfBirth,
                'gender' => $genders[rand(0, 2)],
                'blood_type' => $bloodTypes[rand(0, 7)],
                'allergies' => $allergiesString,
                'medical_history' => $medicalHistories[rand(0, 7)],
                'emergency_contact_name' => ['José Gómez', 'María López', 'Ana Martínez', 'Pedro Rodríguez'][rand(0, 3)],
                'emergency_contact_phone' => '6' . rand(10000000, 99999999),
            ]);
        }
    }
}