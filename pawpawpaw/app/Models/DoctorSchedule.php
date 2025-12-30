<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorSchedule extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_jadwal';

    protected $fillable = [
        'id_user', 'tanggal', 'jam', 'status'
    ];

    public function doctor()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
