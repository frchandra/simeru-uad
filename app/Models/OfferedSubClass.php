<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\OfferedSubClass
 *
 * @property-read \App\Models\AcademicYear $academicYear
 * @property-read \App\Models\SubClass $subClass
 * @method static \Illuminate\Database\Eloquent\Builder|OfferedSubClass newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OfferedSubClass newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OfferedSubClass query()
 * @mixin \Eloquent
 * @property int $offered_sub_class_id
 * @property int $sub_class_id
 * @property int $academic_year_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|OfferedSubClass whereAcademicYearId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OfferedSubClass whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OfferedSubClass whereOfferedSubClassId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OfferedSubClass whereSubClassId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OfferedSubClass whereUpdatedAt($value)
 */
class OfferedSubClass extends Model{
    use HasFactory;
    protected $table = 'offered_sub_classes';
    protected $primaryKey = 'offered_sub_class_id';
    public $timestamps = true;
    protected $fillable = ['sub_class_id', 'academic_year_id'];
    protected $hidden = ['created_at', 'updated_at'];

    public function subClass(){
        return $this->belongsTo(SubClass::class, 'sub_class_id', 'sub_class_id');
    }

    public function academicYear(){
        return $this->belongsTo(AcademicYear::class, 'academic_year_id', 'academic_year_id');
    }
}

