<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\SubClass
 *
 * @property int $sub_class_id
 * @property string $name
 * @property int $quota
 * @property int $credit
 * @property int $semester
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\SubClassFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|SubClass newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SubClass newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SubClass query()
 * @method static \Illuminate\Database\Eloquent\Builder|SubClass whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubClass whereCredit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubClass whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubClass whereQuota($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubClass whereSemester($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubClass whereSubClassId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubClass whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\LecturerPlot|null $lecturerPlot
 * @property int $course_id
 * @property-read \App\Models\Course $course
 * @method static \Illuminate\Database\Eloquent\Builder|SubClass whereCourseId($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\LecturerPlot[] $lecturerPlots
 * @property-read int|null $lecturer_plots_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OfferedSubClass[] $offeredSubClasses
 * @property-read int|null $offered_sub_classes_count
 */
class SubClass extends Model{
    use HasFactory;
    protected $table = 'sub_classes';
    protected $primaryKey = 'sub_class_id';
    public $timestamps = true;
    protected $fillable = ['name', 'quota', 'credit', 'semester'];
    protected $hidden = ['created_at', 'updated_at'];

    public function lecturerPlots(){
        return $this->hasMany(LecturerPlot::class, 'sub_class_id', 'sub_class_id');
    }

    public function offeredSubClasses(){
        return $this->hasMany(OfferedSubClass::class, 'sub_class_id', 'sub_class_id');
    }
}
