<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'fullname',
        'ocuppation_code',
        'country_abbr',
        'state_code',
        'town_code',
        'official_id_photo_back',
    ];

    protected $casts = [
        'fullname' => 'string',
        'ocuppation_code' => 'integer',
        'country_abbr' => 'string',
        'state_code' => 'integer',
        'town_code' => 'integer',
        'official_id_photo_back' => 'string',
    ];

    /** Asigna el folio dado el formato correspondiente tomando los valores de algunos de los atributos. */ 
    public function getCalculatedFolio() 
    {
        
        // Calcula el id que se le asignará y se rellena con ceros.
        $nextId = self::max('id') + 1;
        $zeroFilledNextId = str_pad($nextId, 4, "0", STR_PAD_LEFT);
        $folio = $this->ocuppation_code . $this->country_abbr . $this->state_code . $this->town_code . $zeroFilledNextId;
        
        return $folio;
    }
}
