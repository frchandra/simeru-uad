<?php

namespace App\Http\Controllers;

use App\Http\Services\ScheduleServices;
use Illuminate\Http\Request;

class ScheduleController extends Controller{
    private ScheduleServices $scheduleServices;

    public function __construct(ScheduleServices $scheduleServices){
        $this->scheduleServices = $scheduleServices;
    }
}
