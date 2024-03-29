<?php

namespace App\Http\Controllers;


use App\Http\Services\LecturerPlotServices;
use App\Models\Schedule;
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request){
        $allocations = $request->get('data');
        \DB::beginTransaction();
        foreach ($allocations as $allocation){//TODO: change lecturer on schedule (done, needs to be test)
            try {
                $prevPlot = $this->lecturerPlotServices->getByAcadYearSubClass($allocation['academic_year_id'], $allocation['sub_class_id']);
                if(empty($prevPlot)){ //If prev plot is empty then insert the data as usual
                    $this->lecturerPlotServices->checkLecturerAvailability($allocation['lecturer_id'], $allocation['academic_year_id'], $allocation['sub_class_id']);
                    $this->lecturerPlotServices->checkPlotAvailability($allocation['sub_class_id'], $allocation['academic_year_id']);
                    $this->lecturerPlotServices->allocateLecturer($allocation);
                } else { //if prev plot exist then update lecturer field with the new lecturer
                    $this->lecturerPlotServices->checkLecturerAvailability($allocation['lecturer_id'], $allocation['academic_year_id'], $allocation['sub_class_id']);
                    $lecturerId = $this->lecturerPlotServices->checkPlotAvailabilityForUpdate($allocation['sub_class_id'], $allocation['academic_year_id']);
                    $this->lecturerPlotServices->allocateLecturerForUpdate($allocation, $lecturerId, $prevPlot->lecturer_plot_id);
                    Schedule::whereLecturerId($prevPlot->lecturer_id)->where('academic_year_id', '=', $allocation['academic_year_id'])->where('sub_class_id', '=', $allocation['sub_class_id'])->update(['lecturer_id' => $allocation]);
                }
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
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request){
        $allocations = $request->get('data');
        foreach ($allocations as $allocation) {
            $this->lecturerPlotServices->delete($allocation['lecturer_id'], $allocation['sub_class_id'], $allocation['academic_year_id']);
        }
        return response()->json([
            "status" => "success",
        ], 201);
    }
}
