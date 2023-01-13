<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Room
 *
 * @method static \Database\Factories\RoomFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Room newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Room newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Room query()
 * @mixin \Eloquent
 * @property int $room_id
 * @property string $name
 * @property int $quota
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereQuota($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereRoomId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereUpdatedAt($value)
 */
class Room extends Model{
    use HasFactory;
    protected $table = 'rooms';
    protected $primaryKey = 'room_id';
    public $timestamps = true;
    protected $fillable = ['name', 'quota'];
    protected $hidden = ['created_at', 'updated_at'];

    public function roomTimes(){
        return $this->hasMany(RoomTime::class, 'room_id', 'room_id');
    }
}
