<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bank Sumut - Login</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link href="{{ asset('themes/auth/auth.css') }}" rel="stylesheet">

</head>

<body class="flex justify-center items-center h-screen w-full bg-no-repeat bg-cover bg-center">
  <div class="flex flex-col md:w-1/2 lg:w-1/3">
    <div class="p-10 bg-white rounded-xl shadow-lg my-6">
      <div class="pb-5">
        <div class="flex justify-center mb-4">
          <a class="font-bold text-2xl">Login</a>
        </div>        
      </div>
      <form id="form-login" action="{{route('process-login')}}" method="post">
        @csrf
        <div class="">
          <div class="mb-8 flex flex-col">
            <div class="flex flex-col">
              <label for="email">Email</label>
              <div id="input-container"
                class="flex max-w-[400px] lg:max-w-[600px] border-2 justify-between rounded-xl mt-2">
                <input type="email" name="email" id="email-input" class="p-4 w-full focus:outline-none rounded-xl"
                  placeholder="you@email.com" style="color: #6B7280;">
                <img src="{{ asset('themes/dashboard/assets/user.svg') }}" alt="user" class="p-4">
              </div>
            </div>
            <!-- Error Message Container -->
            @error('email')
            <div id="error-message" class="flex justify-center" style="color: red;">{{ $message }}</div>
            @enderror

            <div class="flex flex-col mt-2">
              <label for="password">Password</label>
              <div id="input-container-2"
                class="flex max-w-[400px] lg:max-w-[600px] border-2 justify-between rounded-xl mt-2">
                <input type="password" name="password" id="password-input" class="p-4 w-full focus:outline-none rounded-xl"
                  placeholder="Enter your password" style="color: #6B7280;">
                <img src="{{ asset('themes/dashboard/assets/eye-off.svg') }}" alt="toggle-icon" class="p-4" id="toggle-icon">
              </div>
            </div>
            @error('password')
            <div id="error-message" class="flex justify-center" style="color: red;">{{ $message }}</div>
            @enderror

            <div id="error-message" class="flex justify-center" style="color: red;"></div>
          </div>
          <div class="w-full">
            <button type="submit" class="w-full py-3 flex justify-center text-base font-semibold text-white rounded-md"
              style="background-color: #B6B6B6;" id="login-button">
              LOGIN
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <script src="{{ asset('themes/auth/auth.js') }}"></script>
</body>

</html>
