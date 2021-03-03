<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

class Test extends BaseModel
{
    use HasFactory, HasTranslations;

    protected $table        = 'tests';
    protected $fillable     = ['name', 'description', 'enabled'];
    protected $appends      = ['name_trans'];
    public $translatable    = ['name'];
}
