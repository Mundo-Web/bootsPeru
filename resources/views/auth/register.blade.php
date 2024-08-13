<x-authentication-layout>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
  <div class="py-6 md:py-0">
    <div class="flex flex-row md:h-screen justify-center">
      <div class="bg-blue-500 basis-1/2 hidden md:block font-poppins">
        <!-- Imagen ocupando toda la altura y sin desbordar -->
        <div style="background-image: url('{{ asset('images/imagen_login.png') }}')"
          class="bg-cover bg-center bg-no-repeat w-full h-full shadow-lg">
          {{-- <h1 class="font-medium text-[24px] py-10 bg-black bg-opacity-25 text-center text-white">
                        Deco Tab
                    </h1> --}}
        </div>
      </div>

      <!-- Segundo div -->
      <div class="w-full md:basis-1/2 text-[#151515] flex justify-center items-center font-Inter_Medium  md:px-0">
        <div class="w-5/6 flex flex-col gap-5">
          <div class="flex flex-col gap-5 text-center md:text-left">
            <h1 class="font-semibold font-Inter_Medium text-4xl tracking-tight">Crear una cuenta</h1>
            <p class="font-normal text-base font-Inter_Medium">
              ¿Ya tienes una cuenta?
              <a href="{{ route('login') }}" class="font-semibold font-Inter_Medium text-[16px] text-[#006BF6]">Iniciar
                Sesión</a>
            </p>
          </div>
          <div class="">
            <form method="POST" action="{{ route('register') }}" class="flex flex-col gap-5">
              @csrf
              @php
                if ($errors->any()) {
                    // dd($errors);
                }
              @endphp

              <div>
                <input type="text" placeholder="Nombre completo" id="name" name="name" :value="old('name')"
                  required autofocus
                  class="font-Inter_Regular text-[#666666] w-full py-5 px-4 focus:outline-none placeholder-gray-400 font-normal text-base bg-[#F8F8F8] rounded-lg border-0 focus:border-transparent focus:ring-0" />
                @error('name')
                  <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
              </div>
              <div>
                <input type="text" placeholder="Correo electrónico" id="email" name="email"
                  :value="old('email')" required
                  class="font-Inter_Regular text-[#666666] w-full py-5 px-4 focus:outline-none placeholder-gray-400 font-normal text-base bg-[#F8F8F8] rounded-lg border-0 focus:border-transparent focus:ring-0" />
                @error('email')
                  <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
              </div>

              <div class="relative w-full">
                <!-- Input -->
                <input type="password" placeholder="Contraseña" id="password" name="password" required
                  autocomplete="new-password"
                  class="font-Inter_Regular text-[#666666] w-full py-5 px-4 focus:outline-none placeholder-gray-400 font-normal text-base bg-[#F8F8F8] rounded-lg border-0 focus:border-transparent focus:ring-0" />

                <!-- Imagen -->
                <img src="./images/svg/pass_eyes.svg" alt="password"
                  class="absolute right-4 top-1/2 transform -translate-y-1/2 cursor-pointer ojopassWord" />
                @error('password')
                  <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
              </div>

              <div class="relative w-full">
                <!-- Input -->
                <input type="password" placeholder="Confirmar contraseña" id="password_confirmation"
                  name="password_confirmation" required autocomplete="new-password"
                  class="font-Inter_Regular text-[#666666] w-full py-5 px-4 focus:outline-none placeholder-gray-400 font-normal text-base bg-[#F8F8F8] rounded-lg border-0 focus:border-transparent focus:ring-0" />
                <!-- Imagen -->
                <img src="./images/svg/pass_eyes.svg" alt="password"
                  class="absolute right-4 top-1/2 transform -translate-y-1/2 cursor-pointer ojopassWord_confirmation" />
                @error('password_confirmation')
                  <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
              </div>

              <div class="flex gap-3">
                <input type="checkbox" id="acepto_terminos" class="w-4" required />
                <label name="newsletter" id="newsletter" class="font-normal text-sm font-Inter_Medium">

                  Acepto la
                  <span class="font-bold text-[#006BF6] cursor-pointer open-modal" data-tipo='PoliticaPriv'> Política de
                    Privacidad</span>
                  y los
                  <span class="font-bold text-[#006BF6] cursor-pointer open-modal" data-tipo='terminosUso'>
                    Términos de Uso
                  </span>
                </label>
              </div>

              <div class="px-4">
                <input type="submit" value="Crear Cuenta"
                  class="text-white bg-[#006BF6] w-full py-3 rounded-3xl cursor-pointer font-light font-Inter_Medium tracking-wide" />
              </div>
            </form>
            {{-- <x-validation-errors class="mt-4" /> --}}
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="modaalpoliticas" class="modal modalbanner">
    <div class="p-2" id="modal-content">
      <h1 id="modal-title">MODAL POLITICAS</h1>
      <div id="modal-body-content"></div>
    </div>
  </div>

  <script>
    const politicas = @json($politicas);
    const terminos = @json($terminos);

    $(document).on('click', '.open-modal', function() {
      var tipo = $(this).data('tipo');
      var title = '';
      var content = '';
      console.log(politicas)
      console.log(terminos)

      if (tipo == 'PoliticaPriv') {
        title = 'Política de Privacidad';
        content = politicas.content;
      } else if (tipo == 'terminosUso') {
        title = 'Términos y condiciones';
        content = terminos.content;
      }

      $('#modal-title').text(title);
      $('#modal-body-content').html(content);

      $('#modaalpoliticas').modal({
        show: true,
        fadeDuration: 100
      });
    });

    $(document).on("click", '.ojopassWord', function() {


      var input = $(this).siblings('input');

      // Alterna el tipo de entrada entre 'password' y 'text'
      if (input.attr('type') === 'password') {
        input.attr('type', 'text');
      } else {
        input.attr('type', 'password');
      }

    })
    $(document).on("click", '.ojopassWord_confirmation', function() {
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
