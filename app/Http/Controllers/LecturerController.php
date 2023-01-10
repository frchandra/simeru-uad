<?php

namespace App\Http\Controllers;

use App\Http\Requests\LecturerStoreRequest;
use App\Http\Requests\LecturerUpdateRequest;
use App\Http\Services\LecturerServices;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

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
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(LecturerStoreRequest $request){
        $newLecturer = $request->toArray();
        $result = $this->lecturerService->createNew($newLecturer);
        if($result){
            return response()->json([
                'status' => 'success',
                'data' => $newLecturer
            ], 201);
        } else {
            return response()->json([
                'status' => 'fail',
                'error_message' => 'fail to insert new data'
            ], 500);
        }
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(LecturerUpdateRequest $request, $id){
        $newData = $request->toArray();
        try {
            $affected = $this->lecturerService->update($id, $newData);

        } catch (ValidationException $e){
            return response()->json([
                'status' => 'fail',
                'error_message' => $e->errors()['message']
            ], 214);
        }
        return response()->json([
            'status' => 'success',
            'affected' => $affected
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id){
        try {
            $affected = $this->lecturerService->destroy($id);

        } catch (ValidationException $e){
            return response()->json([
                'status' => 'fail',
                'error_message' => $e->errors()['message']
            ], 214);
        }
        return response()->json([
            'status' => 'success',
            'affected' => $affected
        ]);
    }
}
