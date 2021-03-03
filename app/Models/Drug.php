<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Drug extends BaseModel
{
    use HasFactory;

    protected $table        = 'drugs';
    protected $fillable     = ['trade_name', 'generic_name', 'enabled'];
}
