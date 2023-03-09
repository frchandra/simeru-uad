<?php

namespace App\Http\Controllers;

use App\Http\Services\ScheduleServices;
use App\Models\LecturerPlot;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ScheduleController extends Controller
{
    private ScheduleServices $scheduleServices;

    public function __construct(ScheduleServices $scheduleServices)
    {
        $this->scheduleServices = $scheduleServices;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request){


        /**
         * untuk setiap request
         *  start tx
         *  cek apakah kapasitas ruang waktu mencukupi
         *  cek apakah dosen telah mengajar di sesi yang sama
         *  cek duplikasi mk ruang
         *  rubah okupasi roomtime dan lecturerclass
         *  end tx
         */

        $allocations = $request->get('data');

        \DB::beginTransaction();
        foreach ($allocations as $allocation) {
            //mendapatkan jumlah sks sub_class dari lecturer_plot
            $subClassCredit = LecturerPlot::whereLecturerPlotId($allocation['lecturer_plot_id'])->first()->subClass->credit;
            $roomTimeId = (int)$allocation['room_time_id'];
            $lecturerPlotId = (int)$allocation['lecturer_plot_id'];
            $acadYearId = (int)$allocation['academic_year_id'];

            try {
                $this->scheduleServices->checkQuotaConflict($lecturerPlotId, $roomTimeId, $acadYearId);

                for ($i=1; $i<=$subClassCredit; $i++){
                    $this->scheduleServices->checkLectuererConflict($lecturerPlotId, $roomTimeId, $acadYearId);
                    $this->scheduleServices->checkRoomTimeConflict($roomTimeId, $acadYearId);
                    $this->scheduleServices->checkSameCourseSemester($lecturerPlotId, $roomTimeId, $acadYearId);
                    $this->scheduleServices->updateOccupied($roomTimeId, true);
                    $this->scheduleServices->insert($allocation);
                    $roomTimeId++;
                    $allocation['room_time_id']=$roomTimeId;
                }

                $this->scheduleServices->updateIsHeld($lecturerPlotId, true);
            } catch (ValidationException $e) {
                \DB::rollBack();
                return response()->json([
                    "status" => "fail",
                    "messages" => $e->errors()['messages'],
                ], 400);
            }
        }
        \DB::commit();
        return response()->json([
            "status" => "success",
        ], 201);
    }

    public function bruteStore(Request $request){


        /**
         * untuk setiap request
         *  start tx
         *  cek apakah kapasitas ruang waktu mencukupi
         *  cek apakah dosen telah mengajar di sesi yang sama
         *  cek duplikasi mk ruang
         *  rubah okupasi roomtime dan lecturerclass
         *  end tx
         */

        $allocations = $request->get('data');

        \DB::beginTransaction();
        foreach ($allocations as $allocation) {
            //mendapatkan jumlah sks sub_class dari lecturer_plot
            $subClassCredit = LecturerPlot::whereLecturerPlotId($allocation['lecturer_plot_id'])->subClass->credit;
            $roomTimeId = (int)$allocation['room_time_id'];
            $lecturerPlotId = (int)$allocation['lecturer_plot_id'];
            $acadYearId = (int)$allocation['academic_year_id'];

            try {
                $this->scheduleServices->checkQuotaConflict($lecturerPlotId, $roomTimeId, $acadYearId);

                for ($i=1; $i<=$subClassCredit; $i++){
                    $this->scheduleServices->checkLectuererConflict($lecturerPlotId, $roomTimeId, $acadYearId);
                    $this->scheduleServices->checkRoomTimeConflict($roomTimeId, $acadYearId);
                    $this->scheduleServices->updateOccupied($roomTimeId, true);
                    $this->scheduleServices->insert($allocation);
                    $roomTimeId++;
                }

                $this->scheduleServices->updateIsHeld($lecturerPlotId, true);
            } catch (ValidationException $e) {
                \DB::rollBack();
                return response()->json([
                    "status" => "fail",
                    "messages" => $e->errors()['messages'],
                ], 400);
            }
        }
        \DB::commit();
        return response()->json([
            "status" => "success",
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param int $acadYearId
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($acadYearId)
    {
        $data = $this->scheduleServices->getDetailsByAcadYear($acadYearId);
        return response()->json([
            "status" => "success",
            "data" => $data,
        ]);
    }

    public function showFormatted($acadYearId){
        $data = array();
        $temp = array();
        $prev = array();
        $schedules = $this->scheduleServices->getDetailsByAcadYear($acadYearId);
        foreach ($schedules as $schedule) {
            if(isset($prev["lecturer_plot_id"]) && $prev["lecturer_plot_id"] != $schedule["lecturer_plot_id"]){
                $data = array_push($data, $temp); //save temp data
                $temp = array(); //create new empty temp
            }
            $re = '/(.*)([a-z])[^a-z]*$/i';
            $str = $schedule["sub_class_name"];
            preg_match_all($re, $str, $matches);
            $temp["Mata Kuliah"] = $matches[1][0];
            $temp["Kelas"] = $matches[2][0];
            $temp["Semester"] = $schedule["sub_class_semester"];
            $temp["Kapasitas"] = $schedule["sub_class_quota"];
            $temp["Dosen Pengampu"] = $schedule["lecturer_name"];
            $temp["Ruang"] = $schedule["room_name"];
            if ($schedule["day"] == 1){
                $temp["Hari"] = "senin";
            } elseif ($schedule["day"] == 2){
                $temp["Hari"] = "selasa";
            } elseif ($schedule["day"] == 3){
                $temp["Hari"] = "rabu";
            } elseif ($schedule["day"] == 4){
                $temp["Hari"] = "kamis";
            } elseif ($schedule["day"] == 5){
                $temp["Hari"] = "jumat";
            } elseif ($schedule["day"] == 6){
                $temp["Hari"] = "sabtu";
            }
            $temp["Sesi"][] = $schedule["session"];


            $prev = $schedule;
        }
        array_push($data, $temp); //save temp data
        return response()->json([
            "status" => "success",
            "data" => $data,
        ], 200);


    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request)
    {
        $allocations = $request->get('data');

        foreach ($allocations as $allocation) {
            $this->scheduleServices->updateIsHeld($allocation['lecturer_plot_id'], false);
            $roomTimeIds = Schedule::whereLecturerPlotId($allocation['lecturer_plot_id'])->select(['room_time_id'])->get()->toArray();
            foreach ($roomTimeIds as $roomTimeId) {
                $this->scheduleServices->updateOccupied($roomTimeId, false);
            }
            $this->scheduleServices->delete($allocation['lecturer_plot_id'], $allocation['academic_year_id']);
            return response()->json([
                "status" => "success",
            ], 201);
        }

    }
}
