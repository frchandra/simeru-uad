<?php

namespace App\Http\Services;

use App\Http\Repository\LecturerRepository;
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
     * Update lecturer data
     *
     * @param int $id
     * @param array $newData
     * @return int
     * @throws ValidationException
     */
    public function update($id, $newData){
        try {
            $affected = $this->lecturerRepository->update($id, $newData);
        } catch (ValidationException $e){
            throw $e;
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
        try {
            $affected = $this->lecturerRepository->destroy($id);
        } catch (ValidationException $e){
            throw $e;
        }
        return $affected;
    }


}
