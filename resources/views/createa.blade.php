

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Buat Jawaban</title>
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
            <!-- Kolom Kiri: Menampilkan Pertanyaan -->
            <div class="col-md-4">
                <div class="card mb-2">
                    <div class="card-header d-flex align-items-center">
                        <a href="/home/{{ $question->slug }}">
                            <i class="fa-solid fa-arrow-left me-2"></i>
                        </a>
                        <h4 class="mb-0"&#64>{{ $question->user->username }}</h4>
                    </div>
                    {{-- <h5 class="card-header">&#64;{{ $question->user->username }}</h5> --}}
                    <div class="card-body">
                        <h6 class="card-title">{{ $question->subject->name_subject }}</h6>
                        <p class="card-text">{{ $question->body }}</p>
                        @if($question->photo)
                        <img src="{{ asset('storage/photos/' . $question->photo) }}" alt="Question Photo" style="max-width: 100%;">
                        @endif
                        <p>{{ $question->created_at->diffForHumans() }}</p>
                    </div>
                </div>
            </div>
            
            <!-- Kolom Kanan: Formulir Menjawab -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="/Answer" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" id="question_id" name="question_id" value="{{ $question->id }}">
                            <div class="mb-3">
                                <label for="body" class="form-label">Jawaban:</label>
                                <textarea class="form-control @error('body') is-invalid @enderror" id="body" name="body" rows="5" required>{{ old('body') }}</textarea>
                                @error('body')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="photo" class="form-label">Gambar: (Opsional)</label>
                                <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo" name="photo">
                                @error('photo')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Jawab</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>