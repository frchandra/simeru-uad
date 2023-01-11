<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LecturerCredit extends Model{
    use HasFactory;
    protected $table = 'lecturer_credits';
    protected $primaryKey = 'lecturer_credit_id';
    public $timestamps = true;
    protected $fillable = ['lecturer_id', 'name', 'credit', 'sub_class_count'];
    protected $hidden = ['created_at', 'updated_at'];

    public function academicYears(){
        return $this->belongsTo(AcademicYear::class, 'academic_year_id', 'academic_year_id');
    }
}
