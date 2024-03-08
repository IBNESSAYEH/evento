@extends('layouts.layout')

@section('content')

    <!-- Masthead-->
    <header class="masthead">
        <div class="container">
            <div class="masthead-subheading">Hi <span class="text-primary">{{ $userAuthenticated->name }}</span> Welcome To Our Events!</div>
            <div class="masthead-heading text-uppercase">It's Nice To Meet You</div>
            <a class="btn btn-primary btn-xl text-uppercase" href="#services">Tell Me More</a>
        </div>
    </header>
    {{-- display messages --}}
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<div id="events"></div>
    <!-- events Grid -->
<section class="page-section bg-light" id="portfolio">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Soon Events</h2>
            <h3 class="section-subheading text-muted">Take your ticket to enjoy the part</h3>
        </div>








        <!-- Filter by Category -->
        <div class="row mb-4  flex-row    justify-content-between align-items-end ">
            <div class="col-md-4">
                <form action="{{ route('filterByCategory') }}" method="POST" class="d-flex justify-content-center ">
                    @csrf
                      <select name="category" class="form-select" id="categoryFilter">
                        <optgroup label="Categories">
                            @if($categories)
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                    @endif
                </optgroup>
                </select>
                <button class="btn btn-primary" name="submit" id="applyFilterBtn">Filter</button>
                </form>
            </div>
            <div class="col-md-4">


                    <input class="form-control" list="datalistOptions" id="searchByTitle" name="searchByTitle" placeholder="Type to search...">
                    <datalist id="datalistOptions">
                        @foreach ($events as $event)

                        <option value="{{ $event->title }}">
                        @endforeach

                    </datalist>

            </div>
            </div>
        </div>

        <div class="row" id="searchResults">
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
                                @if ($event->type_reservation == 0)

                                <form method="POST" action="{{ route('stripe.get') }}">
                                    @csrf
                                    <input type="hidden" name="amount" value="{{ $event->prix }}">
                                    <input type="hidden" name="event" value="{{ $event->id }}">
                                    <button type="submit" name="submit" class="btn btn-success">Reserver</button>
                                </form>
                                @else
                                <form method="POST" action="{{ route('reservation.store') }}">
                                    @csrf

                                    <input type="hidden" name="event_id" value="{{ $event->id }}">
                                    <button type="submit" name="submit" class="btn btn-primary">demander</button>
                                </form>
                                @endif

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
</section>



<script>
  document.addEventListener("DOMContentLoaded", function() {
        var searchTitleInput = document.getElementById("searchByTitle");
        var searchResultContainer = document.getElementById("searchResults");

        searchTitleInput.addEventListener("keyup", function() {
            var title = searchTitleInput.value;

            $.ajax({
                type: 'GET',
                url: '/searchByTitle/',
                data: {
                    title_s: title
                },
                success: function(data) {
                    searchResultContainer.innerHTML = data;
                },
                error: function(error) {
                    console.error("Error during search:", error);
                }
            });
        });
    });
</script>


    <!-- Bootstrap core JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Core theme JS -->
    <script src="{{ asset('js/scripts.js') }}"></script>

@endsection









