<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DoctorProfile;
use Illuminate\Support\Facades\Validator;

class DoctorController extends Controller
{
    /**
     * Get all doctors with their profiles
     */
    public function index()
    {
        $doctors = User::with('userType', 'doctorProfile')
            ->whereHas('userType', function($query) {
                $query->where('name', 'doctor');
            })->get();
        
        return response()->json($doctors);
    }

    /**
     * Get a specific doctor by ID
     */
    public function show($id)
    {
        $doctor = User::with('userType', 'doctorProfile')
            ->whereHas('userType', function($query) {
                $query->where('name', 'doctor');
            })
            ->findOrFail($id);
        
        return response()->json($doctor);
    }

    /**
     * Update doctor profile
     */
    public function updateProfile(Request $request)
    {
        $user = $request->user();
        
        // Verificar si el usuario es un doctor
        if ($user->userType->name !== 'doctor') {
            return response()->json(['error' => 'Unauthorized. User is not a doctor'], 403);
        }
        
        $validator = Validator::make($request->all(), [
            'specialty' => 'sometimes|required|string',
            'license_number' => 'sometimes|required|string',
            'education' => 'sometimes|nullable|string',
            'experience_years' => 'sometimes|nullable|integer',
            'bio' => 'sometimes|nullable|string',
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        
        // Actualizar o crear perfil de doctor
        $doctorProfile = DoctorProfile::updateOrCreate(
            ['user_id' => $user->id],
            $validator->validated()
        );
        
        return response()->json([
            'message' => 'Doctor profile updated successfully',
            'profile' => $doctorProfile
        ]);
    }
}