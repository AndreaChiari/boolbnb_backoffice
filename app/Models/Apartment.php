<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    use HasFactory;

    protected $fillable = [];

    public function user()
    {
        $this->belongsTo(User::class);
    }

    public function messages()
    {
        $this->hasMany(Message::class);
    }

    public function services()
    {
        $this->belongsToMany(Service::class);
    }

    public function sponsorships()
    {
        $this->belongsToMany(Sponsorship::class);
    }

    public function views()
    {
        $this->hasMany(View::class);
    }

    public function apartmentPics()
    {
        $this->hasMany(ApartmentPic::class);
    }

    //TODO Funzione per le coordinate
}
