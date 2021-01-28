<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Patient extends BaseModel
{
    use HasFactory;

    protected $table        = 'patients';
    protected $fillable     = ['first_name', 'last_name', 'address', 'phone', 'constant_id', 'user_id', 'enabled'];
}
