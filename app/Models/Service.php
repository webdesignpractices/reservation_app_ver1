<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Service;

class Service extends Model
{
    //$service->appointments
    public function appointments(){
        return $this->belongsToMany(Service::class);

    }
    protected $fillable = [
        'name',
        'duration_minutes',
        'price',
    ];

    public function getFormattedPriceAttribute(){
        return number_format($this->price).'円';
    }
    public function getFormattedDurationAttribute(){
        $hours = floor($this->duration_minutes / 60); 
        $minutes = $this->duration_minutes % 60;

        if($hours<1 && $minutes<1){
            return $this->duration_minutes.'分';
        }elseif($hours>=1 && $minutes<1){
            return $hours.'時間';
        }else{
            return $hours.'時間'.$minutes.'分';
        }
    }
}
