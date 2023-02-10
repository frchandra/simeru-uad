<?php

namespace App\Http\Services;

use App\Http\Repository\OfferedSubClassRepository;

class OfferedSubClassService{
    private OfferedSubClassRepository $offeredSubClassRepository;

    public function __construct(OfferedSubClassRepository $offeredSubClassRepository){
        $this->offeredSubClassRepository = $offeredSubClassRepository;
    }

}
