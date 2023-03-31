<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sponsorship extends Model
{
    use HasFactory;

    protected $fillable = [];

    public function apartments()
    {
        $this->belongsToMany(Apartment::class)
            ->withPivot('start_date', 'end_date');
    }
}
