<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enlistment extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_id', 
        'patient_name', 
        'poly_id', 
        'enlistment_date', 
        'complaint', 
        'attachment', 
        'checkup_date',
        'user_id',
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }

    public function checkup()
    {
        return $this->hasMany(Checkup::class, 'patient_id');
    }

    public function poly()
    {
        return $this->belongsTo(Poly::class, 'poly_id');
    }

}
