<?php

namespace App\Http\Repository;

use App\Models\OfferedSubClass;
use function Symfony\Component\String\s;

class OfferedSubClassRepository{
    public function create($subClassId, $acadYearId){
        OfferedSubClass::create([
            "sub_class_id" => $subClassId,
            "academic_year_id" => $acadYearId
        ]);
    }

    public function delete($subClassId, $acadYearId){
        OfferedSubClass::whereSubClassId($subClassId)->where('academic_year_id', '=', $acadYearId)->delete();
    }

    public function getByAcadYearId($acadYearId){
        return OfferedSubClass::join('sub_classes', 'sub_classes.sub_class_id', '=', 'offered_sub_classes.sub_class_id')->where('academic_year_id', '=', $acadYearId)->get();
    }
}
