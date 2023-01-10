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
     * Update lecturer data
     *
     * @param int $id
     * @param array $newData
     * @return int
     * @throws ValidationException
     */
    public function update($id, $newData){
        $affected =  Lecturer::where('lecturer_id', $id)->update($newData);
        if($affected < 1){
            throw ValidationException::withMessages(['message' => 'cannot find the corresponding lecturer for the given lecturer_id']);
        }
        return $affected;
    }

    /**
     * Delete lecturer data
     *
     * @param int $id
     * @throws ValidationException
     * @return int
     */
    public function destroy($id){
        $affected = Lecturer::destroy($id);
        if($affected < 1){
            throw ValidationException::withMessages(['message' => 'cannot find the corresponding lecturer for the given lecturer_id']);
        }
        return $affected;
    }
}
