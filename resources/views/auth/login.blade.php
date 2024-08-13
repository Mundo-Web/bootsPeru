<x-authentication-layout>

  <div class="flex h-screen">
    <!-- Primer div -->
    <div class="basis-1/2 hidden md:block font-poppins">
      <!-- Imagen ocupando toda la altura y sin desbordar -->
      <div style="background-image: url('{{ asset('images/imagen_login.png') }}')"
        class="bg-cover bg-center bg-no-repeat w-full h-full shadow-lg">
        {{-- <h1 class="font-medium text-[24px] py-10 bg-black bg-opacity-25 text-center text-white">
          {{ config('app.name', 'Laravel') }}
        </h1> --}}
      </div>
    </div>

    <!-- Segundo div -->
    <div class="w-full md:basis-1/2  text-[#151515] flex justify-center items-center font-Inter_Medium">
      <div class="w-5/6 flex flex-col gap-5">
        <div class="flex flex-col gap-5 text-center md:text-left">
          @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
              {{ session('status') }}
            </div>
          @endif
          <h1 class="font-semibold font-Inter_Medium text-4xl tracking-tight">Iniciar Sesión</h1>
          <p class="font-normal text-base font-Inter_Medium tracking-tight">
            Inicie sesión utilizando los detalles de la cuenta a continuación.
          </p>
        </div>
        <div class="">
          <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-5">
            @csrf
            <div>
              <input type="text" placeholder="Tu nombre de usuario o correo electrónico" name="email"
                id="email" type="email" :value="old('email')" required autofocus
                class="font-Inter_Medium w-full py-5 px-4 focus:outline-none placeholder-gray-400 font-normal text-base bg-[#F8F8F8] rounded-lg border-0 focus:border-transparent focus:ring-0" />
            </div>

            <div class="relative w-full">
              <!-- Input -->
              <input type="password" placeholder="Contraseña" id="password" name="password" required
                autocomplete="current-password"
                class="font-Inter_Medium w-full py-5 px-4 focus:outline-none placeholder-gray-400 font-normal text-base bg-[#F8F8F8] rounded-lg border-0 focus:border-transparent focus:ring-0" />
              <!-- Imagen -->
              <img src="./images/svg/pass_eyes.svg" alt="password"
                class="absolute right-4 top-1/2 transform -translate-y-1/2 cursor-pointer ojopassWord" />
            </div>

            <div class="flex gap-3 px-4 justify-between">
              <div>
                <input type="checkbox" id="acepto_terminos" class="w-4" />
                <label for="acepto_terminos" class="font-normal text-base font-Inter_Medium">Recuérdame
                </label>
              </div>

              @if (Route::has('password.request'))
                <div>
                  <a href="{{ route('password.request') }}"
                    class="font-normal text-base font-Inter_Medium text-[#006BF6]">¿Olvidaste
                    tu contraseña?</a>
                </div>
              @endif

            </div>

            <div class="px-4">
              <input type="submit" value="Iniciar Sesión"
                class="text-white bg-[#006BF6] w-full py-4 rounded-3xl cursor-pointer font-light font-Inter_Medium tracking-wide" />
            </div>

            <div class="flex flex-row justify-center items-centerpx-4">
              <a href="{{ route('register') }}"
                class="text-[#006BF6] w-full py-2 rounded-3xl cursor-pointer font-light font-Inter_Medium tracking-normal text-center">Crear
                una Cuenta</a>
            </div>

          </form>
          <x-validation-errors class="mt-4" />
        </div>
      </div>
    </div>
  </div>

  <script>
    $(document).on("click", '.ojopassWord', function() {


      var input = $(this).siblings('input');

      // Alterna el tipo de entrada entre 'password' y 'text'
      if (input.attr('type') === 'password') {
        input.attr('type', 'text');
      } else {
        input.attr('type', 'password');
      }

    })
  </script>
</x-authentication-layout>
