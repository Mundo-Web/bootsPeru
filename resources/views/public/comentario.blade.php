@extends('components.public.matrix', ['pagina' => 'comentario'])

@section('css_importados')

@stop


@section('content')

  <div class="w-full">
    <div style="background-image: url('{{ asset('images/img/header_comentar.png') }}')"
      class="bg-cover bg-center bg-no-repeat min-h-[600px]  flex flex-col justify-center items-center">
    </div>
  </div>

  <main class="my-16">



    <section class="font-poppins flex flex-col gap-5">
      <div class="w-11/12 mx-auto flex flex-col gap-3">
        <h2 class="font-medium text-[28px]">Comentarios de los usuarios</h2>
        {{-- <div class="flex items-center gap-2">
                    <div class="flex gap-2 py-2">
                        <img src="./images/svg/start.svg" alt="estrella" />
                        <img src="./images/svg/start.svg" alt="estrella" />
                        <img src="./images/svg/start.svg" alt="estrella" />
                        <img src="./images/svg/start_sin_color.svg" alt="estrella" />
                        <img src="./images/svg/start_sin_color.svg" alt="estrella" />
                    </div>
                    <p class="font-normal text-[12px] text-[#141718]">@if ($contarcomentarios = 1)
                      {{$contarcomentarios}}  Comentario
                    @else
                      {{$contarcomentarios}}  Comentarios
                    @endif</p>
                </div> --}}
      </div>

      <div class="w-11/12 mx-auto">
        <form action="{{ route('nuevocomentario') }}" method="POST">
          @csrf
          <div
            class="flex flex-col gap-5 md:flex-row md:justify-between md:items-center md:border-2 md:border-[#E8ECEF] md:p-2 md:rounded-2xl">
            <textarea placeholder="Comparte tus pensamientos" name="testimonie"
              class="w-full border-[1px] md:border-none focus:outline-none focus:ring-0 border-gray-400 rounded-2xl py-4 px-2">{{ old('testimonie') }}</textarea>

            <input type="submit" value="Comentar"
              class="font-semibold text-base bg-[#006BF6] py-3 px-5 rounded-2xl text-white cursor-pointer" />
          </div>
        </form>

        @error('testimonie')
          <span class="text-red-500 text-base p-3">{{ $message }}</span>
        @enderror

        @if (session('mensaje'))
          <div
            class="w-auto h-10 @if (session('alerta') == 2) { bg-red-400 }@else{ bg-green-600 } @endif my-5 rounded-xl text-white flex flex-row items-center pl-5">
            {{ session('mensaje') }}
          </div>
        @endif
      </div>

      <div class="w-11/12 mx-auto">
        <div class="flex flex-col gap-10">
          <div class="flex flex-col md:flex-row items-start md:justify-between md:items-center gap-5">
            <p class="font-medium text-[28px]">
              @if ($contarcomentarios == 1)
                {{ $contarcomentarios }} Comentario
              @else
                {{ $contarcomentarios }} Comentarios
              @endif
            </p>
            <div class="w-full md:w-auto">
              <div>
                <!-- cmombo -->
                <div class="dropdown w-full">
                  <div class="input-box focus:outline-none font-medium text-[16px] mr-20 shadow-md px-2">
                    Selecciona el orden
                  </div>
                  <div class="list">
                    <div class="w-full">
                      <input type="radio" name="drop1" id="id11" class="radio" />

                      <label for="id11"
                        class="font-normal text-text18 hover:font-bold md:duration-100 hover:text-white comentar">
                        <span class="name inline-block w-full">Lo más reciente</span>
                      </label>
                    </div>

                    <div class="w-full">
                      <input type="radio" name="drop1" id="id12" class="radio" />
                      <label for="id12"
                        class="font-normal text-text18 hover:font-bold md:duration-100 hover:text-white comentar">
                        <span class="name inline-block w-full">Lo más antiguo</span>
                      </label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="flex flex-col gap-10">
            @foreach ($comentarios as $item)
              <div class="flex flex-col md:flex-row gap-5 border-b-[1px] border-[#DDDDDD] pb-5">
                <div class="">
                  <img src="./images/img/perfil_user_2.png" alt="perfil" class="md:w-32 lg:w-20" />
                </div>
                <div class="flex flex-col gap-5">
                  <h2 class="font-semibold text-[20px] text-[#141718]">
                    {{ $item->name }}
                  </h2>
                  <div class="flex flex-col gap-1">
                    {{-- <div class="flex gap-2 py-2">
                                        <img src="./images/svg/start.svg" alt="estrella" />
                                        <img src="./images/svg/start.svg" alt="estrella" />
                                        <img src="./images/svg/start.svg" alt="estrella" />
                                        <img src="./images/svg/start_sin_color.svg" alt="estrella" />
                                        <img src="./images/svg/start_sin_color.svg" alt="estrella" />
                                    </div> --}}
                    <p class="font-normal text-[16px] text-[#353945]">
                      {{ $item->testimonie }}
                    </p>
                  </div>
                  <div class="flex flex-col md:flex-row gap-5 md:items-center">
                    <span class="font-normal text-[12px] text-slate-400 inline-block">{{ $item->created_at }}
                    </span>
                    {{-- <div class="flex gap-5">
                                        <a href="#" class="font-semibold text-[12px] text-[#23262F]">Me gusta</a>
                                        <a href="#" class="font-semibold text-[12px] text-[#23262F]">Responder</a>
                                    </div> --}}
                  </div>
                </div>
              </div>
            @endforeach
          </div>

          <div class="flex justify-center items-center">
            {{-- <a href="#"
                            class="font-semibold text-[16px] bg-white md:duration-500 py-4 px-5 rounded-3xl border-[1px] border-colorBorder flex-initial text-center w-full md:w-56">
                            Cargar más
                        </a> --}}
            {{ $comentarios->links() }}
          </div>
        </div>
      </div>
    </section>
  </main>

