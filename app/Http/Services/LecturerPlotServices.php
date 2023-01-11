<?php

namespace App\Http\Services;

use App\Http\Repository\LecturerPlotRepository;
use App\Models\LecturerPlot;
use Illuminate\Database\Eloquent\Collection;


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

}
