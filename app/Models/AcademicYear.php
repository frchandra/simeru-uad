<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AcademicYear
 *
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicYear newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicYear newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicYear query()
 * @mixin \Eloquent
 * @property int $academic_year_id
 * @property int $start_year
 * @property int $end_year
 * @property int $semester
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicYear whereAcademicYearId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicYear whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicYear whereEndYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicYear whereSemester($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicYear whereStartYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicYear whereUpdatedAt($value)
 */
class AcademicYear extends Model{
    use HasFactory;
    protected $table = 'academic_years';
    protected $primaryKey = 'academic_year_id';
    public $timestamps = true;

    public function lecturerPlots(){
        return $this->hasMany(LecturerPlot::class, 'academic_year_id', 'academic_year_id');
    }



}
