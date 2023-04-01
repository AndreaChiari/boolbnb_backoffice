<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

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

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($apartment) {
            $address = $apartment->address;
            $response = Http::get("https://api.tomtom.com/search/2/geocode/$address.json?key=lCdijgMp1lmgVifAWwN8K9Jrfa9XcFzm");
            $data = $response->json();

            $latitude = $data['results'][0]['position']['lat'];
            $longitude = $data['results'][0]['position']['lon'];

            $apartment->latitude = $latitude;
            $apartment->longitude = $longitude;
        });
    }
}
