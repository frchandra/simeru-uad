<?php

namespace App\Http\Repository;

use App\Models\AcademicYear;
use App\Models\Room;
use App\Models\RoomTimeHelper;
use Illuminate\Support\Collection;
use Spatie\QueryBuilder\QueryBuilder;

class RoomRepository{
    /**
     * Get all room data
     *
     * @return Collection
     */
    public function getAll(){
        return QueryBuilder::for(Room::class)->allowedFilters(['room_id','name','quota'])->get();
    }

    public function getByAcadYearId($id){
        return Room::whereRoomId($id)->get();
    }

    public function create($name, $quota){
        $result = Room::create([
            'name' => $name,
            'quota' => $quota,
        ]);

        //get latest academic year id
        $acadYearId = AcademicYear::orderByDesc('created_at')->first();

        for($j=1; $j<=6; $j++){ //hari
            for($k=1; $k<=12; $k++){ // sesi
                RoomTimeHelper::create([
                    "room_id" => $result->room_id,
                    "time_id" => (($j-1)*12)+$k,
                    "academic_year_id" => $acadYearId->academic_year_id,
                    "is_occupied" => false,
                    "is_possible" => false,
                ]);
            }
        }
    }

    public function delete($id){
        Room::whereRoomId($id)->delete();
        //get latest academic year id
        $acadYearId = AcademicYear::orderByDesc('created_at')->first();
        RoomTimeHelper::whereRoomId($id)->where('academic_year_id', '=', $acadYearId->academic_year_id)->delete();
    }
}
