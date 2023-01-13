<?php

namespace App\Http\Services;

use App\Http\Repository\RoomTimeRepository;

class RoomTimeServices{
    private RoomTimeRepository $roomTimeRepository;

    public function __construct(RoomTimeRepository $roomTimeRepository){
        $this->roomTimeRepository = $roomTimeRepository;
    }
}
