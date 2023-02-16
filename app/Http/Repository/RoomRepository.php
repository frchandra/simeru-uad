<?php

namespace App\Http\Repository;

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

    public function create($name, $quota){
        $result = Room::create([
            'name' => $name,
            'quota' => $quota,
        ]);

        for($j=1; $j<=6; $j++){ //hari
            for($k=1; $k<=4; $k++){ // sesi
                RoomTimeHelper::create([
                    "room_id" => $result->room_id,
                    "time_id" => (($j-1)*4)+$k,
                    "academic_year_id" => 1,
                    "is_occupied" => false,
                    "is_possible" => false,
                ]);
            }
        }
    }

    public function delete($id){
        Room::whereRoomId($id)->delete();
//        RoomTimeHelper::whereRoomId($id)->delete();
    }
}
