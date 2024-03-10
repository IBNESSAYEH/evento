@extends('layouts.layout')
@section('content')
    <div class="row justify-content-center  mt-5">
        <div class="col-8">
        <h2>Create Event</h2>
        <form method="POST"  action="{{ route('evento.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old("title", $event->title ?? null) }}">
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description" rows="4"></textarea>
            </div>

            <div class="form-group">
                <label for="start_date">Start Date:</label>
                <input type="datetime-local" class="form-control" id="start_date" name="start_date">
            </div>
            <div class="form-group">
                <label for="start_date">Addresse : </label>
                <input type="text" class="form-control" id="start_date" name="addresse">
            </div>

            <div class="form-group">
                <label for="nbr_tickets">Number of Tickets :</label>
                <input type="number" class="form-control" id="nbr_tickets" name="nb_reservation">
            </div>
            <div class="form-group">
                <label for="nbr_tickets">Prix :</label>
                <input type="number" class="form-control" id="nbr_tickets" name="prix">
            </div>

            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" class="form-control-file" id="image" name="image">
            </div>
            <div class="form-group" >
                <label for="image" class="d-block">Type de reservation:</label>
                <div class="d-block" >                <input type="radio" name="type_reservation"  value="0" @checked(true)> automatique
                <div class="d-block"> <input type="radio" name="type_reservation"  value="1"> manual</div>
</div>

            </div>

            <div class="form-group">
                <label for="category_id">Category:</label>
                <select class="form-control" id="category_id" name="category_id">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="city_id">City:</label>
                <select class="form-control" id="city_id" name="city_id">
                    @foreach($cities as $city)
                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    </div>

@endsection
