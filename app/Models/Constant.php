<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

class Constant extends BaseModel
{
    use HasFactory, HasTranslations;

    protected $table        = 'constants';
    protected $fillable     = ['name', 'enabled'];
    protected $appends      = ['name_trans'];
    public $translatable    = ['name'];
}
