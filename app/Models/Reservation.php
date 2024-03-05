<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = ["event_id", "user_id"];
    public function events()
    {
        return $this->hasMany(Event::class);
    }
    public function user()
    {
        return $this->hasOne(User::class);
    }
}
