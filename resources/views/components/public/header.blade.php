@php
  $pagina = Route::currentRouteName();
  $isIndex = $pagina == 'index';
@endphp


<style>
  nav a .underline-this {
    position: relative;
    overflow: hidden;
    display: inline-block;
    text-decoration: none;
    /* padding-bottom: 4px; */
  }

  nav a .underline-this::before,
  nav a .underline-this::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 2px;
    background-color: #FF5E14;
    transform: scaleX(0);
    transition: transform 0.3s ease;
  }

  nav a .underline-this::after {
    transform-origin: right;
  }

  nav a:hover .underline-this::before,
  nav a:hover .underline-this::after {
    transform: scaleX(1);
  }

  nav a:hover .underline-this::before {
    transform-origin: left;
  }

  nav li {
    padding: 0 !important;
    margin: 0 !important;
  }

  .jquery-modal.blocker.current {
    z-index: 30;
  }
</style>

<style>
  .bg-image {
    background-image: url('');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 900;
  }
</style>

{{-- <img src="{{ asset('images/contacto.png') }}" class="absolute top-0 left-0 w-full z-[99999] opacity-30"></img> --}}

<div class="navigation shadow-xl px-5 overflow-y-auto" style="z-index: 9999; background-color: #fff !important ">
  <button aria-label="hamburguer" type="button" class="hamburger" id="position" onclick="show()">
    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M18 2L2 18M18 18L2 2" stroke="#272727" stroke-width="2.66667" stroke-linecap="round" />
    </svg>
  </button>
  <nav class="w-full h-full overflow-y-auto p-8" x-data="{ openCatalogo: true, openSubMenu: null }">
    <ul class="space-y-1">
      <li>
        <a href="/"
          class="text-[#272727] font-medium font-poppins text-sm py-2 px-3 block hover:opacity-75 transition-opacity duration-300 {{ $isIndex ? 'text-[#FF5E14]' : '' }}">
          <span class="underline-this">
            <svg
              class="inline-block w-3 h-3 mb-0.5 me-2 text-gray-400 dark:text-gray-500 group-hover:text-blue-600 dark:group-hover:text-blue-500"
              aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
              <path
                d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
            </svg>
            INICIO
          </span>
        </a>
      </li>
      <li>
        <a href="/nosotros"
          class="text-[#272727] font-medium font-poppins text-sm py-2 px-3 block hover:opacity-75 transition-opacity duration-300 {{ $isIndex ? 'text-[#FF5E14]' : '' }}">
          <span class="underline-this">
            <svg
              class="inline-block w-3 h-3 mb-0.5 me-2 text-gray-400 dark:text-gray-500 group-hover:text-blue-600 dark:group-hover:text-blue-500"
              aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
              <path
                d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
            </svg>
            NOSOTROS
          </span>
        </a>
      </li>
      <li>
        <a @click="openCatalogo = !openCatalogo" href="javascript:void(0)"
          class="text-[#272727] flex justify-between items-center font-medium font-poppins text-sm py-2 px-3 hover:opacity-75 transition-opacity duration-300 {{ $pagina == 'catalogo' ? 'text-[#FF5E14]' : '' }}">
          <span class="underline-this">
            <svg
              class="inline-block w-3 h-3 mb-0.5 me-2 text-gray-400 dark:text-gray-500 group-hover:text-blue-600 dark:group-hover:text-blue-500"
              aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
              <path
                d="M15.977.783A1 1 0 0 0 15 0H3a1 1 0 0 0-.977.783L.2 9h4.239a2.99 2.99 0 0 1 2.742 1.8 1.977 1.977 0 0 0 3.638 0A2.99 2.99 0 0 1 13.561 9H17.8L15.977.783ZM6 2h6a1 1 0 1 1 0 2H6a1 1 0 0 1 0-2Zm7 5H5a1 1 0 0 1 0-2h8a1 1 0 1 1 0 2Z" />
              <path
                d="M1 18h16a1 1 0 0 0 1-1v-6h-4.439a.99.99 0 0 0-.908.6 3.978 3.978 0 0 1-7.306 0 .99.99 0 0 0-.908-.6H0v6a1 1 0 0 0 1 1Z" />
            </svg>
            PRODUCTOS
          </span>
          <span :class="{ 'rotate-180': openCatalogo }"
            class="ms-1 inline-block transform transition-transform duration-300">↓</span>
        </a>
        <ul x-show="openCatalogo" x-transition class="ml-3 mt-1 space-y-1 border-l border-gray-300">
          <li>
            <a href="{{ route('Catalogo.jsx') }}"
              class="text-[#272727] flex items-center py-2 px-3 hover:opacity-75 transition-opacity duration-300">
              <span class="underline-this">
                Todas las categorías

              </span>

            </a>
            @if (count($categorias) > 0)


              <div x-data="{ openCategories: {} }">
                @foreach ($categorias as $item)
                  <div
                    class="text-[#272727] flex items-center py-2 px-3 hover:opacity-75 transition-opacity duration-300"
                    @click="openCategories[{{ $item->id }}] = !openCategories[{{ $item->id }}]">
                    <span>{{ $item->name }}</span>
                    <svg class="w-5 h-5 transform transition-transform"
                      :class="{ 'rotate-180': openCategories[{{ $item->id }}] }" fill="none"
                      stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                  </div>

                  <div x-show="openCategories[{{ $item->id }}]" class="p-2  border-t-0 border-gray-200 ">
                    @foreach ($item->subcategories as $subitem)
                      <label for="item-category-{{ $subitem->id }}"
                        class="text-custom-border flex flex-row gap-2 items-center cursor-pointer">
                        <a href="/catalogo?subcategoria={{ $subitem->id }}" id="item-category-{{ $subitem->id }}"
                          name="category"
                          class="rounded-sm border-none text-[#272727] flex items-center py-2 px-3 hover:opacity-75 transition-opacity duration-300"
                          value="{{ $subitem->id }}">
                          {{ $subitem->name }}
                        </a>
                      </label>
                    @endforeach
                  </div>
                @endforeach
              </div>

            @endif
          </li>

        </ul>
      </li>
      <li>
        <a href="/blog/0"
          class="text-[#272727] font-medium font-poppins text-sm py-2 px-3 block hover:opacity-75 transition-opacity duration-300 {{ $pagina == 'contacto' ? 'text-[#FF5E14]' : '' }}">
          <span class="underline-this">
            <svg
              class="inline-block w-3 h-3 mb-0.5 me-2 text-gray-400 dark:text-gray-500 group-hover:text-blue-600 dark:group-hover:text-blue-500"
              aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 14 20">
              <path
                d="M12 0H2a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2ZM7.5 17.5h-1a1 1 0 0 1 0-2h1a1 1 0 0 1 0 2ZM12 13H2V4h10v9Z" />
            </svg>
            BLOG
          </span>
        </a>
      </li>
      <li>
        <a href="/contacto"
          class="text-[#272727] font-medium font-poppins text-sm py-2 px-3 block hover:opacity-75 transition-opacity duration-300 {{ $pagina == 'contacto' ? 'text-[#FF5E14]' : '' }}">
          <span class="underline-this">
            <svg
              class="inline-block w-3 h-3 mb-0.5 me-2 text-gray-400 dark:text-gray-500 group-hover:text-blue-600 dark:group-hover:text-blue-500"
              aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
              <path
                d="M19 4h-1a1 1 0 1 0 0 2v11a1 1 0 0 1-2 0V2a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2v15a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3V5a1 1 0 0 0-1-1ZM3 4a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V4Zm9 13H4a1 1 0 0 1 0-2h8a1 1 0 0 1 0 2Zm0-3H4a1 1 0 0 1 0-2h8a1 1 0 0 1 0 2Zm0-3H4a1 1 0 0 1 0-2h8a1 1 0 1 1 0 2Zm0-3h-2a1 1 0 0 1 0-2h2a1 1 0 1 1 0 2Zm0-3h-2a1 1 0 0 1 0-2h2a1 1 0 1 1 0 2Z" />
              <path d="M6 5H5v1h1V5Z" />
            </svg>
            CONTACTO
          </span></a>
      </li>

      @if ($tags->count() > 0)
        @foreach ($tags as $item)
          <li>
            <a href="/catalogo?tag={{ $item->id }}"
              class="text-[#272727] font-medium font-poppins text-sm py-2 px-3 block hover:opacity-75 transition-opacity duration-300 {{ $pagina == 'contacto' ? 'text-[#FF5E14]' : '' }}">
              <span class="underline-this  ">
                {{ $item->name }} </span>
            </a>

          </li>
        @endforeach

      @endif
    </ul>
  </nav>

