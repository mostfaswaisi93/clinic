<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table    = 'roles';
    protected $fillable = ['name'];
    protected $casts    = ['created_at' => 'date:Y-m-d H:i', 'updated_at' => 'date:Y-m-d H:i'];
    protected $dates    = ['created_at', 'updated_at'];
}
