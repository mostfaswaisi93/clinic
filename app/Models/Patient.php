<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

class Patient extends BaseModel
{
    use HasFactory, HasTranslations;

    protected $table        = 'patients';
    protected $fillable     = [
        'full_name', 'address', 'phone', 'dob', 'notes',
        'constant_id', 'user_id', 'enabled'
    ];
    protected $casts        = ['created_at' => 'date:Y-m-d - H:i A', 'updated_at' => 'date:Y-m-d - H:i A', 'dob' => 'date:Y-m-d'];
    protected $dates        = ['created_at', 'updated_at', 'deleted_at', 'dob'];
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
