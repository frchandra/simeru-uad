<?php

namespace App\Http\Repository;

use App\Models\Room;
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
}
