<?php

namespace App\Http\Repository;

use App\Models\Lecturer;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
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


    /**
     * Create new lecturer data
     *
     * @param array $newLecturer
     * @return \Illuminate\Database\Eloquent\Model|Lecturer
     */
    public function createNew($newLecturer){
        return Lecturer::create($newLecturer);
    }


    /**
     * Show one lecturer data
     *
     * @param int
     * @return Collection
     */
    public function show($id){
        return Lecturer::whereLecturerId($id)->get();
    }


    /**
     * Update lecturer data
     *
     * @param int $id
     * @param array $newData
     * @return int
     */
    public function update($id, $newData){
        return Lecturer::where('lecturer_id', $id)->update($newData);
    }

    /**
     * Update lecturer data
     *
     * @param int $id
     * @return int
     */
    public function destroy($id){
        return Lecturer::destroy($id);
    }
}
