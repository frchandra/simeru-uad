<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferSubClassRequest;
use App\Http\Services\OfferedSubClassService;
use App\Models\LecturerCredit;
use App\Models\LecturerPlot;
use App\Models\SubClass;
use Illuminate\Http\Request;

class OfferedSubClassController extends Controller{
    private OfferedSubClassService $offeredSubClassService;

    public function __construct(OfferedSubClassService $offeredSubClassService){
        $this->offeredSubClassService = $offeredSubClassService;
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(OfferSubClassRequest $request){
        $allocations = $request->get('data');
        foreach ($allocations as $allocation) {
            $this->offeredSubClassService->create($allocation['sub_class_id'], $allocation['academic_year_id']);
        }
        return response()->json([
            'status' => 'success'
        ], 201);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($acadYearId){
        $offered = $this->offeredSubClassService->getByAcadYearId($acadYearId);
        return response()->json([
            'status' => 'success',
            'data' => $offered
        ]);
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(OfferSubClassRequest $request){
        $allocations = $request->get('data');
        foreach ($allocations as $allocation) {
            $subClass = SubClass::whereSubClassId($allocation['sub_class_id'])->first();
            $lecturerPLot = LecturerPlot::whereSubClassId($allocation['sub_class_id'])->where('academic_year_id', '=', $allocation['academic_year_id'])->first();
            LecturerCredit::whereLecturerId($lecturerPLot->lecturer_id)->decrement('sub_class_count', 1);
            LecturerCredit::whereLecturerId($lecturerPLot->lecturer_id)->decrement('credit', $subClass->credit);
            $this->offeredSubClassService->delete($allocation['sub_class_id'], $allocation['academic_year_id']);
        }
        return response()->json([
            'status' => 'success'
        ], 201);
    }
}
