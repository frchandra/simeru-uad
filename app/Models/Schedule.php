<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model{
    use HasFactory;
    protected $table = 'schedule_plots';
    protected $primaryKey = 'schedule_plot_id';
    public $timestamps = true;
    protected $fillable = ['academic_year_id', 'lecturer_plot_id', 'time_room_id', 'lecturer_id', 'sub_class_id', 'room_id', 'time_id'];
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
