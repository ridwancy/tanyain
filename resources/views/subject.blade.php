

<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{{ $subject->name_subject }}</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link rel="stylesheet" href="/css/style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="bg-primary">
  <nav class="navbar navbar-expand-lg sticky-top" style="background-color:#FAFAFA">
    <div class="container">
      <a class="navbar-brand mb-0 h1" href="/">
        <img src="/img/logo-tanyain.png" alt="Logo" width="100" class="d-inline-block align-text-top">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" style="color:#189F92" aria-current="page" href="/">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/question/create">Ajukan Pertanyaan</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Profil
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="/profile">Akun</a></li>
              <li>
                <form action="/logout" method="post">
                  @csrf
                  <button type="submit" class="dropdown-item">Log out</button>
                </form>
              </li>
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
      {{-- Side bar kategori mata kuliah --}}
      <div class="col-md-3 mb-3">
        <div class="card bg-light sticky-sidebar">
          <div class="card-header d-flex justify-content-between align-items-center">
            <b>Mata Kuliah</b>
            <button class="btn btn-link d-md-none p-0" type="button" data-bs-toggle="collapse" data-bs-target="#categoryDropdown" aria-expanded="false" aria-controls="categoryDropdown">
              <i class="fa-solid fa-chevron-down"></i>
            </button>
          </div>
          <div id="categoryDropdown" class="collapse d-md-block">
            <ul class="list-group list-group-flush">
              @foreach ($subjects as $subject)
                <li class="list-group-item">
                  <a href="/subject/{{ $subject->slug }}" class="no-underline">{{ $subject->name_subject }}</a>
                </li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
      
			<div class="col-md-9">
       {{-- Card untuk masuk ke page create question --}}
			 <div class="card mb-3">
				<div class="card-body text-center">
					<h5 class="card-title">Halo, {{ Auth::user()->username }}!!</h5>
					<h5 class="card-title">SELAMAT DATANG DI TANYAIN!!</h5>
					<p class="card-text">Ayo tanyakan apa yang membuatmu resah!!!</p>
					<a href="/question/create" class="btn btn-primary">AJUKAN PERTANYAAN</a>
				</div>
			</div>
        {{-- Daftar Pertanyaan --}}
        @foreach ($questions as $question)
          <div class="card mb-3">
            <div class="card-header d-flex justify-content-between align-items-center">
              <div class="d-flex align-items-center">
                <h5 class="mb-0">{{ '@' . $question->user->username }}</h5>
              </div>
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
              <div class="d-flex justify-content-start align-items-center mb-2">
                <h6 class="card-title me-2 mb-0">{{ $question->subject->name_subject }}</h6>
                <span class="mx-2"> - </span>
                <p class="mb-0">{{ $question->created_at->diffForHumans() }}</p>
              </div>
              <p class="card-text">{{ $question->body }}</p>
              @if($question->photo)
                <img src="{{ asset('storage/' . $question->photo) }}" alt="Question Photo" class="img-fluid mb-3">
              @endif
              <div class="d-flex">
                <a href="/home/{{ $question->slug }}" class="btn btn-primary ms-auto mt-2">Lihat Lebih Lanjut</a>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      document.querySelectorAll('.collapse').forEach(collapse => {
        collapse.addEventListener('shown.bs.collapse', function() {
          const icon = this.parentElement.querySelector('.fa-chevron-down');
          if (icon) {
            icon.classList.remove('fa-chevron-down');
            icon.classList.add('fa-chevron-up');
          }
        });
  
        collapse.addEventListener('hidden.bs.collapse', function() {
          const icon = this.parentElement.querySelector('.fa-chevron-up');
          if (icon) {
            icon.classList.remove('fa-chevron-up');
            icon.classList.add('fa-chevron-down');
          }
        });
      });
    });
  </script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
