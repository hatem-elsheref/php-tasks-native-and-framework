<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MissionApplication extends Model
{
    protected $table='mission_applications';
    protected $fillable=[
        'studentName','studentEmail','studentPhone','studentCity','id_card',
        'birthdate_certificate','school_certificate','department',
        'graduation','user_id','mission_id', 'status'];


    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function mission(){
        return $this->belongsTo(Mission::class,'mission_id','id');
    }
}
