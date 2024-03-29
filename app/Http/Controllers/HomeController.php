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
        $organisateurs = User::where('role_id',2)->get();
        $events = Event::all();
        $categories = Category::all();
        $totalReservations = Reservation::count();

        return view('admin.dashboard', compact("inactiveEvent",'users','events','totalReservations','categories','organisateurs'));
    }
    public function organisateurDashboard(){


        $inactiveEvent = Event::with('category', 'user','reservation')->where("user_id", Auth::id())->get();


        $categories = Category::all();
        $users = User::all();
        $events = Event::all();
        // $totalReservations = Event::withCount('reservation')->get();
        $totalReservations = Event::where("user_id", Auth::id())->where('status',1)->count();

        // dd($totalReservations) ;
        return view('organisateur.dashboard', compact("inactiveEvent", "categories", 'users','events','totalReservations'));
    }

    public function home()
    {

        $events = Event::with('category', 'user')->where('status',1)->paginate(6);
        $categories = Category::all();
        return view('home',['categories' => $categories,'events' => $events]);
    }

}