</div>


<header class="font-Inter_Regular">
  @foreach ($datosgenerales as $item)
    <div
      class="bg-[#006BF6] h-[50px] flex lg:justify-between justify-center w-full px-[5%] xl:px-[8%] py-3 text-base items-center">
      <a class="hidden md:flex text-white font-Inter_Regular text-[17px] text-start  gap-3"
        href="https://api.whatsapp.com/send?phone={{ $item->cellphone }}&text={{ $item->mensaje_whatsapp }}"
        target="_blank">



        <div class="flex flex-row gap-4 items-center">
          <img src="{{ asset('images/img/WhatsApp.png') }}" alt="whatsapp" class="w-8" />
          <h3>

            {{ $item->cellphone }}
          </h3>
        </div>



        {{-- <div>|</div>
        <a href="#">Direccion</a> --}}

      </a>
      <h3 class="text-white font-Inter_Regular  text-center  lg:flex">
        {{ $datosgenerales[0]->cintillo }}
      </h3>
      <div class="text-white font-Inter_Regular  text-end hidden lg:flex">
        @if (Auth::user() == null)
          <a href="/login">Log In </a> / <a href="/register">Sign Up</a>
        @endif

      </div>
    </div>
  @endforeach

  <div>
    <div id="header-menu" class="flex justify-between gap-5 w-full px-[5%] xl:px-[8%] py-2  text-[17px] relative">

      <div id="menu-burguer" class="lg:hidden z-10 w-max">
        <img class="h-10 w-10 cursor-pointer" src="{{ asset('images/img/menu_hamburguer.png') }}"
          alt="menu hamburguesa" onclick="show()" />
      </div>

      <div class="w-auto min-w-[110px]">
        <a href="#">
          <img id="logo-boostperu" class="w-[170px]  " {{-- public\images\svg\LOGO2.png --}}
            src="{{ asset($isIndex ? 'images/svg/LogoBoost2.svg' : 'images/svg/LogoBoost2.svg') }}"
            alt="boostperu" />
        </a>
      </div>

      <div class="hidden lg:flex items-center justify-center ">
        <div>
          <nav id="menu-items"
            class=" text-[#333] text-base font-Inter_Medium flex gap-5 xl:gap-6 items-center justify-center "
            x-data="{ openCatalogo: false, openSubMenu: null }">
            <a href="/" class="font-medium hover:opacity-75 other-class">
              <span class="underline-this">INICIO</span>
            </a>
            <a href="/nosotros" class="font-medium hover:opacity-75 other-class">
              <span class="underline-this">NOSOTROS</span>
            </a>

            <a id="productos-link" href="{{ route('Catalogo.jsx') }}" class="font-medium ">
              <span class="underline-this">PRODUCTOS</span>
              <div id="productos-link-h" class="w-0"></div>

            </a>



            @if ($blog > 0)
              <a href="/blog/0" class="font-medium hover:opacity-75 other-class">
                <span class="underline-this">BLOG </span>
              </a>
            @endif


            <a href="/contacto" class="font-medium hover:opacity-75  other-class">
              <span class="underline-this">CONTACTO</span>
            </a>
            @if ($offerExists)
              <a href="{{ route('Ofertas.jsx') }}" class="font-medium hover:opacity-75 other-class">
                <span class="underline-this">OFERTAS</span>
              </a>
            @endif
            @if ($tags->count() > 0)
              @foreach ($tags as $item)
                <a href="/catalogo?tag={{ $item->id }}" class="font-medium hover:opacity-75    other-class"
                  style="color: {{ $item->color }}">
                  <span class="underline-this  ">
                    {{ $item->name }} </span>
                </a>
              @endforeach

            @endif

          </nav>
        </div>
      </div>

      <div class="flex justify-end md:w-auto md:justify-center items-center gap-2">

        @if (Auth::user() == null)
          <a class="hidden md:flex" href="{{ route('login') }}"><img class="bg-white rounded-lg"
              src="{{ asset('images/svg/header_user.svg') }}" alt="user" /></a>
        @else
          <div class="relative  hidden md:inline-flex" x-data="{ open: false }">
            <button class="px-3 py-5 inline-flex justify-center items-center group" aria-haspopup="true"
              @click.prevent="open = !open" :aria-expanded="open">
              <div class="flex items-center truncate">
                <span id="username"
                  class="truncate ml-2 text-sm font-medium dark:text-slate-300 group-hover:opacity-75 dark:group-hover:text-slate-200 text-[#272727] ">
                  {{ explode(' ', Auth::user()->name)[0] }}</span>
                <svg class="w-3 h-3 shrink-0 ml-1 fill-current text-slate-400" viewBox="0 0 12 12">
                  <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
                </svg>
              </div>
            </button>
            <div
              class="origin-top-right z-10 absolute top-full min-w-44 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 py-1.5 rounded shadow-lg overflow-hidden mt-1"
              @click.outside="open = false" @keydown.escape.window="open = false" x-show="open">
              <ul>
                <li class="hover:bg-gray-100">
                  <a class="font-medium text-sm text-black flex items-center py-1 px-3"
                    href="{{ route('micuenta') }}" @click="open = false" @focus="open = true"
                    @focusout="open = false">Mi Cuenta</a>
                </li>

                <li class="hover:bg-gray-100">
                  <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf
                    <button type="submit" class="font-medium text-sm text-black flex items-center py-1 px-3"
                      @click.prevent="$root.submit(); open = false">
                      {{ __('Cerrar sesión') }}
                    </button>
                  </form>
                </li>
              </ul>
            </div>
          </div>
        @endif
        {{-- <div class="bg-[#EB5D2C] flex justify-center items-center rounded-full w-7 h-7">
            <span id="itemsCount" class="text-white"></span>
          </div> --}}

        <div class="relative inline-block cursor-pointer justify-center min-w-7">
          <button onclick="openSearch()" class="flex justify-center items-center">
            <img src="{{ asset('images/svg/search_boost.svg') }}"
              class="bg-white rounded-lg max-w-full h-auto cursor-pointer" />
          </button>

        </div>


        <div class="flex justify-center items-center min-w-[38px]">
          <div id="open-cart" class="relative inline-block cursor-pointer pr-3">
            <span id="itemsCount"
              class="bg-[#EB5D2C] text-xs font-medium text-white text-center px-[7px] py-[2px]  rounded-full absolute bottom-0 right-0 ml-3">0</span>
            <img src="{{ asset('images/svg/bag_boost.svg') }}"
              class="bg-white rounded-lg p-1 max-w-full h-auto cursor-pointer" />
          </div>
          {{-- <input type="checkbox" class="bag__modal" id="check" /> --}}

        </div>
      </div>

    </div>
  </div>

  <div class="flex justify-end relative">
    <div class="fixed bottom-[36px] z-[10] right-[128px] md:right-[25px] fixedWhastapp">
      <a href="https://api.whatsapp.com/send?phone={{ $datosgenerales[0]->whatsapp }}&text={{ $datosgenerales[0]->mensaje_whatsapp }}"
        target="_blank" class="">
        <img src="{{ asset('images/img/WhatsApp.png') }}" alt="whatsapp" class="w-20" />
      </a>
    </div>
  </div>

  <div id="myOverlay" class="overlay" style="z-index: 200;">
    <span class="closebtn" onclick="closeSearch()">×</span>
    <div class="overlay-content w-3/4 md:w-1/2 z-30">
      <form>
        <input type="text" placeholder="Buscar.." name="search" id="buscarproducto" class="rounded-2xl ">
      </form>
      <div id="resultados" class="bg-white p-[1px] rounded-xl  overflow-y-auto max-h-[300px]"></div>
    </div>
  </div>

