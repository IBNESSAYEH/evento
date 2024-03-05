<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function adminDashboard(){
        $inactiveEvent = Event::with('category', 'user')->where("status", 0)->paginate(6);
        return view('admin.dashboard', compact("inactiveEvent"));
    }
}
