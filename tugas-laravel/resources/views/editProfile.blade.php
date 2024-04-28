<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <link rel="stylesheet" href="css/style.css">

    <title>Edit Profile</title>
</head>
<body>
    <main class="form-signup w-100 m-auto">
        <form action="/user/{{ $user->username }}" method="post" enctype="multipart/form-data">
          @method('put')
          @csrf
          <img class="mb-4" src="img/logo.png" alt="" width="172" height="57">
          <h1 class="h3 mb-3 fw-normal">Silakan Edit Profile Anda</h1>
      
          <div class="form-floating">
            <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="username" placeholder="username" required value="{{ old('username', $user->username) }}">
            <label for="username">username</label>
            @error('username')
            <div  class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
          </div>
          <div class="form-floating">
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="email" required value="{{ old('email', $user->email) }}">
            <label for="email">Email address</label>
            @error('email')
            <div  class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
          </div>
          <div class="form-floating">
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password" required>
            <label for="password">Password</label>
            @error('password')
            <div  class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
          </div>
          {{-- <div class="mb-3">
            <label for="image" class="form-label">Foto Profil</label>
            <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo" name="photo"> 
            @error('photo')
            <div  class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div> --}}
          <button class="btn btn-primary w-100 py-2" type="submit">Edit</button>
        </form>
      </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>