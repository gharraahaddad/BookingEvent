<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;use Illuminate\Database\Eloquent\Factories\HasFactory;


class Event extends Model
{ use HasFactory;
    protected $fillable=[ 'title',
        'description',
        'date',
        'capacity',
        'image',
        'created_by',];

    public function user()
{
    return $this->belongsTo(User::class, 'created_by');
}
public function bookings()
{
    return $this->hasMany(Booking::class);
}
}
