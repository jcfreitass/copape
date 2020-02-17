<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class course extends Model
{
    protected $fillable = [
        'name','id',
    ];
    public function user()
    {
        return $this->belongsToMany(User::class);
    }
}
