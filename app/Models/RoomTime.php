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
 * @method static \Illuminate\Database\Eloquent\Builder|RoomTime whereRoomTimesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoomTime whereTimeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoomTime whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class RoomTime extends Model{
    use HasFactory;
    protected $table='room_times';
    protected $primaryKey = 'room_time_id';
    public $timestamps = true;
    protected $fillable = ['room_id', 'time_id', 'academic_year_id', 'is_occupied'];
    protected $hidden = ['created_at', 'updated_at'];

    public function rooms(){
        return $this->belongsTo(Room::class, 'room_id', 'room_id');
    }
}

