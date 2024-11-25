<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'specialist', 'poly'];

    public function enlistments() {
        return $this->hasMany(Enlistment::class, 'doctor_id');
    }
}
