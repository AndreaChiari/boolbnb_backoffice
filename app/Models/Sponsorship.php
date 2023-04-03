<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sponsorship extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'duration',
        'price',
        'icon',
    ];

    public function apartments()
    {
        return $this->belongsToMany(Apartment::class)
            ->withPivot('start_date', 'end_date')->withTimestamps();
    }
}
