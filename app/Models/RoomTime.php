<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\RoomTime
 *
 * @property int $room_times_id
 * @property int $time_id
 * @property int $academic_year_id
 * @property int $is_occupied
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|RoomTime newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RoomTime newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RoomTime query()
 * @method static \Illuminate\Database\Eloquent\Builder|RoomTime whereAcademicYearId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoomTime whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoomTime whereIsOccupied($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoomTime whereTimeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoomTime whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $room_time_id
 * @property int $room_id
 * @property-read \App\Models\AcademicYear $academicYear
 * @property-read \App\Models\Room $room
 * @property-read \App\Models\Schedule|null $shcedule
 * @property-read \App\Models\Time $time
 * @method static \Illuminate\Database\Eloquent\Builder|RoomTime whereRoomId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoomTime whereRoomTimeId($value)
 */
class RoomTime extends Model{
    use HasFactory;
    protected $table='room_times';
    protected $primaryKey = 'room_time_id';
    public $timestamps = true;
    protected $fillable = ['room_id', 'time_id', 'academic_year_id', 'is_occupied'];
    protected $hidden = ['created_at', 'updated_at'];

    public function room(){
        return $this->belongsTo(Room::class, 'room_id', 'room_id');
    }

    public function time(){
        return $this->belongsTo(Time::class, 'time_id', 'time_id');
    }

    public function academicYear(){
        return $this->belongsTo(AcademicYear::class, 'academic_year_id', 'academic_year_id');
    }

    public function shcedule(){
        return $this->hasMany(Schedule::class, 'room_time_id', 'room_time_id');
    }
}

