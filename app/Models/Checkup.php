<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkup extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'doctor_id',
        'checkup_date',
        'handling',
        'price',
        'checkup_result',
    ];

    public function enlistment()
    {
        return $this->belongsTo(Enlistment::class, 'patient_id', 'id');
    }


    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }
}
