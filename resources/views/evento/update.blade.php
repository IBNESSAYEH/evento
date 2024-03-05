<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Event</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Create Event</h2>
        <form method="POST" action="{{ route('evento.update', ['evento' => $event->id]) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old("title", $event->title ?? null) }}">
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description" rows="4" value="{{ old("description", $event->description ?? null) }}">{{ $event->description }}</textarea>
            </div>

            <div class="form-group">
                <label for="start_date">Start Date:</label>
                <input type="datetime-local" class="form-control" id="start_date" name="start_date" value="{{ old("start_date", $event->start_date ?? null) }}">
            </div>

            <div class="form-group">
                <label for="nbr_tickets">Number of Tickets:</label>
                <input type="number" class="form-control" id="nbr_tickets" name="nb_reservation" value="{{ old("nb_reservation", $event->nb_reservation ?? null) }}">
            </div>
            <div class="form-group">
                <label for="nbr_tickets">Prix :</label>
                <input type="number" class="form-control" id="nbr_tickets" name="prix">
            </div>

            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" class="form-control-file" id="image" name="image" >
            </div>

            <div class="form-group">
                <label for="category_id">Category:</label>
                <select class="form-control" id="category_id" name="category_id" value="{{ old("category_id", $event->category_id ?? null) }}">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="city_id">City:</label>
                <select class="form-control" id="city_id" name="city_id"  value="{{ old("city_id", $event->city_id ?? null) }}">
                    @foreach($cities as $city)
                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>
