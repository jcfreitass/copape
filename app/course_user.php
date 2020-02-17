<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class course_user extends Model
{
    protected $fillable = [
        'course_id',
        'user_id',
        'checkCourse',
        'id',
        'courseAuth',
    ];
}
