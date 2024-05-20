

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Tambah Pertanyaan</title>
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
            <a class="nav-link" href="/">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" style="color:#189F92" aria-current="page" href="/question/create">Ajukan Pertanyaan</a>
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

      <main class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-0 rounded-3">
                  <div class="card-header d-flex align-items-center">
                    <a href="/">
                    <i class="fa-solid fa-arrow-left me-2"></i>
                    </a>
                    <h4 class="fw-bold mb-0">Ajukan Pertanyaan</h4>
                  </div>
                    <div class="card-body">
                        <form method="post" action="/question" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                              <label for="body" class="form-label">Pertanyaan :</label>
                              <textarea class="form-control @error('body') is-invalid @enderror" id="body" name="body" rows="7" required>{{ old('body') }}</textarea>
                              @error('body')
                                  <div class="invalid-feedback">
                                      {{ $message }}
                                  </div>
                              @enderror
                          </div>
                          
                          <div class="mb-3 input-group">
                              <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo" name="photo"> 
                              @error('photo')
                                  <div class="invalid-feedback">
                                      {{ $message }}
                                  </div>
                              @enderror
                          </div>
                            <div class="row">
                                <div class="col">
                                    <label for="subject" class="form-label">Mata Kuliah</label>
                                    <select class="form-select" id="subject" name="subject_id" autofocus required>
                                        @foreach ($subjects as $subject)
                                            @if (old('subject_id') == $subject->id)
                                                <option value="{{ $subject->id }}" selected>{{ $subject->name_subject }}</option>
                                            @else
                                                <option value="{{ $subject->id }}">{{ $subject->name_subject }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="slug" class="form-label">Slug (Sesuaikan dengan keinginan anda)</label> 
                                    <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug') }}">
                                    @error('slug')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary float-end mt-3">Kirim Pertanyaan</button>
                        </form>
                    </div>
                </div>
            </div>
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