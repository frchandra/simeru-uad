<?php

namespace App\Http\Services;

use App\Http\Repository\RoomRepository;

class RoomServices{
    private RoomRepository $roomRepository;

    public function __construct(RoomRepository $roomRepository){
        $this->roomRepository = $roomRepository;
    }

    /**
     * Get all room data
     *
     * @return array
     */
    public function getAll(){
        return $this->roomRepository->getAll()->toArray();
    }

    public function create($name, $quota){
        $this->roomRepository->create($name, $quota);
    }

    public function delete($id){
        $this->roomRepository->delete($id);
    }
}
