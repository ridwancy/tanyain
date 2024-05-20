


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <link rel="stylesheet" href="/css/style.css">

    <title>Edit Komentar</title>
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
            </div>

        <!-- Form untuk mengedit komentar -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
        <form method="post" action="/comment/{{ $comment->answer->id }}">
            @method('put')
            @csrf
            <input type="hidden" id="answer_id" name="answer_id"  value="{{ $answer->id }}">
            <div class="mb-3">
                <label for="body" class="form-label">Komentar :</label>
                <textarea class="form-control @error('body') is-invalid @enderror" id="body" name="body" rows="3" required>{{ old('body' , $comment->body) }}</textarea>
                @error('body')
                <div  class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Edit</button>
          </form>
        </div>
        </div>
        </div>
        </div>
      </main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>