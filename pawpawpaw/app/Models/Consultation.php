<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_konsultasi';

    protected $fillable = [
        'id_user_patient',
        'id_user_doctor',
        'status'
    ];

    public function patient()
    {
        return $this->belongsTo(User::class, 'id_user_patient', 'id_user');
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'id_user_doctor', 'id_user');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user_patient', 'id_user');
    }
}
