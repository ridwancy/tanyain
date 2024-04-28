<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <link rel="stylesheet" href="css/style.css">

    <title>Edit Komentar</title>
</head>
<body>
    <main class="col-lg-5">
        <div class="card mt-3">
            <h5 class="card-header">&#64;{{ $answer->user->username }}</h5>
            <div class="card-body">
                <p class="card-text">{{ $answer->body }}</p>
                @if($answer->photo)
                <img src="{{ asset('storage/photos/' . $answer->photo) }}" alt="Answer Photo" style="max-width: 100%;">
                @endif
                <p>{{ $answer->created_at->diffForHumans() }}</p>
                <h5>Komentar :</h5>
                @foreach ($answer->comments->sortBy('created_at') as $commentIndex => $comment)
                <div class="card mt-1">
                    <div class="card-header">
                        <h5>Komentar(ke-{{ $commentIndex + 1 }}) : </h5>
                        <h5>&#64;{{ $comment->user->username }}</h5>
                    </div>
                <div class="card-body">
                    <p class="card-text">{{ $comment->body }}</p>
                    <p>{{ $comment->created_at->diffForHumans() }}</p>
                </div>
                </div>
              @endforeach
            </div>
        </div>
        <form method="post" action="/comment/{{ $comment->answer->id }}">
            @method('put')
            @csrf
            <input type="hidden" id="answer_id" name="answer_id"  value="{{ $answer->id }}">
            <div class="mb-3">
                <label for="body" class="form-label">Komentar :</label>
                <input type="text" class="form-control @error('body') is-invalid @enderror" id="body" name="body" required value="{{ old('body', $comment->body) }}">
                @error('body')
                <div  class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Edit</button>
          </form>
      </main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>