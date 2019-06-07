<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'id_number',
        'fullname',
        'phone_number',
        'email',
        'country_abbr',
        'state_code',
        'town_code',
        'credential_photo',
        'official_id_photo_back',
        'official_id_photo_front',
        'other_official_id_photo',
        'occupation_code',
        'occupation',
        'member_comment',
        'verified'
    ];

    protected $casts = [
        'folio' => 'string',
        'id_number' => 'string',
        'fullname' => 'string',
        'phone_number' => 'string',
        'email' => 'string',
        'country_abbr' => 'string',
        'state_code' => 'integer',
        'town_code' => 'integer',
        'credential_photo' => 'string',
        'official_id_photo_back' => 'string',
        'official_id_photo_front' => 'string',
        'other_official_id_photo' => 'string',
        'occupation_code' => 'integer',
        'occupation' => 'string',
        'member_comment' => 'string',
        'verified' => 'boolean'
    ];

    /** Asigna el folio dado el formato correspondiente tomando los valores de algunos de los atributos. */ 
    public function getCalculatedFolio() 
    {
        // Calcula el id que se le asignará y se rellena con ceros.
        $nextId = self::max('id') + 1;
        $zeroFilledNextId = str_pad($nextId, 4, "0", STR_PAD_LEFT);
        $state_abbr = 'AAA';
        foreach(config('app.state_codes') as $abbr => $code) {
            if ($code == $this->state_code) {
                $state_abbr = $abbr;
                break;
            }
        }
        $folio = $this->occupation_code . $this->country_abbr . $state_abbr . $this->town_code . $zeroFilledNextId;
        
        return $folio;
    }

    public function getOccupationTitleAttribute()
    {
        foreach(config('app.occupation_titles') as $code => $title) {
            if ($code == $this->occupation_code) {
                return $title;
            }
        }
        return null;
    }
}
