<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_reservation';

    protected $fillable = [
        'id_user',
        'id_doctor',
        'poli',
        'tanggal_kunjungan',
        'jam_kunjungan',
        'qr_code_path'
    ];

    public function patient()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'id_doctor', 'id_user');
    }
}