@section('scripts_importados')
  <script>
    $(document).ready(function() {


      function capitalizeFirstLetter(string) {
        string = string.toLowerCase()
        return string.charAt(0).toUpperCase() + string.slice(1);
      }
    })
    $('#disminuir').on('click', function() {
      console.log('disminuyendo')
      let cantidad = Number($('#cantidadSpan span').text())
      if (cantidad > 0) {
        cantidad--
        $('#cantidadSpan span').text(cantidad)
      }


    })
    // cantidadSpan
    $('#aumentar').on('click', function() {
      console.log('aumentando')
      let cantidad = Number($('#cantidadSpan span').text())
      cantidad++
      $('#cantidadSpan span').text(cantidad)

    })
  </script>
  <script>
    let articulosCarrito = [];


    function deleteOnCarBtn(id, operacion) {
      console.log('Elimino un elemento del carrito');
      console.log(id, operacion)
      const prodRepetido = articulosCarrito.map(item => {
        if (item.id === id && item.cantidad > 0) {
          item.cantidad -= Number(1);
          return item; // retorna el objeto actualizado 
        } else {
          return item; // retorna los objetos que no son duplicados 
        }

      });
      Local.set('carrito', articulosCarrito)
      limpiarHTML()
      PintarCarrito()


    }

    function calcularTotal() {
      let articulos = Local.get('carrito') ?? []
      let total = articulos.map(item => {
        let monto
        if (Number(item.descuento) !== 0) {
          monto = item.cantidad * Number(item.descuento)
        } else {
          monto = item.cantidad * Number(item.precio)

        }
        return monto

      })
      const suma = total.reduce((total, elemento) => total + elemento, 0);

      $('#itemsTotal').text(`S/. ${suma} `)

    }

    function addOnCarBtn(id, operacion) {
      console.log('agrego un elemento del cvarrio');
      console.log(id, operacion)

      const prodRepetido = articulosCarrito.map(item => {
        if (item.id === id) {
          item.cantidad += Number(1);
          return item; // retorna el objeto actualizado 
        } else {
          return item; // retorna los objetos que no son duplicados 
        }

      });
      console.log(articulosCarrito)
      Local.set('carrito', articulosCarrito)
      // localStorage.setItem('carrito', JSON.stringify(articulosCarrito));
      limpiarHTML()
      PintarCarrito()


    }

    function deleteItem(id) {
      console.log('borrando elemento')
      articulosCarrito = articulosCarrito.filter(objeto => objeto.id !== id);

      Local.set('carrito', articulosCarrito)
      limpiarHTML()
      PintarCarrito()
    }

    var appUrl = <?php echo json_encode($url_env); ?>;
    console.log(appUrl);
    $(document).ready(function() {
      articulosCarrito = Local.get('carrito') || [];

      PintarCarrito();
    });

    function limpiarHTML() {
      //forma lenta 
      /* contenedorCarrito.innerHTML=''; */
      $('#itemsCarrito').html('')


    }



    // function PintarCarrito() {
    //   console.log('pintando carrito ')

    //   let itemsCarrito = $('#itemsCarrito')

    //   articulosCarrito.forEach(element => {
    //     let plantilla = `<div class="flex justify-between bg-white font-poppins border-b-[1px] border-[#E8ECEF] pb-5">
  //         <div class="flex justify-center items-center gap-5">
  //           <div class="bg-[#F3F5F7] rounded-md p-4">
  //             <img src="${appUrl}/${element.imagen}" alt="producto" class="w-24" />
  //           </div>
  //           <div class="flex flex-col gap-3 py-2">
  //             <h3 class="font-semibold text-[14px] text-[#151515]">
  //               ${element.producto}
  //             </h3>
  //             <p class="font-normal text-[12px] text-[#6C7275]">

  //             </p>
  //             <div class="flex w-20 justify-center text-[#151515] border-[1px] border-[#6C7275] rounded-md">
  //               <button type="button" onClick="(deleteOnCarBtn(${element.id}, '-'))" class="  w-8 h-8 flex justify-center items-center ">
  //                 <span  class="text-[20px]">-</span>
  //               </button>
  //               <div class="w-8 h-8 flex justify-center items-center">
  //                 <span  class="font-semibold text-[12px]">${element.cantidad }</span>
  //               </div>
  //               <button type="button" onClick="(addOnCarBtn(${element.id}, '+'))" class="  w-8 h-8 flex justify-center items-center ">
  //                 <span class="text-[20px]">+</span>
  //               </button>
  //             </div>
  //           </div>
  //         </div>
  //         <div class="flex flex-col justify-start py-2 gap-5 items-center pr-2">
  //           <p class="font-semibold text-[14px] text-[#151515]">
  //             S/ ${Number(element.descuento) !== 0 ? element.descuento : element.precio}
  //           </p>
  //           <div class="flex items-center">
  //             <button type="button" onClick="(deleteItem(${element.id}))" class="  w-8 h-8 flex justify-center items-center ">
  //             <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
  //               <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
  //             </svg>
  //             </button>

  //           </div>
  //         </div>
  //       </div>`

    //     itemsCarrito.append(plantilla)

    //   });

    //   calcularTotal()
    // }






    $('#btnAgregarCarrito').on('click', function() {
      let url = window.location.href;
      let partesURl = url.split('/')
      let item = partesURl[partesURl.length - 1]
      let cantidad = Number($('#cantidadSpan span').text())
      item = item.replace('#', '')



      // id='nodescuento'


      $.ajax({

        url: `{{ route('carrito.buscarProducto') }}`,
        method: 'POST',
        data: {
          _token: $('input[name="_token"]').val(),
          id: item,
          cantidad

        },
        success: function(success) {
          console.log(success)
          let {
            producto,
            id,
            descuento,
            precio,
            imagen,
            color
          } = success.data
          let cantidad = Number(success.cantidad)
          let detalleProducto = {
            id,
            producto,
            descuento,
            precio,
            imagen,
            cantidad,
            color

          }
          let existeArticulo = articulosCarrito.some(item => item.id === detalleProducto.id)
          if (existeArticulo) {
            //sumar al articulo actual 
            const prodRepetido = articulosCarrito.map(item => {
              if (item.id === detalleProducto.id) {
                item.cantidad += Number(detalleProducto.cantidad);
                return item; // retorna el objeto actualizado 
              } else {
                return item; // retorna los objetos que no son duplicados 
              }

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

        },
        error: function(error) {
          console.log(error)
        }

      })



      // articulosCarrito = {...articulosCarrito , detalleProducto }
    })
    // $('#openCarrito').on('click', function() {
    //   console.log('abriendo carrito ');
    //   $('.main').addClass('blur')
    // })
    // $('#closeCarrito').on('click', function() {
    //   console.log('cerrando  carrito ');

    //   $('.cartContainer').addClass('hidden')
    //   $('#check').prop('checked', false);
    //   $('.main').removeClass('blur')


    // })
  </script>

  <script src="{{ asset('js/storage.extend.js') }}"></script>
@stop

@stop
