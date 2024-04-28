<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="css/style.css">

    <title>Login</title>
</head>
<body>
  @if(session()->has('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif
  @if(session()->has('loginError'))
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('loginError') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif

  <main>
    <section class="bg-emerald-50 min-h-screen flex items-center justify-center">
        {{-- Login Container --}}
        <div class="bg-zinc-50 flex rounded-2xl shadow-lg max-w-3xl p-5 items-center">
            {{-- form --}}
            <div class="md:w-1/2 px-8 md:px-16">
                <h2 class="font-bold text-2xl text-[#002D74]">Selamat Datang</h2>
                <p class="text-xs mt-4 text-[#002D74]">Dapatkan jawaban dalam hitungan menit sehingga dirimu dapat menyelesaikan tugas lebih cepat</p>
            
                <form action="/login" method="post" class="flex flex-col gap-4">
                    <input type="text" name="username" id="username" placeholder="Username" class="p-2 mt-8 rounded-xl border-teal-100" value="{{ old('username') }}" required autofocus>
                    <div class="relative">
                        <input type="password" name="password" id="password" placeholder="Password" class="p-2 my-2 rounded-xl borderteal-100 w-full" required>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="gray" class="bi bi-eye absolute top-1/2 right-3 -translate-y-1/2" viewBox="0 0 16 16">
                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                        </svg>
                    </div>
                    <button class="bg-[#002D74] rounded-xl text-white py-2 hover:scale-105 duration-300">Login</button>
                </form>
            </div>

            {{-- image --}}
            <div class="w-1/2 p-5">
                <img src ="img/cover_login.jpg" alt="cover" class="rounded-2xl">
            </div>

        </div>
    </section>
  </main>
  {{--<main>
      <main class="min-h-screen bg-gray-100 flex items-center justify-center">
        <form action="/login" method="post" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 w-full max-w-md">
            @csrf
            <img class="mx-auto mb-8" src="img/logo2.png" alt="Logo" width="172" height="57">
            <h1 class="text-center text-xl font-bold mb-8">Selamat Datang Kembali</h1>
            <div class="mb-4">
                <label for="username" class="block text-gray-700 text-sm font-bold mb-2">Username</label>
                <input type="text" name="username" id="username" placeholder="Username" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('username') border-red-500 @enderror" value="{{ old('username') }}" required autofocus>
                @error('username')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-6">
                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                <input type="password" name="password" id="password" placeholder="Password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('password') border-red-500 @enderror" required>
                @error('password')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-6 text-center">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full focus:outline-none focus:shadow-outline">Login</button>
            </div>
            <p class="text-center text-sm">
                Not registered? <a href="/register" class="text-blue-500 hover:text-blue-700">Register Now</a>
            </p>
        </form>
    </main>--}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>