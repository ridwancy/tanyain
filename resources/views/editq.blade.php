


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style.css">
    <title>Edit Pertanyaan</title>
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

    <main class="d-flex justify-content-center">
        <div class="card mt-3 mx-10" style="width: 70%; border-radius: 20px">
            <div class="card-body">
        <form method="post" action="/question/{{ $question->slug }}" enctype="multipart/form-data">
            @method('patch')
            @csrf
            <div class="mb-3">
              <label for="subject" class="form-label">Mata Kuliah</label>
              <select class="form-select" id="subject" name="subject_id" autofocus required>
                @foreach ($subjects as $subject)
                @if (old('subject_id', $question->subject_id) == $subject->id)
                <option value="{{ $subject->id }}" selected>{{ $subject->name_subject }}</option>
                @else
                <option value="{{ $subject->id }}">{{ $subject->name_subject }}</option>
                @endif
                @endforeach
              </select>
            </div>
            
            <div class="mb-3">
                <label for="body" class="form-label">Pertanyaan:</label>
                <textarea class="form-control @error('body') is-invalid @enderror" id="body" name="body" rows="7" required>{{ old('body', $question->body) }}</textarea>
                @error('body')
                  <div  class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Gambar: (Silakan submit ulang gambar)</label>
                <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo" name="photo"> 
                @error('photo')
                <div  class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="slug" class="form-label">Slug (Silakan potong jika terlalu panjang atau tidak perlu diedit)</label> 
                <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" required value="{{ old('slug', $question->slug) }}">
                @error('slug')
                <div  class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
              </div>
            <button type="submit" class="btn btn-primary float-end mt-3">Edit</button>
          </form>
        </div>
      </main>
      
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
    const body = document.querySelector('#body');
    const slug = document.querySelector('#slug');

    body.addEventListener('change', function(){
        fetch('/question/checkSlug?body=' + body.value)
        .then(response => response.json())
        .then(data =>slug.value = data.slug)
    });
</script>
</body>
</html>