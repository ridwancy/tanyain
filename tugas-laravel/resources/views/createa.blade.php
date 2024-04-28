<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <link rel="stylesheet" href="css/style.css">

    <title>Buat Jawaban</title>
</head>
<body>
    <main class="col-lg-5">
        <div class="card mt-3">
            <h5 class="card-header">&#64;{{ $question->user->username }}</h5>
            <div class="card-body">
                <h6 class="card-title">{{ $question->subject->name_subject }}</h6>
                <p class="card-text">{{ $question->body }}</p>
                @if($question->photo)
                <img src="{{ asset('storage/photos/' . $question->photo) }}" alt="Question Photo" style="max-width: 100%;">
                @endif
                <p>{{ $question->created_at->diffForHumans() }}</p>
            </div>
        </div>
        <form method="post" action="/Answer" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="question_id" name="question_id"  value="{{ $question->id }}">
            <div class="mb-3">
                <label for="body" class="form-label">Jawaban :</label>
                <input type="text" class="form-control @error('body') is-invalid @enderror" id="body" name="body" required value="{{ old('body') }}">
                @error('body')
                <div  class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Gambar: (Opsional)</label>
                <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo" name="photo" >
                @error('photo')
                <div  class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Jawab</button>
          </form>
      </main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>