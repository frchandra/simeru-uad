<?php

namespace App\Http\Controllers;

use App\Http\Services\ScheduleServices;
use App\Models\LecturerPlot;
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
            $this->scheduleServices->updateIsHeld($allocation, false);
            $this->scheduleServices->updateOccupied($allocation, false);
            $this->scheduleServices->delete($allocation['lecturer_plot_id'], $allocation['room_time_id'], $allocation['academic_year_id']);
            return response()->json([
                "status" => "success",
            ], 201);
        }

    }
}
