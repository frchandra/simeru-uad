<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Time
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Time newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Time newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Time query()
 * @mixin \Eloquent
 * @property int $time_id
 * @property int $day
 * @property int $session
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Time whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Time whereDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Time whereSession($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Time whereTimeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Time whereUpdatedAt($value)
 */
class Time extends Model{
    use HasFactory;
    protected $table = 'times';
    protected $primaryKey = 'times_id';
    public $timestamps = true;
    protected $fillable = ['day', 'session'];
    protected $hidden = ['created_at', 'updated_at'];

    public function roomTimes(){
        return $this->hasMany(RoomTime::class, 'room_id', 'room_id');
    }
}
