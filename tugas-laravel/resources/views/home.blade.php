<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="/"><img src="/img/logo.png" alt="Logo" width="100" class="d-inline-block align-text-top">
      </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/question/create">Ajukan Pertanyaan</a>
        </li>
        <li>
            <form class="d-flex" action="/" >
              <input class="form-control" type="text" placeholder="Cari pertanyaan.." name="search" value="{{ request('search') }}">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/profile">Profile</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Notifikasi</sa>
        </li>
        <li class="nav-item">
          <form action="/logout" method="post">
            @csrf
            <button type="submit">Logout</button>
          </form>
        </li>
      </ul>
    </div>
  </div>
</nav>
<section style="display: flex;">
  <div class="card" style="width: 18rem; margin-right: 20px;">
    <div class="card-header">
        <b> Mata Kuliah</b>
    </div>
    <ul class="list-group list-group-flush">
        @foreach ($subjects as $subject)
        <li class="list-group-item"><a href="/subject/{{ $subject->slug }}">{{$subject->name_subject}}</a></li>
        @endforeach
    </ul>
  </div>
  <div style="flex: 1;">
    <div class="card mt-3">
      <h5 class="card-header">INI MAU JD FORM</h5>
      <div class="card-body">
          <h5 class="card-title">Halo, {{ Auth::user()->username }}!!</h5>
          <h5 class="card-title">SELAMAT DATANG DI TANYAIN!!</h5>
          <p class="card-text">Ayo tanyakan apa yang membuatmu resah!!!</p>
          <a href="#" class="btn btn-dark">AJUKAN PERTANYAAN</a>
      </div>
  </div>
    @foreach ($questions as $question)
    <div class="card mt-3">
      <h5 class="card-header">&#64;{{ $question->user->username }}</h5>
      <div class="card-body">
          <h6 class="card-title">{{ $question->subject->name_subject }}</h6>
          <p class="card-text">{{ $question->body }}</p>
          @if($question->photo)
          <img src="{{ asset('storage/' . $question->photo) }}" alt="Question Photo" style="max-width: 100%;">
          @endif
          <p>{{ $question->created_at->diffForHumans() }}</p>
          <a href="/home/{{ $question->slug }}" class="btn btn-primary">Lihat Lebih Lanjut</a>
          @if( $question->user_id == auth()->user()->id)
          <a href="/question/{{ $question->slug }}/edit" class="btn btn-success">Edit</a>
          <form action="/question/{{ $question->slug }}" method="post" class="d-inline">
            @method('delete')
            @csrf
            <button class="btn btn-danger border-0" onclick="return confirm ('Apakah kamu yakin?')">Hapus</button>
          </form>
          @endif
      </div>
  </div>
    @endforeach
</div>
</section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
  </body>
</html>