</header>
<div id="cart-modal"
  class="bag !absolute top-0 right-0 md:w-[450px] cartContainer border shadow-2xl  !rounded-sm !p-0 !z-30"
  style="display: none">
  <div class="p-4 flex flex-col h-[90vh] justify-between gap-2">
    <div class="flex flex-col">
      <div class="flex justify-between ">
        <h2 class="font-semibold font-Inter_Medium text-[28px] text-[#151515] pb-5">Carrito</h2>
        <div id="close-cart" class="cursor-pointer">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="w-6 h-6">
            <path stroke="#272727" stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
          </svg>
        </div>
      </div>
      <div class="overflow-y-scroll h-[calc(90vh-200px)] scroll__carrito">
        <table class="w-full">
          <tbody id="itemsCarrito">
          </tbody>
        </table>
      </div>
    </div>
    <div class="flex flex-col gap-2 pt-2">
      <div class="text-[#006BF6]  text-xl flex justify-between items-center">
        <p class="font-Inter_Medium font-semibold">Total</p>
        <p class="font-Inter_Medium font-semibold" id="itemsTotal">S/ 0.00</p>
      </div>
      <div>
        <a href="/carrito"
          class="font-normal font-Inter_Medium text-lg bg-[#006BF6] py-3 px-5 rounded-2xl text-white cursor-pointer w-full inline-block text-center">Ver
          Carrito</a>
      </div>
    </div>
  </div>
