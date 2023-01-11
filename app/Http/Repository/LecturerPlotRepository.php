<?php

namespace App\Http\Repository;
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
            ->join('lecturers', 'lecturer_plots.lecturer_plot_id', '=', 'lecturer_plots.lecturer_plot_id')
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


}
