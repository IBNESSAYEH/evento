<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;





    protected $fillable = ['title','description','start_date','nb_reservation','image','category_id','user_id',"addresse",'prix','city_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}
