<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poly extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function enlistment() 
    {
        return $this->hasMany(Enlistment::class, 'poly_id');
    }
}
