<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function adminDashboard(){
        $inactiveEvent = Event::with('category', 'user')->where("status", 0)->paginate(6);
        $users = User::all();
        $events = Event::all();
        $categories = Category::all();
        $totalReservations = Reservation::count();

        return view('admin.dashboard', compact("inactiveEvent",'users','events','totalReservations','categories'));
    }
    public function organisateurDashboard(){
        $inactiveEvent = Event::with('category', 'user')->where("user_id", Auth::id())->paginate(6);
        $users = User::all();
        $events = Event::all();
        $totalReservations = Reservation::count();

        return view('organisateur.dashboard', compact("inactiveEvent",'users','events','totalReservations'));
    }
}
