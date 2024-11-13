{{-- @php
use App\Models\City;
@endphp  --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X UA- Compatible" content="ie=edge">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        @include('error_message')

        <h1>Welcome {{ $user->first_name . ' ' . $user->last_name }}, To Home Page</h1>
        <div class="card" style="width:400px">
            @if (!empty($user->image))
                @php
                    $images = json_decode($user->image, true);
                @endphp
                @if (is_array($images) && count($images) > 0)
                    @foreach ($images as $image)
                        <img src="{{ asset($image) }}" alt="User Image" width="390" style="margin: 5px;">
                    @endforeach
                @else
                    <p>No valid images available</p>
                @endif
            @else
                <p>No images available</p>
            @endif <br>
            <div class="card-body">
                <h4 class="card-title">{{ $user->first_name . ' ' . $user->last_name }}</h4>
                <p class="card-text">Email : {{ $user->email }}</p>
                <p class="card-text">Intersted In : {{ $user->hobby }}</p>
                <p class="card-text">Phone Number : {{ $user->phone }}</p>
                {{-- @php
                $city = City::find($user->city_id);
            @endphp  --}}
                {{-- <p class="card-text">City : {{ $user->name}}</p> --}}
                <p class="card-text">City : {{ $user->city->name }}</p>
                <a href="{{ route('contact.create') }}" class="btn btn-primary">Add Contact</a>
                <a href="{{ route('contact.list') }}" class="btn btn-danger">See Contacts</a>
                <a href="{{ route('logout') }}" class="btn btn-primary">Logout</a>
            </div>
        </div>
    </div>
</body>

</html>
