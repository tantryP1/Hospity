<?php

namespace App\Http\Controllers;

use App\Models\Specialization;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SpecializationController extends Controller
{
    public function assignSpecialization(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'id_specialization' => 'required|exists:specializations,id_specialization',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 400);
        }

        $doctor = User::find($id);

        if (!$doctor || $doctor->role !== 'DOCTOR') {
            return response()->json([
                'message' => 'User not found or is not a doctor'
            ], 404);
        }

        $doctor->update(['id_specialization' => $request->id_specialization]);

        return response()->json([
            'message' => 'Specialization assigned successfully',
            'data' => $doctor
        ], 200);
    }

    public function filterDoctorsBySpecialization($name)
    {
        try {
            $specialization = Specialization::with('doctors')->where('specialization_name', '=', $name)->first();

            if (!$specialization) {
                return response()->json(['message' => 'Specialization not found'], 404);
            }

            return response()->json([
                'message' => 'Doctors fetched successfully',
                'data' => $specialization->doctors
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Internal server error',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
