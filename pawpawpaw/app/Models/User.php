<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;

class User extends Model implements AuthenticatableContract
{
    use HasFactory, Authenticatable;

    protected $primaryKey = 'id_user';

    protected $fillable = [
        'nama', 'nik', 'no_telp', 'email', 'password', 'role', 'aktif_praktek', 'lokasi_praktek', 'kontak',
    ];

    public function specialization()
    {
        return $this->belongsTo(Specialization::class, 'id_specialization', 'id_specialization');
    }

    public function doctorSchedules()
    {
        return $this->hasMany(DoctorSchedule::class, 'id_user', 'id_user');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'id_user_patient', 'id_user')
            ->orWhere('id_user_doctor', 'id_user');
    }

    public function consultations()
    {
        return $this->hasMany(Consultation::class, 'id_user_patient', 'id_user')
            ->orWhere('id_user_doctor', 'id_user');
    }

    public function queues()
    {
        return $this->hasMany(Queue::class, 'id_user_patient', 'id_user')
            ->orWhere('id_user_doctor', 'id_user');
    }

}
