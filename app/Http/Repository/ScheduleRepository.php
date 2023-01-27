<?php

namespace App\Http\Repository;

use App\Models\Schedule;

class ScheduleRepository{
    public function getByLectuererTimeSemester($lecturerId, $timeId, $semesterId){
        return Schedule::whereLecturerId($lecturerId)->where('time_id', '=', $timeId)->where('academic_year_id', '=', $semesterId)->first();
    }

    public function getByRoomTimeSemester($roomId, $timeId, $semesterId){
        return Schedule::whereRoomId($roomId)->where('time_id', '=', $timeId)->where('academic_year_id', '=', $semesterId)->first();
    }

    public function getBySemesterTime($semester, $timeId){
        return Schedule::whereSubClassSemester($semester)->where('time_id', '=', $timeId)->first();
    }



}
