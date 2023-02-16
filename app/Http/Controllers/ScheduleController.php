<?php

namespace App\Http\Controllers;

use App\Http\Services\ScheduleServices;
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
    public function store(Request $request)
    {
        /**
         * untuk setiap request
         *  start tx
         *  cek apakah dosen telah mengajar di sesi yang sama
         *  cek apakah kapasitas ruang waktu mencukupi
         *  cek duplikasi mk ruang
         *  rubah okupasi roomtime dan lecturerclass
         *  end tx
         */

        $allocations = $request->get('data');
        \DB::beginTransaction();
        foreach ($allocations as $allocation) {
            try {
                $this->scheduleServices->checkQuotaConflict($allocation);
                $this->scheduleServices->checkLectuererConflict($allocation);
                $this->scheduleServices->checkRoomConflict($allocation);
                $this->scheduleServices->updateIsHeld($allocation, true);
                $this->scheduleServices->updateOccupied($allocation, true);
                $this->scheduleServices->checkSameCourseSemester($allocation);
                $this->scheduleServices->insert($allocation);
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
