<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsultationCancellation extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_pembatalan'; 

    protected $fillable = [
        'id_konsultasi', 'id_user_admin', 'tanggal_pembatalan', 'alasan'
    ];

    public function consultation()
    {
        return $this->belongsTo(Consultation::class, 'id_konsultasi', 'id_konsultasi');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'id_user_admin', 'id_user');
    }
}
