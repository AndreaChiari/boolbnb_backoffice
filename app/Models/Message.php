<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'apartment_id',
        'name',
        'email',
        'object',
        'content',
    ];

    public function apartment()
    {
        return $this->belongsTo(Apartment::class);
    }

    public function getReceivedDate()
    {
        return Carbon::parse($this->created_at)->format('d-m-Y H:i');
    }
}
