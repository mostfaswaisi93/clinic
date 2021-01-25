<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Patient extends BaseModel
{
    use HasFactory;

    protected $table        = 'patients';
    protected $guarded      = [];
    // protected $fillable     = ['', '', '', '', '', 'enabled'];
}