</div>

<script>
  let clockSearch;
  let ajaxRequest;

  function openSearch() {
    document.getElementById("myOverlay").style.display = "block";

  }

  function closeSearch() {
    document.getElementById("myOverlay").style.display = "none";
  }

  function imagenError(image) {
    image.onerror = null; // Previene la posibilidad de un bucle infinito si la imagen de error también falla
    image.src = '/images/img/noimagen.jpg'; // Establece la imagen de error
  }

  $('#buscarproducto').keyup(function() {

    // clearTimeout(clockSearch);
    var query = $(this).val().trim();

    if (query !== '') {
      // clockSearch = setTimeout(() => {
      if (ajaxRequest) {
        ajaxRequest.abort();
      }

      ajaxRequest = $.ajax({
        url: '{{ route('buscar') }}',
        method: 'GET',
        data: {
          query: query
        },
        success: function(data) {
          var resultsHtml = '';
          var url = '{{ asset('') }}';
          if (data.length == 0) {
            resultsHtml =
              '<div class="w-full flex flex-row py-3 px-5 hover:bg-slate-200"><p class="text-center">No se encontraron resultados</p></div>';
          }
          data.forEach(function(result) {
            const price = Number(result.precio) || 0
            const discount = Number(result.descuento) || 0
            resultsHtml += `<a href="/producto/${result.id}">
              <div class="w-full flex flex-row py-3 px-5 hover:bg-slate-200">
                <div class="w-[10%]">
                  <img class="w-14 rounded-md" src="${url}${result.imagen}" onerror="imagenError(this)" />
                </div>
                <div class="flex flex-col justify-center w-[70%]">
                  <h2 class="text-left">${result.producto}</h2>
                  <p class="text-text12 text-left">Categoría</p>
                </div>
                <div class="flex flex-col justify-center w-[10%]">
                  <p class="text-right w-max">S/ ${discount > 0 ? discount.toFixed(2) : price.toFixed(2)}</p>
                  ${discount > 0 ? `<p class="text-text12 text-right line-through text-slate-500 w-max">S/ ${price.toFixed(2)}</p>` : ''}
                </div>
              </div>
            </a>`;
          });

          $('#resultados').html(resultsHtml);
        }
      });

      // }, 300);

    } else {
      $('#resultados').empty();
    }
  });
