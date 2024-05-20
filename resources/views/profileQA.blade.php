

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
    integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  </head>
  <body class="bg-primary">
    <nav class="navbar navbar-expand-lg" style="background-color:#FAFAFA">
      <div class="container">
        <a class="navbar-brand mb-0 h1" href="/">
          <img src="/img/logo-tanyain.png" alt="Logo" width="100" class="d-inline-block align-text-top">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
        data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
        aria-label="Toggle navigation">
          <span class="navbar-toggler-icon">
          </span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="/">
                Home
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/question/create">
                Ajukan Pertanyaan
              </a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" style="color:#189F92" aria-current="page"
              href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Profil
              </a>
              <ul class="dropdown-menu">
                <li>
                  <a class="dropdown-item" style="color:#189F92" aria-current="page" href="/profile">
                    Akun
                  </a>
                </li>
                <li>
                  <a class="dropdown-item" href="/tanyain">
                    Log Out
                  </a>
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
        <div class="col-md-5 mb-3">
          <div class="card card-cards" style="width: 27rem; margin-right: 20px; background-color: #FFFFFF;">
            <div class="img-container">
              <img src="/img/download.png" alt="profile image">
            </div>
            <p class="info full-name">
              {{ Auth::user()->username }}
            </p>
            <p class="infor role">
              {{ Auth::user()->email }}
            </p>
            <p class="infor">{{ Auth::user()->answers()->withCount('likes')->get()->sum('likes_count') }} Like </p>
            <div class="button-container">
              <a class="btn btn-edit me-2" href="/user/{{ $user->username }}/edit">
                Edit
              </a>
              <form action="/user/{{ $user->username }}" method="post" class="d-inline">
                @method('delete') @csrf
                <button type="submit" class="btn btn-delete ms-2" onclick="return confirm ('Apakah kamu yakin?')">
                  Hapus
                </button>
              </form>
            </div>
          </div>
        </div>

        <div style="flex: 1;">
          <div class="card mt-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                  <div>
                    <h5 class="mb-0">&#64;{{ $question->user->username }}</h5>
                    <p class="mb-0 text-muted">{{ $question->created_at->diffForHumans() }}</p>
                  </div>
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
                <h6 class="card-title">{{ $question->subject->name_subject }}</h6>
                <p class="card-text">{{ $question->body }}</p>
                @if($question->photo)
                <img src="{{ asset('storage/' . $question->photo) }}" alt="Question Photo" class="img-fluid mb-3 rounded d-block mx-auto" style="width: 450px; height: auto;">
              @endif
                <div class="d-flex">
                  @if($question->user_id != auth()->user()->id)
                  <a href="/Answer/create/{{ $question->slug }}" class="btn btn-primary float-end mt-3">Tambah Jawaban</a>
                  @endif
                </div>
              </div>
            </div>
  
            <h3 class="mt-3">Jawaban:</h3>
            @foreach ($answers as $answer)
              <div class="card mb-4 shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                  <div class="d-flex align-items-center">
                    <div>
                      <h5 class="mb-0">&#64;{{ $answer->user->username }}</h5>
                      <p class="mb-0 text-muted">{{ $answer->created_at->diffForHumans() }}</p>
                    </div>
                  </div>
                  @if($answer->user_id == auth()->user()->id)
                    <div class="dropdown">
                      <button class="btn btn-link p-0" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-ellipsis-vertical"></i>
                      </button>
                      <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item" href="/Answer/{{ $answer->question->slug }}/edit">Edit</a></li>
                        <li>
                          <form action="/Answer/{{ $answer->question->slug }}" method="post" class="d-inline">
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
                  <p class="card-text">{{ $answer->body }}</p>
                  @if($answer->photo)
                    <img src="{{ asset('storage/' . $answer->photo) }}" alt="Answer Photo" class="img-fluid mb-3 rounded d-block mx-auto" style="width: 450px; height: auto;">
                  @endif

                  <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <p class="mb-0 mr-2">&nbsp; &nbsp; &nbsp;{{ $answer->likes->count() }} &nbsp;</p>
                        @if($answer->user_id != auth()->user()->id)
                        <form action="{{ route('answers.like', $answer->id) }}" method="POST" onsubmit="sessionStorage.setItem('isRefreshAfterLike', 'true'); saveScrollPositionForLike(); return true;">
                            @csrf
                            <button type="submit" class="btn btn-link p-0">
                                <i class="fa-regular fa-thumbs-up fa-2x" style="color:#189F92;"></i>
                            </button>
                          </form>
                          @else
                          <button type="submit" class="btn btn-link p-0">
                              <i class="fa-regular fa-thumbs-up fa-2x" style="color:#189F92;"></i>
                          </button>
  
                        @endif
                    </div>
                    <a href="/comment/create/{{ $answer->id }}" class="btn btn-primary">Berikan Komentar</a>
                </div>
  
                  <div class="mt-3">
                    <h4>Komentar :</h4>
                    <div id="comments-{{ $answer->id }}" class="collapse">
                      @if ($answer->comments->isEmpty())
                        <p>Belum ada komentar pada jawaban ini</p>
                      @else
                        @foreach ($answer->comments->sortBy('created_at') as $comment)
                          <div class="card mt-2">
                            <div class="card-header d-flex justify-content-between align-items-center">
                              <div class="d-flex align-items-center">
                                <div>
                                  <h6 class="mb-0">&#64;{{ $comment->user->username }}</h6>
                                  <p class="mb-0 text-muted">{{ $comment->created_at->diffForHumans() }}</p>
                                </div>
                              </div>
                              @if($comment->user_id == auth()->user()->id)
                                <div class="dropdown">
                                  <button class="btn btn-link p-0" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                  </button>
                                  <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                    <li><a class="dropdown-item" href="/comment/{{ $comment->answer->id }}/edit">Edit</a></li>
                                    <li>
                                      <form action="/comment/{{ $comment->answer->id }}" method="post" class="d-inline">
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
                              <p class="card-text">{{ $comment->body }}</p>
                            </div>
                          </div>
                        @endforeach
                      @endif
                    </div>
                    <button class="btn btn-link toggle-comments" type="button" data-bs-toggle="collapse" data-bs-target="#comments-{{ $answer->id }}" aria-expanded="false" aria-controls="comments-{{ $answer->id }}">
                      Tampilkan Semua Komentar
                      <i class="fa-solid fa-chevron-down"></i>
                    </button>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-w4eS8msHBNSLfXYP7vn3vXUtQeEhrlphLJp8oCAxW19PVRb7G4LxLkIv+DDPjV61" crossorigin="anonymous"></script>
      <script>
        document.querySelectorAll('.toggle-comments').forEach(button => {
          button.addEventListener('click', function () {
            const comments = document.getElementById(this.getAttribute('data-bs-target').substring(1));
            if (comments.classList.contains('show')) {
              this.innerHTML = 'Tutup Seluruh Komentar <i class="fa-solid fa-chevron-up"></i>';
            } else {
              this.innerHTML = 'Tampilkan Semua Komentar <i class="fa-solid fa-chevron-down"></i>';
            }
          });
        });
  
        document.querySelectorAll('.collapse').forEach(collapse => {
          collapse.addEventListener('shown.bs.collapse', function () {
            const button = document.querySelector(.toggle-comments[data-bs-target="#${this.id}"]);
            if (button) {
              button.innerHTML = 'Tutup Seluruh Komentar <i class="fa-solid fa-chevron-up"></i>';
            }
          });
  
          collapse.addEventListener('hidden.bs.collapse', function () {
            const button = document.querySelector(.toggle-comments[data-bs-target="#${this.id}"]);
            if (button) {
              button.innerHTML = 'Tampilkan Semua Komentar <i class="fa-solid fa-chevron-down"></i>';
            }
          });
        });
      </script>
      
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>