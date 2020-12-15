<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Subscribe extends Model
{
    protected $table='subscribes';
    protected $fillable=[
        'serviceName',
        'user_id',
        'serviceProvider',
        'serviceCapacity',
        'serviceType',
        'serviceCost',
        'startDate',
        'endDate',
        'status'
    ];


    public function getDaysAttribute(){
        return Carbon::now()->diffInDays($this->endDate);
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
