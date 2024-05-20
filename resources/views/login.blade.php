

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" 
      integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
      crossorigin="anonymous" referrerpolicy="no-referrer" />

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
    <section style="background-image: url(/img/background.svg)" class="bg-cover min-h-screen flex items-center justify-center">
        {{-- Login Container --}}
        <div class="bg-zinc-50 flex rounded-2xl shadow-lg max-w-3xl px-5 py-8 items-center mx-8">
            {{-- form --}}
            <div class="md:w-1/2 px-8 md:px-16">
                <h2 class="font-bold text-3xl text-[#002D74]">Selamat Datang</h2>
                <p class="text-xs mt-4 text-[#002D74]">Dapatkan jawaban dalam hitungan menit sehingga dirimu dapat menyelesaikan tugas lebih cepat</p>
            
				<form action="/login" method="post" class="flex flex-col gap-4">
					@csrf
					<div>
						<input type="text" name="username" id="username" placeholder="Username" class="p-2 mt-8 rounded-xl border-lime-600 w-full @error('username') border-red-500 @enderror" value="{{ old('username') }}" required autofocus>
						@error('username')
						<p class="text-red-500 text-xs italic">{{ $message }}</p>
						@enderror
					</div>
					<div class="flex">
						<input type="password" name="password" id="password" placeholder="Password" class="p-2 my-2 rounded-xl border-teal-100 w-full @error('password') border-red-500 @enderror" required>
						<button class="bg-transparent border-0 p-1">
							<i class="fa-regular fa-eye" id="eye"></i>
						</button>
						@error('password')
						<p class="text-red-500 text-xs italic">{{ $message }}</p>
						@enderror
					</div>
					<button type="submit" class="bg-[#002D74] rounded-xl text-white py-2 hover:scale-105 duration-300">Masuk</button>
				</form>
				
				<script>
					const eye = document.getElementById('eye');
					const passwordInput = document.getElementById('password');
				
					eye.addEventListener('click', function () {
						if (passwordInput.type === 'password') {
							passwordInput.type = 'text';
							eye.classList.remove('fa-eye');
							eye.classList.add('fa-eye-slash');
						} else {
							passwordInput.type = 'password';
							eye.classList.remove('fa-eye-slash');
							eye.classList.add('fa-eye');
						}
					});
				</script>
				
                <div class="mt-3 py-2 text-xs flex justify-center items-center text-[##0f172a]">
                  <p>Belum punya akun? Ayo
                  <a href="/register" class="font-semibold hover:underline duration-300 text-[#002D74]"> Daftar</a>
                  </p>
                </div>
            </div>

            {{-- image --}}
            <div class="md:block hidden w-1/2"> 
                <img src ="img/cover_login.jpg" alt="cover" class="rounded-2xl">
            </div>

        </div>
    </section>
  </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>