<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\LecturerPlot
 *
 * @method static \Database\Factories\LecturerPlotFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|LecturerPlot newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LecturerPlot newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LecturerPlot query()
 * @mixin \Eloquent
 * @property int $lecturer_plot_id
 * @property int $lecturer_id
 * @property int $sub_class_id
 * @property int $academic_year_Id
 * @property int $is_held
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\AcademicYear $academicYear
 * @property-read \App\Models\Lecturer $lecturer
 * @property-read \App\Models\SubClass $subClass
 * @method static \Illuminate\Database\Eloquent\Builder|LecturerPlot whereAcademicYearId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LecturerPlot whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LecturerPlot whereIsHeld($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LecturerPlot whereLecturerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LecturerPlot whereLecturerPlotId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LecturerPlot whereSubClassId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LecturerPlot whereUpdatedAt($value)
 */
class LecturerPlot extends Model{
    use HasFactory;
    protected $table = 'lecturer_plots';
    protected $primaryKey = 'lecturer_plot_id';
    public $timestamps = true;
    protected $fillable = ['lecturer_id', 'sub_class_id', 'academic_year_id', 'is_held'];
    protected $hidden = ['created_at', 'updated_at'];

    public function lecturer(){
        return $this->belongsTo(Lecturer::class, 'lecturer_id', 'lecturer_id');
    }

    public function subClass(){
        return $this->belongsTo(SubClass::class, 'sub_class_id', 'sub_class_id');
    }

    public function academicYear(){
        return $this->belongsTo(AcademicYear::class, 'academic_year_id', 'academic_year_id');
    }

    public function schedule(){
        return $this->hasOne(Schedule::class, 'lecturer_plot_id', 'lecturer_plot_id');
    }
}
