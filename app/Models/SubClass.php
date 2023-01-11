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
 */
class SubClass extends Model{
    use HasFactory;
    protected $table = 'sub_classes';
    protected $primaryKey = 'sub_class_id';
    public $timestamps = true;
    protected $fillable = ['name', 'quota', 'credit', 'semester'];
    protected $hidden = ['created_at', 'updated_at'];

    public function lecturerPlot(){
        return $this->hasOne(LecturerPlot::class, 'sub_class_id', 'sub_class_id');
    }
}
