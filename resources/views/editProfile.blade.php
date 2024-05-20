

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style.css">
    <title>Edit Profile</title>
  </head>

  <body class="bg-primary">
  <nav class="navbar navbar-expand-lg" style="background-color:#FAFAFA">
    <div class="container">
      <a class="navbar-brand mb-0 h1" href="/"><img src="/img/logo-tanyain.png" alt="Logo" width="100" class="d-inline-block align-text-top">
        </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
  </nav>

    <main class="d-flex justify-content-center">
      <div class="card mt-3 mx-10" style="width: 70%; border-radius: 20px;">
        <div class="card-body">
        <form action="/user/{{ $user->username }}" method="post" enctype="multipart/form-data">
          @method('put')
          @csrf
          <h1 class="h3 mb-3 fw-bold" style="color:#189F92">Silakan Edit Profil Anda</h1>
      
          <div class="form-floating" style="margin-bottom: 20px; margin-top: 25px;">
            <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="username" placeholder="username" required value="{{ old('username', $user->username) }}">
            <label for="username">username</label>
            @error('username')
            <div  class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
          </div>
          <div class="form-floating" style="margin-bottom: 20px;">
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="email" required value="{{ old('email', $user->email) }}">
            <label for="email">Email address</label>
            @error('email')
            <div  class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
          </div>
          <div class="form-floating" style="margin-bottom: 20px;">
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password" required>
            <label for="password">Password</label>
            @error('password')
            <div  class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
          </div>
        <button class="btn btn-primary" type="submit">Edit</button>
        </form>
      </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>