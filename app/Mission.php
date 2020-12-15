<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    protected $table='missions';
    protected $fillable=['country_id','source','study_id','degree','vacanciesNumber','endDate','manual'];

    public function study(){
        return $this->belongsTo(Studies::class,'study_id','id');
    }
    public function country(){
        return $this->belongsTo(Country::class,'country_id','id');
    }

    public function alias(){
        return $this->country->name.' -> '.$this->source.' -> '.$this->degree.' -> '.$this->study->alias;
    }

}
