<?php

namespace App\Http\Controllers;

use App\Models\DoctorSchedule;
use App\Models\Consultation;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DoctorController extends Controller
{

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

            $appointment = Consultation::where('id_konsultasi', $id)
                ->where('id_user_doctor', Auth::id())
                ->first();

            if (!$appointment) {
                return response()->json([
                    'message' => 'Consultation not found'
                ], 404);
            }

            $appointment->update(['status' => $request->status]);

            return response()->json([
                'message' => 'Consultation status updated successfully',
                'data' => $appointment
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Internal server error',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function addSchedule(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'tanggal' => 'required|date',
                'jam' => 'required|date_format:H:i:s',
                'status' => 'nullable|in:AVAILABLE,UNAVAILABLE'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 400);
            }

            $schedule = DoctorSchedule::create([
                'id_user' => Auth::id(),
                'tanggal' => $request->tanggal,
                'jam' => $request->jam,
                'status' => $request->status ?? 'AVAILABLE'
            ]);

            return response()->json([
                'message' => 'Schedule added successfully',
                'data' => $schedule
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Internal server error',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function updateSchedule(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'tanggal' => 'nullable|date',
                'jam' => 'nullable|date_format:H:i:s',
                'status' => 'nullable|in:AVAILABLE,UNAVAILABLE'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 400);
            }

            $schedule = DoctorSchedule::where('id_jadwal', $id)
                ->where('id_user', Auth::id())
                ->first();

            if (!$schedule) {
                return response()->json([
                    'message' => 'Schedule not found'
                ], 404);
            }

            $schedule->update($request->only(['tanggal', 'jam', 'status']));

            return response()->json([
                'message' => 'Schedule updated successfully',
                'data' => $schedule
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Internal server error',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function deleteSchedule($id)
    {
        try {
            $schedule = DoctorSchedule::where('id_jadwal', $id)
                ->where('id_user', Auth::id())
                ->first();

            if (!$schedule) {
                return response()->json([
                    'message' => 'Schedule not found'
                ], 404);
            }

            $schedule->delete();

            return response()->json([
                'message' => 'Schedule deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Internal server error',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function viewQueue()
    {
        try {
            $queues = Consultation::where('id_user_doctor', Auth::id())
                ->where('status', 'PENDING')
                ->get();

            return response()->json([
                'message' => 'Queue fetched successfully',
                'data' => $queues
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Internal server error',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function filterQueue(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'tanggal_kunjungan' => 'nullable|date',
                'jam_kunjungan' => 'nullable|date_format:H:i:s',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 400);
            }

            $queues = Consultation::where('id_user_doctor', Auth::id())
                ->when($request->tanggal_kunjungan, function ($query, $tanggal) {
                    $query->where('tanggal_kunjungan', $tanggal);
                })
                ->when($request->jam_kunjungan, function ($query, $jam) {
                    $query->where('jam_kunjungan', $jam);
                })
                ->get();

            return response()->json([
                'message' => 'Filtered queue fetched successfully',
                'data' => $queues
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Internal server error',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function updateProfile(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'aktif_praktek' => 'nullable|boolean',
                'lokasi_praktek' => 'nullable|string|max:255',
                'kontak' => 'nullable|string|max:100',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 400);
            }

            $doctor = User::where('id_user', '=', Auth::id())->first();

            if ($doctor->role !== 'DOCTOR') {
                return response()->json([
                    'message' => 'Unauthorized action'
                ], 403);
            }

            $doctor->update($request->only(['aktif_praktek', 'lokasi_praktek', 'kontak']));

            return response()->json([
                'message' => 'Profile updated successfully',
                'data' => $doctor
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Internal server error',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
