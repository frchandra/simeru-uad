<?php

namespace App\Http\Controllers;


use App\Http\Services\LecturerPlotServices;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LecturerPlotController extends Controller{
    private LecturerPlotServices $lecturerPlotServices;

    public function __construct(LecturerPlotServices $lecturerPlotServices){
        $this->lecturerPlotServices = $lecturerPlotServices;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(){
        return response()->json([
            "data" => "ok",
            "count" => "ok",

        ],200);
    }

    /**
     * Show lecturer_plots table joined with lecturers and sub_classes
     *
     * @param int $acadYearId
     */
    public function getJoinedByAcadYearId($acadYearId){
        $lecturerPlots = $this->lecturerPlotServices->getJoinedByAcadYearId($acadYearId);
        return response()->json([
            "data" => $lecturerPlots,
            "count" => count($lecturerPlots),

        ],200);
    }


    /**
     * Store a newly created resource in storage.
     * Allocate a lecturer to a specific sub_class
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function store(Request $request){
        $allocations = $request->get('data');

        \DB::beginTransaction();
        foreach ($allocations as $allocation){
            try {
                $this->lecturerPlotServices->checkLecturerAvailability($allocation['lecturer_id'], $allocation['academic_year_id'], $allocation['sub_class_id']);
                $this->lecturerPlotServices->checkPlotAvailability($allocation['sub_class_id'], $allocation['academic_year_id']);
                $this->lecturerPlotServices->allocateLecturer($allocation);
            } catch (ValidationException $e){
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
