<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function model()
    {
        return $this->belongsTo(Models::class);
    }

    public function FuelType()
    {
        return $this->belongsTo(FuelType::class);
    }

    public function Gearbox()
    {
        return $this->belongsTo(Gearbox::class);
    }

    public function BodyType()
    {
        return $this->belongsTo(BodyType::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
