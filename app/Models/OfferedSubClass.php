<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferedSubClass extends Model{
    use HasFactory;
    protected $table = 'offered_subclasses';
    protected $primaryKey = 'offered_subclasses_id';
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

