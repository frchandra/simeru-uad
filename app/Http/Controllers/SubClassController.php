<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubClassStoreRequest;
use App\Http\Services\SubClassServices;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SubClassController extends Controller{
    private SubClassServices $subClassServices;

    public function __construct(SubClassServices $subClassServices){
        $this->subClassServices = $subClassServices;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(){
        $subClasses = $this->subClassServices->getALl();
        return response()->json([
            'status' => 'success',
            'data' => $subClasses,
            'data_count' => count($subClasses)
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(SubClassStoreRequest $request){
        $newSubClass = $request->only(['name', 'course_name',  'quota', 'credit', 'semester']);
        $result = $this->subClassServices->createNew($newSubClass);
        if($result){
            return response()->json([
                'status' => 'success',
                'data' => $newSubClass
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id){
        try {
            $subClass = $this->subClassServices->show($id);
        } catch (ValidationException $e){
            return response()->json([
                'status' => 'fail',
                'error_message' => $e->errors()['message']
            ], 214);
        }
        return response()->json([
            'status' => 'success',
            'data' => $subClass
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id){
        $newData = $request->only(['name', 'quota', 'credit', 'semester']);
        try {
            $affected = $this->subClassServices->update($id, $newData);

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
            $affected = $this->subClassServices->destroy($id);

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
