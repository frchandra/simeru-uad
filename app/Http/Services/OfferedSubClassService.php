<?php

namespace App\Http\Services;

use App\Http\Repository\OfferedSubClassRepository;

class OfferedSubClassService{
    private OfferedSubClassRepository $offeredSubClassRepository;

    public function __construct(OfferedSubClassRepository $offeredSubClassRepository){
        $this->offeredSubClassRepository = $offeredSubClassRepository;
    }

    public function create($subClassId, $acadYearId){
        $this->offeredSubClassRepository->create($subClassId, $acadYearId);
    }

    public function delete($subClassId, $acadYearId){
        $this->offeredSubClassRepository->delete($subClassId, $acadYearId);
    }

    public function getByAcadYearId($acadYearId){
        return $this->offeredSubClassRepository->getByAcadYearId($acadYearId)->toArray();
    }

}
