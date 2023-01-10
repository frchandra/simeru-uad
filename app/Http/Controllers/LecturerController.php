<?php

namespace App\Http\Controllers;

use App\Http\Services\LecturerServices;
use Illuminate\Http\Request;

class LecturerController extends Controller{
    private LecturerServices $lecturerService;

    public function __construct(LecturerServices $lecturerService){
        $this->lecturerService = $lecturerService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(){
        $lecturers = $this->lecturerService->getALl();
        return response()->json([
            'status' => 'success',
            'data' => $lecturers,
            'data_count' => count($lecturers)
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        //
    }
}
