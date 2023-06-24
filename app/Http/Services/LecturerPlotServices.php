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

    public function getByAcadYearSubClass($acadYearId, $subClass){
        return $this->lecturerPlotRepository->getByAcadYearSubClass($acadYearId, $subClass)->first();
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
        $lecturer = $this->lecturerPlotRepository->getLecturerBySemester($lecturerId, $semesterId)->first();
        //If the lecturer has not allocated for the semester then return true
        if($lecturer == null){
            return true;
        }
        //If the lecturer has surpassed the allowed credits then return error
        $classCredit = $this->subClassRepository->show($classId)->first()->toArray()['credit'];
        $lecturerCredit = $lecturer->credit;
        if( $lecturerCredit+$classCredit > 20){
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
        $subClass = $this->lecturerPlotRepository->getBySubClassSemester($subClassId, $semesterId)->first();
        //If there are no allocation (plot) then return true
        if($subClass == null){
            return true;
        }

        else{
            //If the allocation (plot) has been created return error
            throw ValidationException::withMessages([
                'messages' => [
                    ['description' => 'this class is has been allocated for lecturer with ID=' . $subClass->lecturer_id .' for this semester'],
                    ['lecturer_id' => $subClass->lecturer_id]]
            ]);
        }
    }

    public function checkPlotAvailabilityForUpdate($subClassId, $semesterId){
        $subClass = $this->lecturerPlotRepository->getBySubClassSemester($subClassId, $semesterId)->first();
        //If there are no allocation (plot) then return 0 because currently there are no allocated lecture_id for this plot
        if($subClass == null){
            return 0;
        }
        //If the allocation (plot) has been created return the current allocated lecture_id for this plot
        else{
            return $subClass->lecturer_id;
        }
    }

    public function allocateLecturer($allocation){
        //add is held field to the data
        $allocation['is_held'] = false;
        $data = $this->lecturerPlotRepository->createLecturerAllocation($allocation);
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



    public function allocateLecturerForUpdate($allocation, $prevLecturerId, $prevLecturerPlotId){
        //add is held field to the data
        $data = $this->lecturerPlotRepository->updateLecturerAllocation($allocation, $prevLecturerPlotId);
        $classCredit = $this->subClassRepository->show($allocation['sub_class_id'])->first()->toArray()['credit'];
        //Update (remove allocation) lecturer credit data for previous lecturer
        if($prevLecturerId != 0){
            //update previous lecturer data
            $this->lecturerPlotRepository->decrementLecturerCredit($prevLecturerId, $classCredit, 1);
        }
        //Update or insert lecturer credit data for new lecturer
        $lecturerCredit = $this->lecturerPlotRepository->isLecturerCreditExist($allocation['lecturer_id'], $allocation['academic_year_id']);
        if($lecturerCredit->count()<1){
            $this->lecturerPlotRepository->createLecturerCredit($allocation['lecturer_id'], 1, $allocation['academic_year_id'], $classCredit);
        } else {
            $this->lecturerPlotRepository->incrementLecturerCredit($allocation['lecturer_id'], $classCredit, 1);
        }
        return $data;
    }

    public function delete($lecturerId, $subClassId, $acadYearId){
        $this->lecturerPlotRepository->delete($lecturerId, $subClassId, $acadYearId);
    }
}
