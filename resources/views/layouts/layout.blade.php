<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>



    <!-- Navigation-->
    @auth
    <nav class="navbar navbar-expand-lg navbar-dark bg-blue fixed-top" id="mainNav">
        <div class="container">
            <p class="navbar-brand" style="color : #2819d4; font-size : 2rem">Evento</p>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars ms-1"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                    <li class="nav-item"><a class="nav-link" href="{{ route('evento.index') }}">Events</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('evento.create') }}">Create Event</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('myTickets') }}">panier</a></li>

                    <li class="nav-item dropdown">
                        <p class="nav-link text-light dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            {{ $userAuthenticated->name }}
                        </p>
                        <ul class="dropdown-menu">



                            @if(auth()->check())
                            @if(auth()->user()->role_id === 3)
                                <!-- Display link for users with role_id 3 -->
                                <li><a class="dropdown-item text-dark" href="{{ route('adminDashboard') }}">Dashboard</a></li>
                            @elseif(auth()->user()->role_id === 2)
                                <!-- Display link for users with role_id 2 -->
                                <li><a class="dropdown-item text-dark" href="{{ route('organisateurDashboard') }}">Dashboard</a></li>
                            @endif
                        @endif
                            </li>
                            <li><a class="dropdown-item text-dark " href="{{ route('myTickets') }}">panier</a></li>
                            <li><a class="dropdown-item text-dark " href="{{ url('/logout') }}">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    @endauth


    <div id="searchResultss">
        @yield('content')
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.3/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

</body>

</html>
