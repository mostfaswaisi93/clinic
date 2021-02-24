<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Appointment extends BaseModel
{
    use HasFactory;

    protected $table        = 'appointments';
    protected $fillable     = ['start', 'end', 'patient_id', 'service_id', 'user_id', 'enabled'];

    // public function doctors()
    // {
    //     return $this->belongsTo(Doctor::class, 'doctor_id', 'id');
    // }

    public function patients()
    {
        return $this->belongsTo(Patient::class);
    }
}
