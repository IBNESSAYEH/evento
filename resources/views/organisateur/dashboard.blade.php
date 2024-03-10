<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Admin Dashboard | Korsat X Parmaga</title>
    <!-- ======= Styles ====== -->

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

</head>

<body style="width: 100vw !important">
    <!-- =============== Navigation ================ -->
    <div class="container" style="width: 100vw !important">
        <div class="navigation">
            <ul>
                <li>
                    <a href="#">
                        <span class="title">Evento</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('evento.index') }}">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Home</span>
                    </a>
                </li>


                <li>
                    <a href="{{ route('logout') }}">
                        <span class="icon">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                        <span class="title">Sign Out</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- ========================= Main ==================== -->
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>

                <div class="search">
                    <label>
                        <input type="text" class="form-control" placeholder="Search here">
                        <ion-icon name="search-outline"></ion-icon>
                    </label>
                </div>

                <div class="user">
                    <img src="assets/imgs/customer01.jpg" alt="" class="img-fluid">
                </div>
            </div>

            <!-- ======================= Cards ================== -->
            <div class="cardBox">


                <div class="card">
                    <div>
                        <div class="numbers">{{ $totalReservations  }}</div>
                        <div class="cardName">Reservations</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="cart-outline"></ion-icon>
                    </div>
                </div>






            </div>

            <!-- ================ Order Details List ================= -->
            <div class="sections">
                <div class="recentCustomers ">
                    <div class="recentOrders">
                        <div class="cardHeader">
                            <h2>Recent event</h2>
                        </div>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Event</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($inactiveEvent as $event)
                                <tr class="tr">
                                    <td>{{ $event->title }}</td>
                                    <td>

                                            @if($event->reservation->isNotEmpty() && $event->reservation->first()->status == 3)
                                                <span class="text-danger">not yet</span>
                                            @else
                                                <span class="text-success">accepted</span>
                                            @endif

                                    </td>



                                    <td class="actions" style="display: flex; align-items: center; gap: 4px; ">

                                        @if($event->reservation->isNotEmpty() && $event->reservation->first()->status == 3)
                                        <form method="POST" action="{{ route('reservation.update', ['reservation' => $event->reservation->first()->id]) }}">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="user_id" value="{{ $event->reservation->isNotEmpty() ? $event->reservation->first()->user_id : '' }}">

                                            <input type="hidden" name="event_id" value="{{ $event->id }}">
                                            <button class="btn btn-success" type="submit" name="submit">accept</button>
                                        </form>
                                    @else
                                    <button class="btn btn-primary" >accepted</button>
                                    @endif




                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div>
                    <!-- display messages -->
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




    <!-- =========== Scripts =========  -->
    <script src="{{ asset('js/main.js') }}"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script nomodule src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
