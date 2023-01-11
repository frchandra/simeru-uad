<?php

namespace App\Http\Services;

use App\Http\Repository\SubClassRepository;

class SubClassServices{
    private SubClassRepository $subClassRepository;

    public function __construct(SubClassRepository $subClassRepository){
        $this->subClassRepository = $subClassRepository;
    }

    /**
     * Get all SubClasses data
     *
     * @return array
     */
    public function getAll(){
        return $this->subClassRepository->getAll()->toArray();
    }

    /**
     * Create new lecturer entry
     *
     * @param array $newLecturer
     * @return \App\Models\Lecturer|\Illuminate\Database\Eloquent\Model
     */
    public function createNew($newLecturer){
        return $this->subClassRepository->createNew($newLecturer);
    }
}
