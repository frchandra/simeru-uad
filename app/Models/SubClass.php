<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class SubClass extends Model{
    use HasFactory;
    protected $table = 'sub_classes';
    protected $primaryKey = 'sub_class_id';
    public $timestamps = true;
    protected $fillable = ['name', 'quota', 'credit', 'semester'];
    protected $hidden = ['created_at', 'updated_at'];
}
