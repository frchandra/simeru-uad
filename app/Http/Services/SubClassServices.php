<?php

namespace App\Http\Services;

use App\Http\Repository\SubClassRepository;

class SubClassServices{
    private SubClassRepository $subClassRepository;

    public function __constructor(SubClassRepository $subClassRepository){
        $this->subClassRepository = $subClassRepository;
    }
}
