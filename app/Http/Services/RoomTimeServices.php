<?php

namespace App\Http\Services;

use App\Http\Repository\RoomTimeRepository;
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

    public function create($allocation){
        $oldData = $this->roomTimeRepository->getByDetails($allocation['room_id'], $allocation['time_id'], $allocation['academic_year_id']);
        if($oldData->count()>0) {
            throw ValidationException::withMessages(['messages' => 'this messages has been created']);
        }
        $allocation['is_occupied'] = false;
        $this->roomTimeRepository->createHelper($allocation);
        return $this->roomTimeRepository->create($allocation);
    }
}
