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
 */
class Room extends Model{
    use HasFactory;
    protected $table = 'rooms';
    protected $primaryKey = 'room_id';
    public $timestamps = true;
    protected $fillable = ['name', 'quota'];
    protected $hidden = ['created_at', 'updated_at'];
}
