<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\LecturerCredit;
use App\Models\LecturerPlot;
use App\Models\OfferedSubClass;
use App\Models\RoomTime;
use App\Models\RoomTimeHelper;
use App\Models\Schedule;
use Illuminate\Http\Request;

class AcademicYearController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(){
        $academicYears = AcademicYear::get()->toArray();
        return response()->json([
            "status" => "success",
            "data" => $academicYears,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request){
        $newAcadYear = $request->toArray();
        $result = AcademicYear::where("start_year", "=", $newAcadYear["start_year"])->where("end_year", "=", $newAcadYear["end_year"])->where("semester", "=", $newAcadYear["semester"])->first();
        if ($result == null) {
            $resultId = AcademicYear::firstOrCreate($newAcadYear)->academic_year_id;
            $prevId = $resultId - 2;
            if ($prevId > 0){
                $oldOfferedSubClasses = OfferedSubClass::whereAcademicYearId($prevId)->select(["sub_class_id"])->get()->toArray();
                $oldLecturerPlots = LecturerPlot::whereAcademicYearId($prevId)->select(["lecturer_id", "sub_class_id", "is_held"])->get()->toArray();
                $oldLecturerCredits = LecturerCredit::whereAcademicYearId($prevId)->select(["lecturer_id", "credit", "sub_class_count"])->get()->toArray();
                $oldRoomTimes = RoomTime::whereAcademicYearId($prevId)->select(["time_id", "room_id", "is_occupied"])->get()->toArray();
                $oldRoomTimeHelpers = RoomTimeHelper::whereAcademicYearId($prevId)->select(["time_id", "room_id", "is_occupied", "is_possible"])->get()->toArray();
                $oldSchedules = Schedule::whereAcademicYearId($prevId)->select(["lecturer_plot_id", "room_time_id", "lecturer_id", "sub_class_id", "sub_class_semester", "room_id", "time_id", "color_data"])->get()->toArray();


                foreach ($oldOfferedSubClasses as $oldOfferedSubClass) {
                    $oldOfferedSubClass["academic_year_id"] = $resultId;
                    OfferedSubClass::create($oldOfferedSubClass);
                }
                foreach ($oldLecturerPlots as $oldLecturerPlot) {
                    $oldLecturerPlot["academic_year_id"] = $resultId;
                    LecturerPlot::create($oldLecturerPlot);
                }
                foreach ($oldLecturerCredits as $oldLecturerCredit) {
                    $oldLecturerCredit["academic_year_id"] = $resultId;
                    LecturerCredit::create($oldLecturerCredit);
                }
                foreach ($oldRoomTimes as $oldRoomTime) {
                    $oldRoomTime["academic_year_id"] = $resultId;
                    RoomTime::create($oldRoomTime);            }
                foreach ($oldRoomTimeHelpers as $oldRoomTimeHelper) {
                    $oldRoomTimeHelper["academic_year_id"] = $resultId;
                    RoomTimeHelper::create($oldRoomTimeHelper);
                }
                foreach ($oldSchedules as $oldSchedule) {
                    $oldSchedule["academic_year_id"] = $resultId;
                    Schedule::create($oldSchedule);
                }
            }
        }
        return response()->json([
            "message" => "success",
            "academic_year_id" => $resultId
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
