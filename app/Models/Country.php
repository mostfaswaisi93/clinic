<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

class Country extends BaseModel
{
    use HasFactory, HasTranslations;

    protected $table        = 'countries';
    protected $fillable     = ['name', 'mob', 'code', 'currency', 'logo', 'enabled'];
    protected $appends      = ['logo_path', 'name_trans', 'currency_trans'];
    public $translatable    = ['name', 'currency'];

    // get Currency Translatable
    public function getCurrencyTransAttribute()
    {
        return $this->getTranslation('currency', app()->getLocale());
    }

    public function getLogoPathAttribute()
    {
        return asset('images/countries/' . $this->logo);
    }

    public function cities()
    {
        return $this->hasMany(City::class);
    }

    public function districts()
    {
        return $this->hasMany(District::class);
    }
}
