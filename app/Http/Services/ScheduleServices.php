<?php

namespace App\Http\Services;

use App\Http\Repository\LecturerPlotRepository;
use App\Http\Repository\RoomTimeRepository;
use App\Http\Repository\ScheduleRepository;
use App\Models\Lecturer;
use App\Models\LecturerPlot;
use App\Models\Room;
use App\Models\RoomTime;
use App\Models\Schedule;
use App\Models\SubClass;
use App\Models\Time;
use Illuminate\Validation\ValidationException;
use function Symfony\Component\String\s;

class ScheduleServices{
    private ScheduleRepository $scheduleRepository;
    private RoomTimeRepository $roomTimeRepository;
    private LecturerPlotRepository $lecturerPlotRepository;

    public function __construct(ScheduleRepository $scheduleRepository, RoomTimeRepository $roomTimeRepository, LecturerPlotRepository $lecturerPlotRepository){
        $this->scheduleRepository = $scheduleRepository;
        $this->roomTimeRepository = $roomTimeRepository;
        $this->lecturerPlotRepository = $lecturerPlotRepository;
    }


    public function checkLectuererConflict($allocation){
        //memastikan tidak ada dosen yg mengajar di ruang yg berbeda diwaktu yang sama
        //ambil data RoomTime berdasarkan lecturerId yang diberikan
        //cek apakah bila data diinputkan maka akan terdapat room yg berbeda diwaktu yang sama => cek apakah terdapat entry dengan lecturid dan timeid yang sama => apakah ada olddata dengan timeid==timeid
        //error: dosen dosenId telah mengajar di room_idx dan room_idy di waktu time_id
        $lecturePlot = $this->lecturerPlotRepository->getByIdSemester($allocation['lecturer_plot_id'], $allocation['academic_year_id']);
        $roomTime = $this->roomTimeRepository->getByIdSemester($allocation['room_time_id'], $allocation['academic_year_id']);
        $oldData = $this->scheduleRepository->getByLectuererTimeSemester($lecturePlot->lecturer_id, $roomTime->time_id, $allocation['academic_year_id']);

        //if entry tidak ditemukan (dosen belum teralokasi pada waktu yang diberikan)
        if($oldData->count()<1){
            return true;
        } else {
            $lecturer = Lecturer::whereLecturerId($oldData->first()->lecturer_id)->first();
            $subClass = SubClass::whereSubClassId($oldData->first()->sub_class_id)->first();
            $room = Room::whereRoomId($oldData->first()->room_id)->first();
            $time = Time::whereTimeId($oldData->first()->time_id)->first();


            throw ValidationException::withMessages(['messages' => [
               ['description' => 'This operation creates conflict with this classs'],
               ['lecturer_name' => $lecturer->name],
               ['sub_class_name' => $subClass->name],
               ['room_name' => $room->name],
               ['time_day' => $time->day],
               ['time_session' => $time->session],
            ]]);
        }


    }

    public function checkRoomConflict($allocation){
        //memastikan tidak ada sub class yang terselenggara di ruang&waktu yang akan dialokasikan
        //ambil data lecturer/subclass dari roomId yang diberikan
        //cek apakah bila data diinputkan maka akan terdapat lecturer/class yang berbeda di waktu&ruang yang sama => cek apakah terdapat waktu&ruang yang sama => apakah ada ol data dengan waktu&ruang == waktu&ruang
        //error: ruang x di waktu y telah diisi dosen/class
        $roomTime = $this->roomTimeRepository->getByIdSemester($allocation['room_time_id'], $allocation['academic_year_id']);
        $oldData = $this->scheduleRepository->getByRoomTimeSemester($roomTime->first()->room_id, $roomTime->first()->time_id, $allocation['academic_year_id']);
        //if sudah terdapat room
        if($oldData->count()<1){
            return true;
        } else{
           $lecturer = Lecturer::whereLecturerId($oldData->first()->lecturer_id)->first();
            $subClass = SubClass::whereSubClassId($oldData->first()->sub_class_id)->first();
            $room = Room::whereRoomId($oldData->first()->room_id)->first();
            $time = Time::whereTimeId($oldData->first()->time_id)->first();

           throw ValidationException::withMessages(['messages' => [
                ['description' => 'This operation creates conflict with this class'],
                ['lecturer_name' => $lecturer->name],
                ['sub_class_name' => $subClass->name],
                ['room_name' => $room->name],
                ['time_day' => $time->day],
                ['time_session' => $time->session],
            ]]);
        }



    }

