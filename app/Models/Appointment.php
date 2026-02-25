<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Service;
use App\Models\Staff;
class Appointment extends Model
{

    protected $fillable = [
        'user_id',
        'staff_id',
        'service_id',
        'start_at',
        'end_at',
        'memo',
        'status',
    ];
    //$appointment->user
    public function user(){
        return $this->belongsTo(User::class);
    }
    //$appointment->service
    public function service(){
        return $this->belongsTo(Service::class);
    }
    //$appointment->staff
    public function staff(){
        return $this->belongsTo(Staff::class);
    }
    protected $casts = [
        'start_at' => 'datetime',
        'end_at' => 'datetime',
        ];


        //確認画面で予約日時が9:00のみのところ、9:00~10:00までend_atも表示したい
    // public function getEnd_AtAttribute(){
    //     return $this->
    // }
}
