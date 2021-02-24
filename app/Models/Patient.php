<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

class Patient extends BaseModel
{
    use HasFactory, HasTranslations;

    protected $table        = 'patients';
    protected $fillable     = [
        'id_number', 'first_name', 'last_name', 'address',
        'phone', 'dob', 'notes', 'user', 'constant_id', 'user_id', 'enabled'
    ];
    protected $appends      = ['first_name_trans', 'last_name_trans', 'full_name'];
    public $translatable    = ['first_name', 'last_name'];

    // get First Name Translatable
    public function getFirstNameTransAttribute()
    {
        return $this->getTranslation('first_name', app()->getLocale());
    }

    // get Last Name Translatable
    public function getLastNameTransAttribute()
    {
        return $this->getTranslation('last_name', app()->getLocale());
    }

    // get Full Name
    public function getFullNameAttribute()
    {
        return ucfirst($this->first_name) . ' ' . ucfirst($this->last_name);
    }

    // Full Name
    // Address
    // Phone
    // Birthdate
    // Gender
    // Notes
    // AddedUser-AddedBy
    // DoctorId

    public function user()
    {
        $this->belongsTo(User::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
