<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{

    protected $table = 'countries';
    protected $fillable = ['name', 'code'];

    public function applications()
    {
        return $this->hasMany(ApplicationForm::class, 'study_id', 'id');
    }
}
