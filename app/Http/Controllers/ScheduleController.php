<?php

namespace App\Http\Controllers;

use App\Http\Services\ScheduleServices;
use Illuminate\Http\Request;

class ScheduleController extends Controller{
    private ScheduleServices $scheduleServices;

    public function __construct(ScheduleServices $scheduleServices){
        $this->scheduleServices = $scheduleServices;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $allocations = $request->get('data');

        foreach ($allocations as $allocation) {

        }

        //untuk setiap request
            //start tx
            //cek apakah dosen telah mengajar di sesi yang sama
            //cek apakah kapasitas ruang waktu mencukupi
            //cek duplikasi mk ruang
            //end tx
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
