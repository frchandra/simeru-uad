<?php

namespace App\Http\Services;

use App\Http\Repository\RoomTimeRepository;
use App\Models\RoomTime;
use Illuminate\Validation\ValidationException;

class RoomTimeServices{
    private RoomTimeRepository $roomTimeRepository;

    public function __construct(RoomTimeRepository $roomTimeRepository){
        $this->roomTimeRepository = $roomTimeRepository;
    }

    public function getAll(){
        return $this->roomTimeRepository->getAll()->toArray();
    }

    public function getAllHelper(){
        return $this->roomTimeRepository->getAllHelper()->toArray();
    }

    public function getByAcadYearId($acadYearId){
        return $this->roomTimeRepository->getByAcadYearId($acadYearId)->toArray();
    }

    public function getHelperByAcadYearId($acadYearId){
        return $this->roomTimeRepository->getHelperByAcadYearId($acadYearId);
    }

    public function create($allocation){
        $oldData = $this->roomTimeRepository->getByDetails($allocation['room_id'], $allocation['time_id'], $allocation['academic_year_id']);
        if($oldData->count()>0) {
            throw ValidationException::withMessages(['messages' => 'this messages has been created']);
        }
        $allocation['is_occupied'] = false;
        $this->roomTimeRepository->createHelper($allocation);
        return $this->roomTimeRepository->create($allocation);
    }

    public function delete($allocation){
        $roomTime = RoomTime::whereRoomId($allocation['room_id'])->where('time_id', '=', $allocation['time_id'])->where('academic_year_id', '=', $allocation['academic_year_id'])->first();
        if ($roomTime->is_occupied == true){
            throw ValidationException::withMessages(['messages' => 'this action cannot be done room_id '.$roomTime->room_id. ' is already occupied']);
        }
        $this->roomTimeRepository->deleteHelper($allocation);
        return $this->roomTimeRepository->delete($allocation);
    }
}
