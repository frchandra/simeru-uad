<?php

namespace App\Http\Repository;
use App\Models\LecturerCredit;
use App\Models\LecturerPlot;
use Illuminate\Database\Eloquent\Collection;
use \Illuminate\Support\Facades\DB;


class LecturerPlotRepository{

    /**
     * Return lecturer_plots table joined with lecturers and sub_classes
     *
     * @param int $acadYearId
     * @return Collection
     */
    public function getJoinedByAcadYearId($acadYearId){
        $LecturePlots = DB::table('lecturer_plots')
            ->join('lecturers', 'lecturer_plots.lecturer_id', '=', 'lecturers.lecturer_id')
            ->join('sub_classes', 'lecturer_plots.sub_class_id', '=', 'sub_classes.sub_class_id')
            ->select(
                'lecturers.lecturer_id',
                'sub_classes.sub_class_id',
                'lecturers.name as lecturer_name',
                'sub_classes.name as sub_classes_name',
                'sub_classes.quota',
                'sub_classes.credit',
                'sub_classes.semester',
                'lecturer_plots.is_held',
            )
            ->where('lecturer_plots.academic_year_id', '=', $acadYearId)
            ->get();
        return $LecturePlots;
    }

    /**
     * Return lecturer data for a semester
     *
     * @param int $lecturerId
     * @param int $semesterId
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|LecturerCredit|object
     */
    public function getLecturerBySemester($lecturerId, $semesterId){
        return LecturerCredit::whereLecturerId($lecturerId)->where('academic_year_id', '=', $semesterId)->first();
    }


    /**
     * Return lecturer data for a semester
     *
     * @param int $semesterId
     * @param int $subClassId
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|LecturerPlot|object
     */
    public function getBySubClassSemester($subClassId, $semesterId){
        return LecturerPlot::whereAcademicYearId($semesterId)->where('sub_class_id', '=', $subClassId)->first();
    }


    public function allocateLecturer($allocation){
        return LecturerPlot::create($allocation);
    }

    public function isLecturerCreditExist($lectureId, $semesterId){
        return LecturerCredit::where([
                'lecturer_id' => $lectureId,
                'academic_year_id' => $semesterId,
            ])->get();
    }

    public function createLecturerCredit($lectureId, $classCount, $semesterId, $credit){
        return LecturerCredit::create([
            'lecturer_id' => $lectureId,
            'sub_class_count' => $classCount,
            'academic_year_id' => $semesterId,
            'credit' => $credit,
        ]);
    }

    public function incrementLecturerCredit($lecturerId, $credit, $classCount){
        DB::table('lecturer_credits')->where('lecturer_id', '=', $lecturerId)->update(['credit' => DB::raw('credit + '.strval($credit))]);
        DB::table('lecturer_credits')->where('lecturer_id', '=', $lecturerId)->update(['sub_class_count' => DB::raw('sub_class_count + '.strval($classCount))]);
    }


    /**
     *
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|LecturerPlot|object
     */
    public function getByIdSemester($id, $semesterId){
        return LecturerPlot::whereLecturerPlotId($id)->where('academic_year_id', '=', $semesterId)->first();
    }
}
