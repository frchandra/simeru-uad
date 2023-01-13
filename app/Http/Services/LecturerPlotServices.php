<?php

namespace App\Http\Services;

use App\Http\Repository\LecturerPlotRepository;
use App\Models\LecturerPlot;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\ValidationException;


class LecturerPlotServices{
    private LecturerPlotRepository $lecturerPlotRepository;

    public function __construct(LecturerPlotRepository $lecturerPlotRepository){
        $this->lecturerPlotRepository = $lecturerPlotRepository;
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
    public function checkLecturerAvailability($lecturerId, $semesterId){
        $lecturer = $this->lecturerPlotRepository->getLecturerBySemester($lecturerId, $semesterId);
        //If the lecturer has not allocated for the semester then return true
        if($lecturer == null){
            return true;
        }
        //If the lecturer for the semester has been allocated then return error
        if($lecturerId != null){
            throw ValidationException::withMessages(['messages' => 'this lecturer is already created for this semester']);
        }
        //If the lecturer has surpassed the allowed credits then return error
        $credit = $lecturer->credit;
        if( $credit > 12){
            throw ValidationException::withMessages(['messages' => 'this lecturer is already take ' . $credit . ' credit']); //TODO: make the credit value dynamic
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
        if($subClass != null){
            throw ValidationException::withMessages(['messages' => 'this class is has been allocated for lecturer with ID=' . $subClass->lecturer_id .' for this semester']);
        }
        return true;
    }

    public function allocateLecturer($allocation){
        $allocation['is_held'] = false;
//        return $allocation;
        return $this->lecturerPlotRepository->allocateLecturer($allocation);
    }



}
