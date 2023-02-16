<?php

namespace App\Http\Controllers;


use App\Http\Services\RoomServices;
use Illuminate\Http\Request;

class RoomController extends Controller{
    private RoomServices $roomServices;

    public function __construct(RoomServices $roomServices){
        $this->roomServices = $roomServices;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(){
        $room = $this->roomServices->getALl();
        return response()->json([
            'status' => 'success',
            'data' => $room,
            'data_count' => count($room)
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request){
        $newRooms = $request->get('data');
        foreach ($newRooms as $newRoom){
            $this->roomServices->create($newRoom['name'], $newRoom['quota']);
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
    public function show($id){
        $data = $this->roomServices->getByAcadYearId($id);
        return response()->json([
            'status' => 'success',
            'data' => $data,
        ], 201);
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
    public function destroy($id){
        $this->roomServices->delete($id);
        return response()->json([
            'status' => 'success'
        ], 200);
    }
}
