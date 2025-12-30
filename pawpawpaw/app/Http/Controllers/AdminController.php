<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Consultation;
use App\Models\Reservation;
use App\Models\Specialization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function getPatients()
    {
        try {
            $patients = User::where('role', 'PATIENT')->get();

            return response()->json([
                'message' => 'Patients fetched successfully',
                'data' => $patients
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Internal server error',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getDoctors()
    {
        try {
            $doctors = User::where('role', 'DOCTOR')->get();

            return response()->json([
                'message' => 'Doctors fetched successfully',
                'data' => $doctors
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Internal server error',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function addDoctor(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nama' => 'required|string|max:100',
                'nik' => 'required|numeric|digits:16|unique:users,nik',
                'no_telp' => 'required|numeric|digits_between:10,15',
                'email' => 'required|string|email|max:100|unique:users,email',
                'password' => 'required|string|min:8',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 400);
            }

            $doctor = User::create([
                'nama' => $request->nama,
                'nik' => $request->nik,
                'no_telp' => $request->no_telp,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'DOCTOR',
            ]);

            return response()->json([
                'message' => 'Doctor added successfully',
                'data' => $doctor
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Internal server error',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function updateDoctor(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nama' => 'nullable|string|max:100',
                'no_telp' => 'nullable|numeric|digits_between:10,15',
                'email' => 'nullable|string|email|max:100|unique:users,email,' . $id . ',id_user',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 400);
            }

            $doctor = User::where('id_user', $id)->where('role', 'DOCTOR')->first();

            if (!$doctor) {
                return response()->json([
                    'message' => 'Doctor not found'
                ], 404);
            }

            $doctor->update($request->only(['nama', 'no_telp', 'email']));

            return response()->json([
                'message' => 'Doctor updated successfully',
                'data' => $doctor
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Internal server error',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteDoctor($id)
    {
        try {
            $doctor = User::where('id_user', $id)->where('role', 'DOCTOR')->first();

            if (!$doctor) {
                return response()->json([
                    'message' => 'Doctor not found'
                ], 404);
            }

            $doctor->delete();

            return response()->json([
                'message' => 'Doctor deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Internal server error',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getAppointments()
    {
        try {
            // Gunakan model Reservation dengan eager loading relasi
            $appointments = Reservation::with(['patient', 'doctor'])->get();

            return response()->json([
                'message' => 'Appointments fetched successfully',
                'data' => $appointments
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Internal server error',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getReservation($id)
    {
        try {
            $reservation = Reservation::with(['patient'])->find($id);

            return response()->json([
                'message' => 'Reservation fetched successfully',
                'data' => $reservation
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Internal server error',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function updateAppointmentStatus(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'status' => 'required|in:PENDING,COMPLETED,CANCELLED'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 400);
            }

            $appointment = Consultation::where('id_konsultasi', $id)->first();

            if (!$appointment) {
                return response()->json([
                    'message' => 'Appointment not found'
                ], 404);
            }

            $appointment->update(['status' => $request->status]);

            return response()->json([
                'message' => 'Appointment status updated successfully',
                'data' => $appointment
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Internal server error',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function viewQueues()
    {
        try {
            $queues = Consultation::with(['user', 'doctor'])->get();

            return response()->json([
                'message' => 'Queues fetched successfully',
                'data' => $queues
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Internal server error',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function editAppointments(Request $request, $id)
    {
        try {
            $reservation = Reservation::with(['patient'])->find($id);

            if (!$reservation) {
                return response()->json(['message' => 'Reservation not found'], 404);
            }

            $validatedData = $request->validate([
                'poli' => 'nullable|string|max:255',
                'tanggal_kunjungan' => 'nullable|date',
                'jam_kunjungan' => 'nullable|date_format:H:i',
            ]);

            $reservation->update($validatedData);

            return response()->json(['message' => 'Reservation updated successfully', 'reservation' => $reservation], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 200);
        }
    }

    public function deleteAppointments($id)
    {
        try {
            $queue = Reservation::find($id);

            if (!$queue) {
                return response()->json([
                    'message' => 'Queue not found'
                ], 404);
            }

            $queue->delete();

            return response()->json([
                'message' => 'Queue deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Internal server error',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
