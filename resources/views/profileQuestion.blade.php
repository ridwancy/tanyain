

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
  </head>
  <body class="bg-primary">
    
    <nav class="navbar navbar-expand-lg" style="background-color:#FAFAFA">
      <div class="container">
        <a class="navbar-brand mb-0 h1" href="/"><img src="/img/logo-tanyain.png" alt="Logo" width="100" class="d-inline-block align-text-top">
          </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="/">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/question/create">Ajukan Pertanyaan</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" style="color:#189F92" aria-current="page" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Profil
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" style="color:#189F92" aria-current="page" href="/profile">Akun</a></li>
                <li><a class="dropdown-item" href="/tanyain">Log Out</a></li>
              </ul>
            </li>
          </ul>
          <form class="d-flex" action="/">
            <div class="input-group">
              <input class="form-control form-border" type="text" placeholder="Cari pertanyaan.." name="search" value="{{ request('search') }}">
              <button class="btn btn-brand" type="submit">
                <i class="fa-solid fa-magnifying-glass"></i>
              </button>
            </div>
          </form>
        </div>
      </div>
    </nav>

    <section class="container my-3">

        <div class="row">
          <div class="col-md-5 mb-3">
        <div class="card card-cards" style="width: 27rem; margin-right: 20px; background-color: #FFFFFF;">
          <div class="img-container">
            <img src="img/download.png" alt="profile image">
          </div>
          <p class="info full-name">{{ Auth::user()->username }}</p>
          <p class="infor email">
              {{ Auth::user()->email }}
          </p>
          {{-- <p class="infor mb-4">Total Like : 100</p> --}}
          <p class="infor mb-4">{{ Auth::user()->answers()->withCount('likes')->get()->sum('likes_count') }} Like </p>
          <div class="button-container">
            <a class="btn btn-edit me-2" href="/user/{{ $user->username }}/edit">Edit</a>
            <form action="/user/{{ $user->username }}" method="post" class="d-inline">
                @method('delete')
                @csrf
                <button type="submit" class="btn btn-delete ms-2" onclick="return confirm ('Apakah kamu yakin?')">Hapus</button>
            </form>
          </div>  
        </div>
          </div>
        <div class="col-md-7">
          <div class="card mb-3">
            <h5 class="card-header">
              <a href="/question" style="text-decoration: none; color:inherit">Pertanyaan ({{ count($questions) }})</a> |  
              <a href="/Answer" style="text-decoration: none; color:inherit">Jawaban ({{ count($answers) }})</a>
            </h5>

            @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              {{ session('success') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            @foreach ($questions as $question)
              <div class="card mt-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                  <h5 class="mb-0">{{ $question->subject->name_subject }}</h5>
                  @if($question->user_id == auth()->user()->id)
                    <div class="dropdown">
                      <button class="btn btn-link p-0" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-ellipsis-vertical"></i>
                      </button>
                      <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item" href="/question/{{ $question->slug }}/edit">Edit</a></li>
                        <li>
                          <form action="/question/{{ $question->slug }}" method="post" class="d-inline">
                            @method('delete')
                            @csrf
                            <button class="dropdown-item" onclick="return confirm('Apakah kamu yakin?')">Hapus</button>
                          </form>
                        </li>
                      </ul>
                    </div>
                  @endif
                </div>
                <div class="card-body">
                  <p class="card-text">{{ $question->body }}</p>
                  @if($question->photo)
                    <img src="{{ asset('storage/' . $question->photo) }}" alt="Question Photo" class="img-fluid mb-3 rounded d-block mx-auto" style="width: 450px; height: auto;">
                  @endif
                  <p class="mb-0">{{ $question->created_at->diffForHumans() }}</p>
                  <a href="/question/{{ $question->slug }}" class="btn btn-primary float-end mt-3" style="border-radius: 20px;">Lihat Lebih Lanjut</a>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>