<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialization extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_specialization'; 

    protected $fillable = [
        'id_user', 'specialization_name'
    ];

    public function doctors()
    {
        return $this->hasMany(User::class, 'id_specialization', 'id_specialization');
    }
    
}