    public function checkQuotaConflict($allocation){
        //matkul tidak boleh diselenggarakan di ruang yang kapasitasnya lebih kecil dari quota kelas
        //ambil data kuota kelas dari classid
        //ambil data kuota kelas dari roomid
        //bandingkan
        $lecturePlot = $this->lecturerPlotRepository->getByIdSemester($allocation['lecturer_plot_id'], $allocation['academic_year_id'])->first();
        $roomTime = $this->roomTimeRepository->getByIdSemester($allocation['room_time_id'], $allocation['academic_year_id'])->first();
        //TODO: handle if lecturerPLot & roomTime == null

        $classQuota = SubClass::whereSubClassId($lecturePlot->first()->sub_class_id)->first()->quota;
        $roomQuota = Room::whereRoomId($roomTime->first()->room_id)->first()->quota;

        if($classQuota > $roomQuota){
            throw ValidationException::withMessages(['messages' =>
                ['description' => 'the quota for the class is higher than room quota'],
                ['sub_class_quota' => $classQuota],
                ['room_quota' => $roomQuota],
            ]);
        }


    }



    public function checkSameCourseSemester($allocation){
        //dalam satu sesi tidak boleh terselenggara lebih dari 2 sub class yang bersemester sama
        //ambil data courseid dari lecturer_plot_id yang diberikan.
        //ambil data time_id dari room_time_id
        //cek apakah bila data diinputkan maka akan constrain akan terlanggar. select where session==session and courseid==courseid => if result >2 => error
        $subClassSemester = $this->lecturerPlotRepository->getByIdSemester($allocation['lecturer_plot_id'], $allocation['academic_year_id'])->first()->subClass->semester;
        $timeId = $this->roomTimeRepository->getByIdSemester($allocation['room_time_id'], $allocation['academic_year_id'])->first()->time->time_id;
        $oldData = $this->scheduleRepository->getBySemesterTime($subClassSemester, $timeId);

        if($oldData->count()<2){
            return true;
        } else {
            $oldData = $oldData->join('sub_classes', 'schedules.sub_class_id','=', 'sub_classes.sub_class_id');
            throw ValidationException::withMessages(['messages' =>
                ['description' => 'the third requirement is unsatisfied'],
                ['data' => $oldData->toArray()],
            ]);
        }

    }

    public function getDetailsByAcadYear($acadYearId){
        return $this->scheduleRepository->getDetailsByAcadYear($acadYearId)->toArray();
    }


    public function updateOccupiedTrue($allocation){
        RoomTime::whereRoomTimeId($allocation['room_time_id'])->update(['is_occupied' => true]);
    }

    public function updateIsHeldTrue($allocation){
        LecturerPlot::whereLecturerPlotId($allocation['lecturer_plot_id'])->update(['is_held' => true]);
    }

    public function insert($allocation){
        $lecturePlot = $this->lecturerPlotRepository->getByIdSemester($allocation['lecturer_plot_id'], $allocation['academic_year_id']);
        $roomTime = $this->roomTimeRepository->getByIdSemester($allocation['room_time_id'], $allocation['academic_year_id']);

        $allocation['lecturer_id'] = $lecturePlot->first()->lecturer_id;
        $allocation['sub_class_id'] = $lecturePlot->first()->sub_class_id;
        $allocation['sub_class_semester'] = $lecturePlot->first()->subClass->semester;
        $allocation['room_id'] = $roomTime->first()->room_id;
        $allocation['time_id'] = $roomTime->first()->time_id;

        Schedule::create($allocation);
    }

}
