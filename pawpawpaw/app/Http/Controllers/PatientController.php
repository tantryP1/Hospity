<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\DoctorSchedule;
use App\Models\Consultation;
use App\Models\Feedback;
use App\Models\Notification;
use App\Models\Reservation;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Log;

class PatientController extends Controller
{

    public function getDoctors()
    {
        try {
            $doctors = User::where('role', 'DOCTOR')
                ->with('specializations')
                ->get();

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


    public function getDoctorSchedule($id)
    {
        try {
            $doctor = User::where('role', 'DOCTOR')
                ->where('id_user', '=', $id)
                ->with('specializations')
                ->with('doctorSchedules')
                ->first();


            if (!isset($doctor)) {
                return response()->json([
                    'message' => 'Doctor not found'
                ], 404);
            }

            return response()->json([
                'message' => 'Doctor fetched successfully',
                'data' => $doctor
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Internal server error',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function createAppointment(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'doctor_id' => 'required|exists:users,id_user',
                'date' => 'required|date',
                'time' => 'required|date_format:H:i'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 400);
            }

            $appointment = Consultation::create([
                'id_user_patient' => Auth::id(),
                'id_user_doctor' => $request->doctor_id,
                'status' => 'PENDING',
                'date' => $request->date,
                'time' => $request->time
            ]); 

            return response()->json([
                'message' => 'Appointment created successfully',
                'data' => $appointment
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Internal server error',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // Fungsi untuk mengambil data janji temu tanpa response JSON
    // private function fetchAppointment($id)
    // {
    //     return Consultation::where('id_konsultasi', $id)
    //         ->where('id_user_patient', Auth::id())
    //         ->first();
    // }

    public function getAppointment($id)
    {
        try {
            $appointment = Consultation::with('doctor', 'patient')->where('id_konsultasi', $id)
                ->where('id_user_patient', Auth::id())
                ->first();

            if (!$appointment) {
                return response()->json([
                    'message' => 'Appointment not found'
                ], 404);
            }

            return response()->json([
                'message' => 'Appointment fetched successfully',
                'data' => $appointment
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Internal server error',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // public function showDetail($appointmentId)
    // {
    //     $appointment = $this->fetchAppointment($appointmentId);

    //     // Periksa apakah data ditemukan
    //     if ($appointment) {
    //         return view('detail', ['appointment' => $appointment]);
    //     }

    //     // Jika data tidak ditemukan
    //     return view('detail', ['error' => 'Janji temu tidak ditemukan.']);
    // }

    public function getAppointments()
    {
        try {
            $appointments = Consultation::where('id_user_patient', Auth::id())->get();

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


    public function submitReview(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'doctor_id' => 'required|exists:users,id_user',
                'rating' => 'required|integer|between:1,5',
                'comment' => 'nullable|string|max:200'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 400);
            }

            $review = Review::create([
                'id_user_patient' => Auth::id(),
                'id_user_doctor' => $request->doctor_id,
                'rating' => $request->rating,
                'komentar' => $request->comment,
                'tanggal_review' => now()
            ]);

            return response()->json([
                'message' => 'Review submitted successfully',
                'data' => $review
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Internal server error',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function getDoctorReviews($doctorId)
    {
        try {
            $reviews = Review::where('id_user_doctor', $doctorId)->get();

            return response()->json([
                'message' => 'Reviews fetched successfully',
                'data' => $reviews
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Internal server error',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function createReservation(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'id_doctor' => 'required|exists:users,id_user',
                'poli' => 'required|string',
                'tanggal_kunjungan' => 'required|date',
                'jam_kunjungan' => 'required|date_format:H:i:s',
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 400);
            }
    
            $reservation = Reservation::create([
                'id_user' => Auth::id(),
                'id_doctor' => $request->id_doctor,
                'poli' => $request->poli,
                'tanggal_kunjungan' => $request->tanggal_kunjungan,
                'jam_kunjungan' => $request->jam_kunjungan,
                'qr_code_path' => null,
            ]);
    
            Log::info('Reservation ID: ' . $reservation->id_reservation);

            // Pastikan $reservation->id_reservation sudah memiliki nilai
            if ($reservation && $reservation->id_reservation) {
                $qrCodeDirectory = storage_path('app/public/qrcodes');
                if (!file_exists($qrCodeDirectory)) {
                    mkdir($qrCodeDirectory, 0755, true);
                }
            
                $qrCodeData = json_encode([
                    'id_reservation' => $reservation->id_reservation,
                    'poli' => $reservation->poli,
                    'tanggal_kunjungan' => $reservation->tanggal_kunjungan,
                    'jam_kunjungan' => $reservation->jam_kunjungan,
                    'doctor_id' => $reservation->id_doctor,
                ]);
            
                $qrCodePath = 'qrcodes/' . $reservation->id_reservation . '.png';

                Log::info('QR Code path: ' . public_path($qrCodePath));
                Log::info('QR Code directory exists: ' . file_exists(public_path('storage/qrcodes')));
                Log::info('QR Code data: ' . $qrCodeData);
                Log::info('Generated QR Code path: ' . $qrCodePath);

                $qrCode = QrCode::format('png')->size(200)->generate($qrCodeData);
                file_put_contents(public_path('qrcodes/' . $reservation->id_reservation . '.png'), $qrCode);

                //QrCode::format('png')->size(200)->generate($qrCodeData, storage_path('app/public/' . $qrCodePath));
                $reservation->update(['qr_code_path' => $qrCodePath]);
            } else {
                throw new \Exception('Failed to create reservation.');
            }

            Notification::create([
                'id_user' => Auth::id(),
                'type' => 'Reservation',
                'data' => json_encode($reservation)
            ]);
    
            return response()->json([
                'message' => 'Reservation created successfully',
                'data' => $reservation
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Internal server error',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getQueueDetails()
    {
        try {
            $queues = Reservation::where('id_user', Auth::id())->get();

            return response()->json([
                'message' => 'Queue details fetched successfully',
                'data' => $queues
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Internal server error',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function submitFeedback(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'id_doctor' => 'required|exists:users,id_user',
                'message' => 'required|string|max:300',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 400);
            }

            $feedback = Feedback::create([
                'id_user' => Auth::id(),
                'id_doctor' => $request->id_doctor,
                'message' => $request->message,
            ]);

            return response()->json([
                'message' => 'Feedback submitted successfully',
                'data' => $feedback
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Internal server error',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}