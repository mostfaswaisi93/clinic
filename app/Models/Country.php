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
        if (app()->getLocale() == 'ar') {
            return $this->getTranslation('currency', 'ar');
        } else {
            return $this->getTranslation('currency', 'en');
        }
    }

    public function getLogoPathAttribute()
    {
        return asset('images/countries/' . $this->logo);
    }
}
