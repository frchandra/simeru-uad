<?php

namespace App\Http\Controllers;


use App\Http\Services\LecturerPlotServices;
use Illuminate\Http\Request;

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

    public function allocateLecturer(Request $request){
        $allocations = $request->get('data');

        //start transaction
            //untuk semua element dalam array
                //cek table lecture_credit untuk mengetahui apakah sks dosen masih cukup
                //cek apakah ada lecturer_id yang sama untuk sub_class_id yang berbeda (tidak boleh ada sub_class yang diampu dua dosen sekaligus)
                //insert data baru ke lecturer_plots
        //end transaaction

        foreach ($allocations as $allocation){

        }



        return response()->json([
            "data" => $allocation,
            "type" => var_export($allocation, true)
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
