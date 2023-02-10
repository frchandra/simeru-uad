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
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\LecturerCredit[] $lecturerCredits
 * @property-read int|null $lecturer_credits_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\LecturerPlot[] $lecturerPlots
 * @property-read int|null $lecturer_plots_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\RoomTime[] $roomTimes
 * @property-read int|null $room_times_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Schedule[] $schedules
 * @property-read int|null $schedules_count
 */
class AcademicYear extends Model{
    use HasFactory;
    protected $table = 'academic_years';
    protected $primaryKey = 'academic_year_id';
    public $timestamps = true;

    public function lecturerPlots(){
        return $this->hasMany(LecturerPlot::class, 'academic_year_id', 'academic_year_id');
    }

    public function offeredSuubClasses(){
        return $this->hasMany(LecturerPlot::class, 'academic_year_id', 'academic_year_id');
    }

    public function lecturerCredits(){
        return $this->hasMany(LecturerCredit::class, 'academic_year_id', 'academic_year_id');
    }

    public function schedules(){
        return $this->hasMany(Schedule::class, 'academic_year_id', 'academic_year_id');
    }

    public function roomTimes(){
        return $this->hasMany(RoomTime::class, 'academic_year_id', 'academic_year_id');
    }



}
