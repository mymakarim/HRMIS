<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Absense extends Model
{
    public function empId(){
        return $this->belongsTo(Employee::class);
    }
}
