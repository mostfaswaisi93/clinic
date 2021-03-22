<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

class Patient extends BaseModel
{
    use HasFactory, HasTranslations;

    protected $table        = 'patients';
    protected $fillable     = [
        'full_name', 'address', 'phone', 'dob', 'notes', 'user',
        'constant_id', 'user_id', 'enabled'
    ];
    protected $casts        = ['dob' => 'date:Y/m/d'];
    protected $dates        = ['dob'];
    protected $appends      = ['full_name_trans'];
    public $translatable    = ['full_name'];

    // get Full Name Translatable
    public function getFullNameTransAttribute()
    {
        return $this->getTranslation('full_name', app()->getLocale());
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
