<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Schedule
 *
 * @property-read \App\Models\AcademicYear $academicYear
 * @property-read \App\Models\LecturerPlot|null $lecturerPlot
 * @property-read \App\Models\RoomTime|null $roomTime
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule query()
 * @mixin \Eloquent
 * @property int $schedule_id
 * @property int $lecturer_plot_id
 * @property int $room_time_id
 * @property int $academic_year_id
 * @property int $lecturer_id
 * @property int $sub_class_id
 * @property int $room_id
 * @property int $time_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereAcademicYearId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereLecturerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereLecturerPlotId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereRoomId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereRoomTimeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereScheduleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereSubClassId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereTimeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereUpdatedAt($value)
 * @property int $course_id
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereCourseId($value)
 * @property int $sub_class_semester
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereSubClassSemester($value)
 */
class Schedule extends Model{
    use HasFactory;
    protected $table = 'schedules';
    protected $primaryKey = 'schedule_id';
    public $timestamps = true;
    protected $fillable = ['academic_year_id', 'lecturer_plot_id', 'room_time_id', 'lecturer_id', 'sub_class_id', 'sub_class_semester', 'room_id', 'time_id'];
    protected $hidden = ['created_at', 'updated_at'];

    public function academicYear(){
        return $this->belongsTo(AcademicYear::class, 'academic_year_id', 'academic_year_id');
    }

    public function lecturerPlot(){
        return $this->belongsTo(LecturerPlot::class, 'lecturer_plot_id', 'lecturer_plot_id');
    }

    public function roomTime(){
        return $this->belongsTo(RoomTime::class, 'room_time_id', 'room_time_id');
    }

}
