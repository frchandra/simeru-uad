<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\RoomTimeHelper
 *
 * @property int $room_time_helper_id
 * @property int $time_id
 * @property int $room_id
 * @property int $academic_year_id
 * @property int $is_occupied
 * @property int $is_possible
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|RoomTimeHelper newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RoomTimeHelper newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RoomTimeHelper query()
 * @method static \Illuminate\Database\Eloquent\Builder|RoomTimeHelper whereAcademicYearId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoomTimeHelper whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoomTimeHelper whereIsOccupied($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoomTimeHelper whereIsPossible($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoomTimeHelper whereRoomId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoomTimeHelper whereRoomTimeHelperId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoomTimeHelper whereTimeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoomTimeHelper whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class RoomTimeHelper extends Model{
    use HasFactory;
    protected $table='room_time_helpers';
    protected $primaryKey = 'room_time_helper_id';
    public $timestamps = true;
    protected $fillable = ['room_id', 'time_id', 'academic_year_id', 'is_occupied', 'is_possible'];
    protected $hidden = ['created_at', 'updated_at'];
}
