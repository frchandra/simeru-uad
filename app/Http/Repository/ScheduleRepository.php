<?php

namespace App\Http\Repository;

use App\Models\Schedule;

class ScheduleRepository{
    public function getByLectuererTimeSemester($lecturerId, $timeId, $semesterId){
        return Schedule::whereLecturerId($lecturerId)->where('time_id', '=', $timeId)->where('academic_year_id', '=', $semesterId)->get();
    }

    public function getByRoomTimeSemester($roomId, $timeId, $semesterId){
        return Schedule::whereRoomId($roomId)->where('time_id', '=', $timeId)->where('academic_year_id', '=', $semesterId)->get();
    }

    public function getBySemesterTime($semester, $timeId){
        return Schedule::whereSubClassSemester($semester)->where('time_id', '=', $timeId)->get();
    }

    public function getDetailsByAcadYear($acadYearId){
        return Schedule::
            join('lecturers', 'lecturers.lecturer_id', '=', 'schedules.lecturer_id')->
            join('sub_classes', 'sub_classes.sub_class_id', '=', 'schedules.sub_class_id')->
            join('rooms', 'rooms.room_id', '=', 'schedules.room_id')->
            join('times', 'times.time_id', '=', 'schedules.time_id')->
            get([
                'schedules.*',
                'lecturers.name as lecturer_name',
                'lecturers.email as lecturer_email',
                'lecturers.phone_number as lecturer_phone_number',
                'sub_classes.name as sub_class_name',
                'sub_classes.quota as sub_class_quota',
                'sub_classes.credit as sub_class_credit',
                'sub_classes.semester as sub_class_semester',
                'rooms.name as room_name',
                'rooms.quota as room_quota',
                'times.day',
                'times.session',
            ]);
    }
}
