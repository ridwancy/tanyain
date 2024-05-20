

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" 
      integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
      crossorigin="anonymous" referrerpolicy="no-referrer" />
	  

    <title>Register</title>
</head>
<body>
  @if(session()->has('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif
    <main>
		<section style="background-image: url(/img/background.svg)" class="bg-cover min-h-screen flex items-center justify-center">
			{{-- Register Container --}}
			<div class="bg-zinc-50 flex rounded-2xl shadow-lg max-w-3xl px-5 py-8 items-center mx-8">
				{{-- form --}}
				<div class="md:w-1/2 px-8 md:px-16">
					<h2 class="font-bold text-3xl text-[#002D74]">Selamat Datang</h2>
					<p class="text-xs mt-4 text-[#002D74]">Segera dapatkan jawaban dari pertanyaanmu</p>

					<form action="/register" method="post" class="flex flex-col gap-4">
						@csrf
						<div class="relative">
							<input type="text" name="username" class="w-full p-2 mt-8 rounded-xl w-full @error('username') border-red-500 @enderror" id="username" placeholder="Username" required value="{{ old('username') }}">
							@error('username')
							<div  class="text-red-500 text-xs italic">
								{{ $message }}
							</div>
							@enderror
						</div>
						<div>
							<input type="email" name="email" class="p-2 my-1 rounded-xl w-full @error('email') border-red-500 @enderror" id="email" placeholder="Email" required value="{{ old('email') }}">
							@error('email')
							<p class="text-red-500 text-xs italic">{{ $message }}</p>
							@enderror
						</div>
						<div class="flex">
							<input type="password" name="password" class="p-2 my-1 rounded-xl border-teal-100 w-full @error('password') border-red-500 @enderror" id="password" placeholder="Password" required>
							<button class="bg-transparent border-0 p-1">
								<i class="fa-regular fa-eye" id="eye"></i>
							</button>
							@error('password')
							<p class="text-red-500 text-xs italic">{{ $message }}</p>
							@enderror
						</div>
						
						<button type="submit" class="bg-[#002D74] rounded-xl text-white py-2 hover:scale-105 duration-300">Daftar</button>
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
						<p>Sudah punya akun?
						<a href="/login" class="font-semibold hover:underline duration-300 text-[#002D74]"> Masuk sekarang</a>
						</p>
					</div>
				</div>
				
				{{-- image --}}
				<div class="md:block hidden w-1/2"> 
					<img src ="img/cover_login.jpg" alt="cover" class="rounded-2xl">
				</div>
			</div>
		</section>




{{-- 
        <form action="/register" method="post">
          @csrf
          <img class="mb-4" src="img/logo.png" alt="" width="172" height="57">
          <h1 class="h3 mb-3 fw-normal">Please register</h1>
      
          <div class="form-floating">
            <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="username" placeholder="username" required value="{{ old('username') }}">
            <label for="username">username</label>
            @error('username')
            <div  class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
          </div>
          <div class="form-floating">
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="email" required value="{{ old('email') }}">
            <label for="email">Email address</label>
            @error('email')
            <div  class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
          </div>
          <div class="form-floating">
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password" required>
            <label for="password">Password</label>
            @error('password')
            <div  class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
          </div>

          <small >Already registered? <a href="/login">Login Now</a></small>
          <button class="btn btn-primary w-100 py-2" type="submit">Register</button>
        </form> --}}
      </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>