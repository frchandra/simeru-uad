<?php

namespace App\Http\Services;

use App\Http\Repository\LecturerRepository;

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


}