</script>
<script>
  $('#open-cart').on('click', () => {
    $('#cart-modal').modal({
      showClose: false,
      fadeDuration: 100
    })
  })
  $('#close-cart').on('click', () => {
    $('.jquery-modal.blocker.current').trigger('click')
  })
</script>
<script>
  function mostrarTotalItems() {
    let articulos = Local.get('carrito')
    let contarArticulos = articulos.reduce((total, articulo) => {
      return total + articulo.cantidad;
    }, 0);

    $('#itemsCount').text(contarArticulos)
  }
  $(document).ready(function() {
    if ({{ $isIndex ? 1 : 0 }}) {
      $(window).scroll(function() {
        var scroll = $(window).scrollTop();
        var categoriasOffset = $('#categorias').offset().top;

        const headerMenu = $('#header-menu')
        const logo = $('#logo-decotab')
        const items = $('#menu-items')
        const username = $('#username')
        const burguer = $('#menu-burguer')
        if (scroll >= categoriasOffset) {
          headerMenu
            .removeClass('absolute bg-transparent text-white')
            .addClass('fixed top-0 bg-white shadow-lg');
          items
            .removeClass('text-white')
            .addClass('text-[#272727]')
          username
            .removeClass('text-white')
            .addClass('text-[#272727]')
          // burguer
          //   .removeClass('absolute')
          //   .addClass('fixed')
          logo.attr('src', 'images/svg/logo_decotab_header.svg')
          $('#header-menu svg').attr('stroke', '#272727');
        } else {
          headerMenu
            .removeClass('fixed bg-white shadow-lg')
            .addClass('absolute bg-transparent text-white');
          items
            .removeClass('text-[#272727]')
            .addClass('text-white')
          username
            .removeClass('text-[#272727]')
            .addClass('text-white')
          // burguer
          //   .removeClass('fixed')
          //   .addClass('absolute')
          logo.attr('src', '')
          $('#header-menu svg').attr('stroke', 'white');
        }
      });
    }
    mostrarTotalItems()
  })
