<?php

namespace App\Http\Services;

use App\Http\Repository\LecturerRepository;
use Illuminate\Support\Collection;
use Illuminate\Validation\ValidationException;

class LecturerServices{
    private LecturerRepository $lecturerRepository;

    public function __construct(LecturerRepository $lecturerRepository){
        $this->lecturerRepository = $lecturerRepository;
    }


    /**
     * Get all lecturers data
     *
     * @return array
     */
    public function getAll(){
        return $this->lecturerRepository->getAll()->toArray();
    }

    /**
     * Create new lecturer entry
     *
     * @param array $newLecturer
     * @return \App\Models\Lecturer|\Illuminate\Database\Eloquent\Model
     */
    public function createNew($newLecturer){
        return $this->lecturerRepository->createNew($newLecturer);
    }

    /**
     * Show one lecturer data
     *
     * @param int
     * @return array
     * @throws ValidationException
     */
    public function show($id){
        $lecture =  $this->lecturerRepository->show($id);
        if($lecture->count()<1){
            throw  ValidationException::withMessages(['message' => 'cannot find the corresponding lecturer for the given lecturer_id']);
        }
        return $lecture->toArray();
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
        $affected = $this->lecturerRepository->update($id, $newData);
        if($affected < 1) {
            throw ValidationException::withMessages(['message' => 'cannot find the corresponding lecturer for the given lecturer_id']);
        }
        return $affected;
    }


    /**
     * Update lecturer data
     *
     * @param int $id
     * @return int
     * @throws ValidationException
     */
    public function destroy($id){
        $affected = $this->lecturerRepository->destroy($id);
        if($affected < 1){
            throw ValidationException::withMessages(['message' => 'cannot find the corresponding lecturer for the given lecturer_id']);
        }
        return $affected;
    }

}
