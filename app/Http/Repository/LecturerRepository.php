<?php

namespace App\Http\Repository;

use App\Models\Lecturer;
use Illuminate\Support\Collection;
use Spatie\QueryBuilder\QueryBuilder;

class LecturerRepository{
    /**
     * Get all lecturers data
     *
     * @return Collection
     */
    public function getAll(){
        return QueryBuilder::for(Lecturer::class)->allowedFilters(['lecturer_id','name'])->get();
    }
}
