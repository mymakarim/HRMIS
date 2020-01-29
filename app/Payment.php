<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Payment extends Model
{
    public function empId(){
        return $this->belongsTo(Employee::class);
    }
}