</script>
<script src="{{ asset('js/storage.extend.js') }}"></script>


<script>
  var articulosCarrito = []
  articulosCarrito = Local.get('carrito') || [];

  function addOnCarBtn(id, isCombo) {
    let prodRepetido = articulosCarrito.map(item => {
      if (item.id === id && item.isCombo == isCombo) {

        item.cantidad += 1;
      }
      return item;
    });

    Local.set('carrito', articulosCarrito);
    limpiarHTML();
    PintarCarrito();
  }

  function deleteOnCarBtn(id, isCombo) {
    let prodRepetido = articulosCarrito.map(item => {
      if (item.id === id && item.isCombo == isCombo && item.cantidad > 0) {

        item.cantidad -= 1;
      }
      return item;
    });

    Local.set('carrito', articulosCarrito);
    limpiarHTML();
    PintarCarrito();
  }

  function deleteItem(id, isCombo) {

    let idCount = {};
    let duplicates = [];
    articulosCarrito.forEach(item => {
      if (idCount[item.id]) {
        idCount[item.id]++;
      } else {
        idCount[item.id] = 1;
      }
    });

    for (let id in idCount) {
      if (idCount[id] > 1) {
        duplicates.push(id);
      }
    }

    if (duplicates.length > 0) {
      console.log('Duplicate IDs found:', duplicates);
      let index = articulosCarrito.findIndex(item => item.id === id && item.isCombo == isCombo);
      if (index > -1) {
        articulosCarrito.splice(index, 1);
      }
    } else {
      articulosCarrito = articulosCarrito.filter(objeto => objeto.id !== id);

    }

    // return

    Local.set('carrito', articulosCarrito)
    limpiarHTML()
    PintarCarrito()
  }

  function limpiarHTML() {
    //forma lenta 
    /* contenedorCarrito.innerHTML=''; */
    $('#itemsCarrito').html('')
    $('#itemsCarritoCheck').html('')


  }
  var appUrl = "{{ env('APP_URL') }}";

  $(document).ready(function() {


    PintarCarrito()





    $('#buscarblog').keyup(function() {

      var query = $(this).val().trim();

      if (query !== '') {
        $.ajax({
          url: '{{ route('buscarblog') }}',
          method: 'GET',
          data: {
            query: query
          },
          success: function(data) {
            var resultsHtml = '';
            var url = '{{ asset('') }}';
            data.forEach(function(result) {
              resultsHtml +=
                '<a class="z-50" href="/post/' + result.id +
                '"> <div class=" z-50 w-full flex flex-row py-2 px-3 hover:bg-slate-200"> ' +
                ' <div class="w-[30%]"><img class="w-full rounded-md" src="' +
                url + result.url_image + result.name_image + '" /></div>' +
                ' <div class="flex flex-col justify-center w-[80%] pl-3"> ' +
                ' <h2 class="text-left line-clamp-1">' + result.title +
                '</h2> ' +
                '</div> ' +
                '</div></a>';
            });

            $('#resultadosblog').html(resultsHtml);
          }
        });
      } else {
        $('#resultadosblog').empty();
      }
    });
  });
