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
    protected $appends      = ['full_name_trans'];
    public $translatable    = ['full_name'];

    public function user()
    {
        $this->belongsTo(User::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
