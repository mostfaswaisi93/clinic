<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Location extends BaseModel
{
    use HasFactory, HasTranslations;

    protected $table        = 'locations';
    protected $fillable     = ['title', 'country_id', 'city_id', 'district_id', 'enabled'];
    protected $appends      = ['title_trans'];
    public $translatable    = ['title'];

    // get Title Translatable
    public function getTitleTransAttribute()
    {
        if (app()->getLocale() == 'ar') {
            return $this->getTranslation('title', 'ar');
        } else {
            return $this->getTranslation('title', 'en');
        }
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }
}
