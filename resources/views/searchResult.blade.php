<div class="row" id="eventCards">
    <!-- Event Cards -->
    @forelse ($events as $event)
        <div class="col-lg-4 col-sm-6 mb-4">
            <!-- Portfolio item 1-->
            <div class="card h-100 shadow">
                <a class="portfolio-link" data-bs-toggle="modal" href="#" data-toggle="modal" data-target="#exampleModal{{ $event->id }}">
                    <img class="card-img-top" src="{{ asset('storage/' . $event->image) }}" alt="..." />
                </a>
                <div class="card-body">
                    <h5 class="card-title">{{ $event->title }}</h5>
                    <p class="card-text">{{ $event->description }}</p>
                </div>
            </div>
        </div>
        <!-- Event Modals -->
        <!-- Modal -->
        <div class="modal fade" id="exampleModal{{ $event->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    {{ $event->category ? $event->category->name : 'Uncategorized' }}
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $event->title }} à : {{ $event->addresse }}</h1><br>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h5 class="">{{ $event->start_date }}</h5>
                        <img src="{{ asset('storage/' . $event->image) }}" class="w-100" alt="">
                        <p>{{ $event->description }}</p>
                        <p class="d-flex">organisé par: {{ $event->user->name }}</p>
                        <p class="d-flex">Nombre des ticket disponible : {{ $event->nb_reservation }}</p>
                        <p class="d-flex">Prix : {{ $event->prix }}</p>
                    </div>
                    <div class="modal-footer">
                        <form method="POST" action="{{ route('stripe.get') }}">
                            @csrf
                            <input type="hidden" name="amount" value="{{ $event->prix }}">
                            <input type="hidden" name="event" value="{{ $event->id }}">
                            <button type="submit" name="submit" class="btn btn-success">Reserver</button>
                        </form>
                        <a class="btn btn-primary" href="{{ route('evento.edit',['evento' => $event->id]) }}">update</a>
                        <form method="POST" action="{{ route('evento.destroy', ['evento' => $event->id]) }}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit" name="submit">delete</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Modal content -->
        </div>
    @empty
        <div class="alert alert-danger">We don't have any events at the moment.</div>
    @endforelse
</div>
{{ $events->links() }}
</div>
