<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_review'; 

    protected $fillable = [
        'id_user_patient', 'id_user_doctor', 'rating', 'komentar', 'tanggal_review', 'admin_feedback', 'tanggal_feedback', 'id_user_admin'
    ];

    public function patient()
    {
        return $this->belongsTo(User::class, 'id_user_patient', 'id_user');
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'id_user_doctor', 'id_user');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'id_user_admin', 'id_user');
    }
}
