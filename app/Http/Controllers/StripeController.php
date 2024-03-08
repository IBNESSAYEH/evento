<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Stripe;
use Illuminate\Support\Facades\Auth;
class StripeController extends Controller
{
    public function stripe(Request $request){
        $amount = $request->amount;
        $event = $request->event;
        return view('stripe', compact('amount','event'));
    }
    public function stripePost(Request $request){
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $event = Event::findOrFail($request->event_id);
        if(!$event->nb_reservation){
            Session::flash('success', 'the event doesn t disponible');

            return redirect()->route('evento.index');
        }
        Stripe\Charge::create([
            'amount' => $request->amount, // Amount in cents
                'currency' => 'usd',
                'source' => $request->stripeToken, // Token representing the card to be charged
                'description' => 'evento reservation'
            ]);

            $checkReservation = Reservation::where('event_id',$request->event_id)->where('user_id',Auth::id())->first();

if(!$checkReservation){

    $reservation['event_id'] = $request->event_id;
    $reservation['user_id'] =Auth::id();
    $reservation['status'] =1;
    $event->decrement('nb_reservation');
    $eventReservation = Reservation::create($reservation);
}elseif($checkReservation->status == 0){
    $checkReservation->increment('status');
    $event->decrement('nb_reservation');
}else{
    Session::flash('success', 'deja reserver');
    return redirect()->route('evento.index');
}



            // Charge was successful, process accordingly
            Session::flash('success', 'payment success');
            return redirect()->route('evento.index');

    }

}
