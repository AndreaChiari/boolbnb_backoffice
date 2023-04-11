<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Apartment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'price',
        'rooms',
        'beds',
        'bathrooms',
        'square_meters',
        'address',
        'thumb',
        'description',
        'visibility'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function services()
    {
        return $this->belongsToMany(Service::class)->withTimestamps();
    }

    public function sponsorships()
    {
        return $this->belongsToMany(Sponsorship::class)->withPivot('start_date', 'end_date')->withTimestamps();
    }

    public function views()
    {
        return $this->hasMany(View::class);
    }

    public function apartmentPics()
    {
        return $this->hasMany(ApartmentPic::class);
    }

    public function getThumbUrl()
    {
        if (substr($this->thumb, 0, 10) === 'apartments') return asset('storage/' . $this->thumb);
        return $this->thumb;
    }

    public function isSponsored()
    {
        $active_sponsorship = array_filter($this->sponsorships->toArray(), function ($sponsorship) {
            $now = Carbon::now();
            return $now->floatDiffInDays($sponsorship['pivot']['end_date'], false) > 0;
        });

        return count($active_sponsorship);
    }

    public function activeSponsorship()
    {
        $active_sponsorship = array_filter($this->sponsorships->toArray(), function ($sponsorship) {
            $now = Carbon::now();
            return $now->floatDiffInDays($sponsorship['pivot']['end_date'], false) > 0;
        });

        return $active_sponsorship;
    }

    public function getActiveSponsorshipEndDate($string = false)
    {
        $sponsorship_end = new Carbon($this->activeSponsorship()[0]['pivot']['end_date']);
        if ($string) return $sponsorship_end->toDateString();
        return $sponsorship_end;
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
