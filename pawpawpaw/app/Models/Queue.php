<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Queue extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_antrian'; 

    protected $fillable = [
        'id_user_patient', 'id_user_doctor', 'id_konsultasi', 'status', 'no_antrian'
    ];

    public function patient()
    {
        return $this->belongsTo(User::class, 'id_user_patient', 'id_user');
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'id_user_doctor', 'id_user');
    }

    public function consultation()
    {
        return $this->belongsTo(Consultation::class, 'id_konsultasi', 'id_konsultasi');
    }
}
