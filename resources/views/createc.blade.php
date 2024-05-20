

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Detail Jawaban</title>
</head>
<body class="bg-primary">
    <nav class="navbar navbar-expand-lg sticky-top" style="background-color:#FAFAFA">
        <div class="container">
          <a class="navbar-brand mb-0 h1" href="/"><img src="/img/logo-tanyain.png" alt="Logo" width="100" class="d-inline-block align-text-top">
            </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
    </nav>
    <main class="container mt-5">
        <div class="row">
            <!-- Kolom Kiri: Menampilkan Jawaban -->
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-header d-flex align-items-center">
                        <a href="/home/{{ $answer->question->slug }}">
                            <i class="fa-solid fa-arrow-left me-2"></i>
                        </a>
                        <h5 class="mb-0">&#64;{{ $answer->user->username }}</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text">{{ $answer->body }}</p>
                        @if($answer->photo)
                        <img src="{{ asset('storage/photos/' . $answer->photo) }}" alt="Answer Photo" class="img-fluid">
                        @endif
                        <p>{{ $answer->created_at->diffForHumans() }}</p>
                    </div>
                </div>

                <!-- Form untuk menambahkan komentar -->
                <form method="post" action="/comment">
                    @csrf
                    <input type="hidden" id="answer_id" name="answer_id" value="{{ $answer->id }}">
                    <div class="mb-3">
                        <label for="body" class="form-label">Tambah Komentar:</label>
                        <textarea class="form-control @error('body') is-invalid @enderror" id="body" name="body" rows="3" required>{{ old('body') }}</textarea>
                        @error('body')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Komentar</button>
                </form>
            </div>

            <!-- Kolom Kanan: Menampilkan Komentar -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5>Komentar:</h5>
                        @foreach ($answer->comments->sortBy('created_at') as $commentIndex => $comment)
                        <div class="card mt-2">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-0">Komentar (ke-{{ $commentIndex + 1 }})</h6>
                                    <small class="text-muted">&#64;{{ $comment->user->username }}</small>
                                </div>
                                @if($comment->user_id == auth()->user()->id)
                                <div class="dropdown">
                                    <button class="btn btn-link p-0" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                        <li><a class="dropdown-item" href="/comment/{{ $comment->id }}/edit">Edit</a></li>
                                        <li>
                                            <form action="/comment/{{ $comment->id }}" method="post" class="d-inline">
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
                                <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>