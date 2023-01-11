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
 */
class AcademicYear extends Model{
    use HasFactory;
    protected $table = 'academic_years';
    protected $primaryKey = 'academic_year_id';
    public $timestamps = true;

}
