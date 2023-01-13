<?php

namespace App\Http\Services;

use App\Http\Repository\ScheduleRepository;

class ScheduleServices{
    private ScheduleRepository $scheduleRepository;

    public function __construct(ScheduleRepository $scheduleRepository){
        $this->scheduleRepository = $scheduleRepository;
    }

}
