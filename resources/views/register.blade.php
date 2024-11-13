<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X UA- Compatible" content="ie=edge">
    <title>register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>

<body>

    <div class="container">
        <div class="m-2">
            <h2><strong>Registion form</strong></h2>
        </div>

        {{-- @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
    @endif --}}
    <div>
        <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="first_name">First Name:</label>
                <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name"
                    placeholder="Enter First Name" name="first_name" value="{{ old('first_name') }}">
                @error('first_name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="last_name">Last Name:</label>
                <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name"
                    placeholder="Enter Last Name" name="last_name" value="{{ old('last_name') }}">
                @error('last_name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                    placeholder="Enter email" name="email" value="{{ old('email') }}">
                @error('email')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="pwd">Password:</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                    placeholder="Enter password" name="password" value="{{ old('password') }}">
                @error('password')
            </div>
            <span class="text-danger">{{ $message }}</span>
            @enderror
    </div>
    <div class="form-group">
        <label for="gender">Gender:</label>
        <input type="radio" name="gender" value="male" checked> Male
        <input type="radio" name="gender" value="female"> Female
    </div>
    <div class="form-group">
        <label for="hobby">Hobby:</label>
        <input type="checkbox" name="hobby[]" value="reading"> Reading
        <input type="checkbox" name="hobby[]" value="playing"> Playing
        <input type="checkbox" name="hobby[]" value="travelling"> Travelling
    </div>
    <div class="form-group">
        <label for="city">City</label>
        <select class="form-control" id="city_id" name="city_id">
            <option value="">Select City</option>
            <option value="1">Kanpur</option>
            <option value="2">Fatehpur</option>
            <option value="3">Surat</option>
            <option value="4">Delhi</option>
            <option value="5">Noida</option>
        </select>
    </div>
    <div class="form-group">
        <label for="phone"> Phone Number: </label>
        <input type="number" id="phone" name="phone" value="{{ old('phone') }}"
            class="form-control @error('phone') is-invalid @enderror" placeholder="Enter Mobile No." />
        @error('phone')
        {{-- <div class="alert alert-danger">Enter Your Phone No</div> --}}
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="image">Image:</label>
        {{-- <input type="file" class="form-control" name="image">  --}}
        <input type="file" class="form-control" name="images[]" id="images" multiple>
    </div>
    <div class="form-group form-check">
        <label class="form-check-label">
            <input class="form-check-input" type="checkbox" name="remember"> Remember me
        </label>
    </div>
    <button type="submit" class="btn btn-primary">register</button>
    </form>
    <p>Already have an account? <a href="{{ route('login') }}">Click Here</a> to login.</p>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>