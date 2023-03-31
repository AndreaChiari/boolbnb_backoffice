<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApartmentPic extends Model
{
    use HasFactory;

    protected $fillable = [];

    public function apartment()
    {
        $this->belongsTo(Apartment::class);
    }
}