</script>

<script>
  document.addEventListener('click', function(event) {
    var input = document.getElementById('buscarblog');
    var resultados = document.getElementById('resultadosblog');

    // Check if both elements exist
    if (input && resultados) {
      var isClickInsideInput = input.contains(event.target);
      var isClickInsideResultados = resultados.contains(event.target);

      if (!isClickInsideInput && !isClickInsideResultados) {
        input.value = '';
        $('#resultadosblog').empty();
      }
    }
  });
</script>
<script>
  $(document).ready(function() {
    $(document).on('mouseenter', '.other-class', function() {
      console.log('detected hover');
      cerrar()
    });
  })

  const categorias = @json($categorias);
  var activeHover = false
  document.getElementById('productos-link').addEventListener('mouseenter', function(event) {
    if (event.target === this) {
      // mostrar submenú de productos 
      let padre = document.getElementById('productos-link-h');
      let divcontainer = document.createElement('div');
      divcontainer.id = 'productos-link-container';
      divcontainer.className =
        'absolute top-[90px] left-1/2 transform -translate-x-1/2 m-0 flex flex-row bg-white z-[60] rounded-lg shadow-lg gap-4 p-4 w-[80vw] overflow-x-auto';

      divcontainer.addEventListener('mouseenter', function() {
        this.addEventListener('mouseleave', cerrar);
      });

      categorias.forEach(element => {
        if (element.subcategories.length == 0) return;
        let ul = document.createElement('ul');
        ul.className =
          'text-[#006BF6] font-bold font-poppins text-md py-2 px-3    duration-300 w-full whitespace-nowrap gap-4';

        ul.innerHTML = element.name;
        element.subcategories.forEach(subcategoria => {
          let li = document.createElement('li');
          li.style.setProperty('padding-left', '4px', 'important');
          li.style.setProperty('padding-right', '2px', 'important');

          li.className =
            'text-[#272727] px-2 rounded-sm cursor-pointer font-normal font-poppins text-[13px] hover:bg-blue-200 hover:opacity-75 transition-opacity duration-300 w-full whitespace-nowrap';
          // Crear el elemento 'a'
          let a = document.createElement('a');
          a.href = `/catalogo?subcategoria=${subcategoria.id}`;
          a.innerHTML = subcategoria.name;
          a.className = 'block w-full h-full py-2 px-3'; // Para que el enlace ocupe todo el 'li'

          // Añadir el elemento 'a' al 'li'
          li.appendChild(a);
          ul.appendChild(li);
        });
        divcontainer.appendChild(ul);
      });



      // limpia sus hijos antes de agregar los nuevos
      if (!activeHover) {
        padre.appendChild(divcontainer);
        activeHover = true;
      }
    }
  });



  function cerrar() {
    console.log('cerrando')
    let padre = document.getElementById('productos-link-h');
    activeHover = false
    padre.innerHTML = '';
  }

  function agregarAlCarrito(item, cantidad) {
    $.ajax({

      url: `{{ route('carrito.buscarProducto') }}`,
      method: 'POST',
      data: {
        _token: $('input[name="_token"]').val(),
        id: item,
        cantidad

      },
      success: function(success) {
        let {
          producto,
          id,
          descuento,
          precio,
          imagen,
          color,
          precio_reseller
        } = success.data
        let is_reseller = success.is_reseller


        if (is_reseller) {
          descuento = precio_reseller
        }

        let cantidad = Number(success.cantidad)
        let detalleProducto = {
          id,
          producto,
          isCombo: false,
          descuento,
          precio,
          imagen,
          cantidad,
          color

        }
        let existeArticulo = articulosCarrito.some(item => item.id === detalleProducto.id && item.isCombo ==
          false, )
        if (existeArticulo) {
          //sumar al articulo actual 
          const prodRepetido = articulosCarrito.map(item => {
            if (item.id === detalleProducto.id && item.isCombo == false) {
              item.cantidad += Number(detalleProducto.cantidad);
              // retorna el objeto actualizado 
            }
            return item; // retorna los objetos que no son duplicados 


          });
        } else {
          articulosCarrito = [...articulosCarrito, detalleProducto]

        }

        Local.set('carrito', articulosCarrito)
        let itemsCarrito = $('#itemsCarrito')
        let ItemssubTotal = $('#ItemssubTotal')
        let itemsTotal = $('#itemsTotal')
        limpiarHTML()
        PintarCarrito()
        mostrarTotalItems()

        Notify.add({
          icon: '/images/svg/Boost.svg',
          title: 'Producto agregado',
          body: 'El producto se agregó correctamente al carrito',
          type: 'primary',
        })

        /* Swal.fire({

          icon: "success",
          title: `Producto agregado correctamente`,
          showConfirmButton: true


        }); */
      },
      error: function(error) {
        console.log(error)
      }

    })
  }
  $(document).on('click', '#btnAgregarCarritoPr', function() {

    console.log('agregando al carrito');

    let url = window.location.href;
    let partesURL = url.split('/');
    let productoEncontrado = partesURL.find(parte => parte === 'producto');

    let item
    let cantidad


    item = partesURL[partesURL.length - 1]
    cantidad = Number($('#cantidadSpan span').text())
    item = $(this).data('id')

    try {
      agregarAlCarrito(item, cantidad)

    } catch (error) {
      console.log(error)

    }
  })

  $(document).on('click', '#btnAgregarCarrito', function() {

    let item = $(this).data('id')

    let cantidad = 1
    try {
      agregarAlCarrito(item, cantidad)

    } catch (error) {
      console.log(error)

    }


  })
</script>
