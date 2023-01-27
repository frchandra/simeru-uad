<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\LecturerCredit
 *
 * @property int $lecturer_credit_id
 * @property int $lecturer_id
 * @property int $academic_year_id
 * @property string $name
 * @property int $credit
 * @property int $sub_class_count
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\AcademicYear $academicYears
 * @method static \Illuminate\Database\Eloquent\Builder|LecturerCredit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LecturerCredit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LecturerCredit query()
 * @method static \Illuminate\Database\Eloquent\Builder|LecturerCredit whereAcademicYearId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LecturerCredit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LecturerCredit whereCredit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LecturerCredit whereLecturerCreditId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LecturerCredit whereLecturerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LecturerCredit whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LecturerCredit whereSubClassCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LecturerCredit whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Lecturer $lecturer
 */
class LecturerCredit extends Model{
    use HasFactory;
    protected $table = 'lecturer_credits';
    protected $primaryKey = 'lecturer_credit_id';
    public $timestamps = true;
    protected $fillable = ['lecturer_id', 'credit', 'sub_class_count', 'academic_year_id'];
    protected $hidden = ['created_at', 'updated_at'];

    public function academicYears(){
        return $this->belongsTo(AcademicYear::class, 'academic_year_id', 'academic_year_id');
    }

    public function lecturer(){
        return $this->belongsTo(Lecturer::class, 'lecturer_id', 'lecturer_id');
    }
}
