<?php

namespace App\Http\Repository;

use App\Models\Room;
use App\Models\RoomTime;

class RoomTimeRepository{
    public function getAll(){
        return RoomTime::get();
    }

    public function create($allocation){
        return RoomTime::create($allocation);
    }

    public function getOne($roomId, $timeId, $semesterId){
        return RoomTime::whereTimeId($timeId)->where('room_id', '=', $roomId)->where('academic_year_id', '=', $semesterId)->get();
    }
}
