<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gearbox extends Model
{
    public function cars()
    {
        return $this->hasMany(Car::class);
    }
}
