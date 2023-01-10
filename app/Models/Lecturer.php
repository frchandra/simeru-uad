<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Lecturer
 *
 * @property int $lecturer_id
 * @property string $name
 * @property string $email
 * @property string $phone_num
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\LecturerFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Lecturer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Lecturer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Lecturer query()
 * @method static \Illuminate\Database\Eloquent\Builder|Lecturer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lecturer whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lecturer whereLecturerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lecturer whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lecturer wherePhoneNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lecturer whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Lecturer extends Model{
    use HasFactory;
    protected $primaryKey = 'lecturer_id';
    public $timestamps = true;
    protected $fillable = ['name', 'email', 'phone_num'];
    protected $hidden = ['created_at', 'updated_at'];


}
