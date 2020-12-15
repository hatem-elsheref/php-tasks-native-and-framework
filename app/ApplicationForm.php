<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApplicationForm extends Model
{
    protected $table='scholarships_applications';
    protected $fillable=[
        'studentName','studentEmail','studentPhone','studentCity','id_card',
        'birthdate_certificate','school_certificate','university','department',
        'graduation','user_id','study_id', 'status','faculty'];


    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function study(){
        return $this->belongsTo(Studies::class,'study_id','id');
    }

}
