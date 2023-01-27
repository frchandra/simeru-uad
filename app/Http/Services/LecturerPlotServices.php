<?php

namespace App\Http\Services;

use App\Http\Repository\LecturerPlotRepository;
use App\Http\Repository\SubClassRepository;
use Illuminate\Validation\ValidationException;


class LecturerPlotServices{
    private LecturerPlotRepository $lecturerPlotRepository;
    private SubClassRepository $subClassRepository;

    public function __construct(LecturerPlotRepository $lecturerPlotRepository, SubClassRepository $subClassRepository){
        $this->lecturerPlotRepository = $lecturerPlotRepository;
        $this->subClassRepository = $subClassRepository;
    }

    /**
     * Return lecturer_plots table joined with lecturers and sub_classes
     *
     * @param  int $acadYearId
     * @return array
     */
    public function getJoinedByAcadYearId($acadYearId){
        return $this->lecturerPlotRepository->getJoinedByAcadYearId($acadYearId)->toArray();
    }


    /**
     * Check if the lecturer allocation is eligible
     *
     * @param int $lecturerId
     * @param int $semesterId
     * @throws ValidationException
     * @return boolean
     */
    public function checkLecturerAvailability($lecturerId, $semesterId, $classId){
        $lecturer = $this->lecturerPlotRepository->getLecturerBySemester($lecturerId, $semesterId);
        //If the lecturer has not allocated for the semester then return true
        if($lecturer == null){
            return true;
        }
        //If the lecturer has surpassed the allowed credits then return error
        $classCredit = $this->subClassRepository->show($classId)->first()->toArray()['credit'];
        $lecturerCredit = $lecturer->credit;
        if( $lecturerCredit+$classCredit > 6){
            throw ValidationException::withMessages([
                'messages' => [
                    ['description' => 'this lecturer is already take ' . $lecturerCredit . ' credit. Cant take another '. $classCredit .' credit'],
                    ['lecturer_id' => $lecturer->lecturer_id]
                ]
            ]);
        }
        return true;
    }

    /**
     * Check if the allocation (plot) already created
     *
     * @param int $subClassId
     * @param int $semesterId
     * @throws ValidationException
     * @return boolean
     */
    public function checkPlotAvailability($subClassId, $semesterId){
        $subClass = $this->lecturerPlotRepository->getBySubClassSemester($subClassId, $semesterId);
        //If there are no allocation (plot) then return true
        if($subClass == null){
            return true;
        }
        //If the allocation (plot) has been created return error
        else{
            throw ValidationException::withMessages([
                'messages' => [
                    ['description' => 'this class is has been allocated for lecturer with ID=' . $subClass->lecturer_id .' for this semester'],
                    ['lecturer_id' => $subClass->lecturer_id]]
            ]);
        }
    }

    public function allocateLecturer($allocation){
        //add is held field to the data
        $allocation['is_held'] = false;
        $data = $this->lecturerPlotRepository->allocateLecturer($allocation);
        //Update or insert lecturer credit data
        $classCredit = $this->subClassRepository->show($allocation['sub_class_id'])->first()->toArray()['credit'];
        $lecturerCredit = $this->lecturerPlotRepository->isLecturerCreditExist($allocation['lecturer_id'], $allocation['academic_year_id']);
        if($lecturerCredit->count()<1){
            $this->lecturerPlotRepository->createLecturerCredit($allocation['lecturer_id'], 1, $allocation['academic_year_id'], $classCredit);
        } else {
            $this->lecturerPlotRepository->incrementLecturerCredit($allocation['lecturer_id'], $classCredit, 1);
        }
        return $data;
    }
}
