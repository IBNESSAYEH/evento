<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Category;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $events = Event::with('category', 'user')->where('status',1)->paginate(6);
        $categories = Category::all();
        return view('home',['categories' => $categories,'events' => $events]);
    }


    public function filterByCategory(Request $request)
{
    $events = Event::with('category', 'user')->where('category_id', $request->category)->paginate(6);
    $categories = Category::all();
    return view('home', ['categories' => $categories, 'events' => $events]);
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $cities = City::all();
        return view('evento.create',compact("categories","cities"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEventRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'start_date' => 'required|date',
            'nb_reservation' => 'required|integer|min:1',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:categories,id',
            'addresse' => 'required',
            'prix' => 'required',
            'type_reservation' => 'required',

            'city_id' => 'required',
            ]);
            $validatedData['user_id'] = Auth::id();

            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('images', 'public');
                $validatedData['image'] = $imagePath;
            }

        $event = Event::create($validatedData);

        return redirect()->route('evento.index')->with('success', 'Event created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $evento)
    {
        $categories = Category::all();
        $cities = City::all();
        $event = Event::findOrFail($evento->id);

        return view('evento.update',['categories' => $categories, "cities"=> $cities, 'event' => $event]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEventRequest  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($request->event_id);
        if (! Gate::allows('organisateur', $event)) {
            abort(403);
        }
        // Validate the incoming request data

        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'start_date' => 'required|date',
            'nb_reservation' => 'required|integer|min:1',
            'image' => 'nullable',
            'category_id' => 'required|exists:categories,id',
            'prix' => 'required',
            'city_id' => 'required',
            'type_reservation' => 'required',
        ]);
        $validatedData['user_id'] = Auth::id();
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $validatedData['image'] = $imagePath;
        }
        $event = Event::findOrFail($id);

        $event->update($validatedData);

        return redirect()->route('evento.index')->with('success', 'Event updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $event = Event::findOrFail($request->event_id);
        if (! Gate::allows('organisateur', $event)) {
            abort(403);
        }
        Event::destroy($id);
        return redirect()->route('evento.index')->with('success', 'Event deleted successfully.');
    }
    public function accept(Request $request)
    {


        $event = Event::findOrFail($request->event_id);
        if (! Gate::allows('organisateur', $event)) {
            abort(403);
        }
        $event->increment('status');
        return redirect()->route('evento.index')->with('success', 'Event deleted successfully.');
    }
    public function searchByTitle(Request $request)
    {
        $keyword = $request->input('title_s');
        if ($keyword === '') {
            $events = Event::where('status', 1)->get();
        } else {
            $events = Event::where('status', 1)
                           ->where('title', 'like', '%' . $keyword . '%')
                           ->paginate(6);
        }

        return view('searchResult')->with(['events' => $events, 'keyword' => $keyword]);
    }


}
