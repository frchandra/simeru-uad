<?php

namespace App\Http\Controllers;

use App\Http\Repository\RoomTimeRepository;
use App\Http\Requests\RoomTimeStoreRequest;
use App\Http\Services\RoomTimeServices;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class RoomTimeController extends Controller{
    private RoomTimeServices $roomTimeServices;

    public function __construct(RoomTimeServices $roomTimeServices){
        $this->roomTimeServices = $roomTimeServices;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(){
        $roomTimes = $this->roomTimeServices->getAll();
        return response()->json([
            "status" => "success",
            "data" => $roomTimes,
        ]);

    }

    public function getHelper(){
        $roomTimesHelper = $this->roomTimeServices->getAllHelper();
        return response()->json([
            "status" => "success",
            "data" => $roomTimesHelper,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(RoomTimeStoreRequest $request){
        $allocations = $request->get('data');
        \DB::beginTransaction();
        foreach ($allocations as $allocation){
            try {
                $this->roomTimeServices->create($allocation);
            } catch (ValidationException $e){
                \DB::rollBack();
                return response()->json([
                    "status" => "fail",
                    "message" => $e->errors()['messages'],
                ]);
            }
        }
        \DB::commit();
        return response()->json([
            "status" => "success"
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $acadYearId
     * @return \Illuminate\Http\Response
     */
    public function show($acadYearId){
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id){

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(RoomTimeStoreRequest $request){
        $allocations = $request->get('data');
        foreach ($allocations as $allocation){
            try {
                $this->roomTimeServices->delete($allocation);
            } catch (ValidationException $e){
                return response()->json([
                    "status" => "fail",
                    "message" => $e->errors()['messages'],
                ]);
            }
        }

        return response()->json([
            "status" => "success"
        ], 201);

    }
}
