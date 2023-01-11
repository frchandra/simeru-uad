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
 */
class LecturerPlot extends Model{
    use HasFactory;
    use HasFactory;
    protected $table = 'lecturer_plots';
    protected $primaryKey = 'lecturer_plot_id';
    public $timestamps = true;
    protected $fillable = ['lecturer_id', 'sub_class_id', 'academic_year_id'];
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
}
