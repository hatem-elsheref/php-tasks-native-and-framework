<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Studies extends Model
{
    protected $table='studies';
    protected $fillable=['name','alias'];

    public function applications(){
        return $this->hasMany(ApplicationForm::class,'study_id','id');
    }
}
