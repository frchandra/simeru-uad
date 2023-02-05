<?php

namespace App\Http\Repository;

use App\Models\Room;
use App\Models\RoomTime;
use App\Models\RoomTimeHelper;

class RoomTimeRepository{
    public function getAll(){
        return RoomTime::get();
    }

    public function getAllHelper(){
        return RoomTimeHelper::get();
    }

    public function getByDetails($roomId, $timeId, $semesterId){
        return RoomTime::whereTimeId($timeId)->where('room_id', '=', $roomId)->where('academic_year_id', '=', $semesterId)->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|RoomTime|object
     */
    public function getByIdSemester($id, $semesterId){
        return RoomTime::whereRoomTimeId($id)->where('academic_year_id', '=', $semesterId)->first();
    }
    public function create($allocation){
        return RoomTime::create($allocation);
    }

    public function createHelper($allocation){
        return RoomTimeHelper::whereRoomId($allocation['room_id'])->where('time_id', '=', $allocation['time_id'])->update(['is_possible' => true]);
    }

    public function delete($allocation){
        return RoomTime::whereRoomId($allocation['room_id'])->where('time_id', '=', $allocation['time_id'])->where('academic_year_id', '=', $allocation['academic_year_id'])->delete();
    }

    public function deleteHelper($allocation){
        return RoomTimeHelper::whereRoomId($allocation['room_id'])->where('time_id', '=', $allocation['time_id'])->where('academic_year_id', '=', $allocation['academic_year_id'])->update(['is_possible' => false]);
    }




}
