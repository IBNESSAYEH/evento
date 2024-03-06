@extends('layouts.layout')
@section('content')


<div class="d-flex justify-content-center gap-5" style="margin-top: 7rem">
  @forelse ($myTickets as $ticket)

<div class="card" style="width: 18rem;">
    <img src="{{ asset('storage/' . $ticket->event->image) }}" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">{{ $ticket->event->title }}</h5>
      <p class="card-text">{{ $ticket->event->description }}</p>
      <p class="card-text">Prix : {{ $ticket->event->prix }}</p>
      <p class="card-text">Addresse : {{ $ticket->event->addresse }}</p>
      <a href="#" class="btn btn-primary">Go somewhere</a>
    </div>
  </div>


@empty

@endforelse
</div>


@endsection
