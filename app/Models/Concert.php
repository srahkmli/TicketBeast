<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Concert extends Model
{
    use HasFactory;

    // protected $fillable = ['title'  , 'subtitle'  , 'date'  , 'venue'  , 'venue_address'  , 'city'  , 'state' , 'zip' , 'published_at',];
    protected $guarded = [];
    protected $dates = ['date'];

    public static function find($concertId)
    {
    }

    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at');
    }

    public function getFormattedDateAttribute()
    {
        return $this->date->format('F j,Y');
    }

    public function getFormattedStartTimeAttribute()
    {
        return $this->date->format('g:ia');
    }

    public function getTicketPriceInDollorAttribute()
    {
        return number_format($this->ticket_price / 100, 2);
    }

    public function Orders()
    {
        return $this->hasMany(Orders::class);
    }
}
