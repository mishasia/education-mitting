<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
