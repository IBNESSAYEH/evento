@extends('layouts.layout')
@section('content')


<div class="d-flex flex-wrap  justify-content-center gap-5" style="margin-top: 7rem">
  @forelse ($myTickets as $ticket)

<div class="card col-4 " style="width: 18rem;">
    <img src="{{ asset('storage/' . $ticket->event->image) }}" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">{{ $ticket->event->title }}</h5>
      <p class="card-text">{{ $ticket->event->description }}</p>
      <p class="card-text">Prix : {{ $ticket->event->prix }}</p>
      <p class="card-text">Addresse : {{ $ticket->event->addresse }}</p>
      @if ($ticket->event->type_reservation == 1 && $ticket->status == 0)

      <form method="POST" action="{{ route('stripe.get') }}">
          @csrf
          <input type="hidden" name="amount" value="{{ $ticket->event->prix }}">
          <input type="hidden" name="event" value="{{ $ticket->event->id }}">
          <button type="submit" name="submit" class="btn btn-success">Reserver</button>
      </form>
      @elseif ($ticket->event->type_reservation == 1 && $ticket->status == 1)
          <div class="btn btn-primary">reserved</div>
    @else
    <div class="btn btn-dark text-light">pending</div>
      @endif
    </div>
  </div>


@empty

@endforelse
</div>


@endsection
