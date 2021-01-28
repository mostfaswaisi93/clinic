<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

class State extends BaseModel
{
    use HasFactory, HasTranslations;

    protected $table        = 'states';
    protected $fillable     = ['name', 'city_id', 'country_id', 'enabled'];
    protected $appends      = ['name_trans'];
    public $translatable    = ['name'];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
