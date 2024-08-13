@extends('components.public.matrix', ['pagina' => 'contacto'])

@section('css_importados')

@stop




@section('content')

  @php
    $breadcrumbs = [['title' => 'Inicio', 'url' => route('index')], ['title' => 'Contacto', 'url' => '/contacto']];
  @endphp
  @component('components.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
  @endcomponent


  <main>

    <section class="font-Inter_Regular my-12">
      <div class="flex flex-col gap-4   w-11/12 m-auto px-8 sm:px-16 pt-10 ">
        <h3 class="text-[39px] font-Inter_Medium text-[#333333]">¡Siempre estamos ansiosos por saber de usted! </h3>
        <span class="text-[20px]">Puede llamarnos en horario laboral o visitar nuestra oficina. Todos los correos
          electrónicos recibirán
          respuesta en un plazo de 24 horas. ¡Nos encantaría saber de usted!</span>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 w-11/12 m-auto px-8 sm:px-16 pt-10 gap-8">
        <div class="w-full relative">
          <img class="absolute" src="{{ asset('images\location_on.png') }}" alt="">

          <div class="pl-14 gap-3 flex flex-col">
            <p class="text-[25px] font-Inter_SemiBold">Direccion</p>
            <p class="text-[20px]">{{ $general->address }}</p>


          </div>
          <p class="text-[20px] pl-14"> {{ $general->city }} - {{ $general->country }}</p>

        </div>
        <div class="w-full relative">
          <img class="absolute" src="{{ asset('images\call.png') }}" alt="">
          <div class="pl-14 gap-3 flex flex-col">
            <p class="text-[25px] font-Inter_SemiBold">Contacto</p>
            <p class="text-[20px]">
              @isset($general->whatsapp)
                WhatsApp: {{ $general->whatsapp }}
              @endisset
            </p>
            <p class="text-[20px]">
              @isset($general->office_phone)
                Oficina: {{ $general->office_phone }}
              @endisset
            </p>
            <p class="text-[20px]">
              @isset($general->cellphone)
                Celular: {{ $general->cellphone }}
              @endisset
            </p>
          </div>
          <p class="text-[20px] pl-14">Correo: {{ $general->email }}</p>

        </div>

        <div class="w-full relative">
          <img class="absolute" src="{{ asset('images\avg_pace.png') }}" alt="">
          <div class="pl-14 gap-3 flex flex-col">
            <p class="text-[25px] font-Inter_SemiBold">Horario de Funcionamiento</p>
            <p class="text-[20px]">{{ $general->schedule }}</p>
            {{-- <p class="text-[20px]">Lunes – Viernes: 09:00 – 20:00</p> --}}
          </div>

        </div>


      </div>

      <div class="grid grid-cols-1 w-11/12 m-auto px-16 mt-10">
        <img class="w-full" src="{{ asset('images\Figmap.png') }}" alt="">
      </div>


    </section>
    <form class="font-Inter_Regular mb-40" id="formContactos">
      <div class=" grid grid-cols-1 w-11/12 m-auto px-16 pt-11">
        <h2 class="font-Inter_Medium text-[30px] text-center">Pregúntanos cualquier cosa aquí </h2>
        <div class="grid grid-cols-2 gap-4 mt-12 w-full">
          <div class="col-span-2 sm:col-span-1 w-full">
            <input type="text" placeholder="Nombre Completo " name="name"
              class="w-full h-14 bg-[#F8F8F8] rounded-xl border-none">
          </div>
          <div class="col-span-2 sm:col-span-1 w-full">
            <input type="text" placeholder="Correo Electronico" name="email"
              class="w-full h-14 bg-[#F8F8F8] rounded-xl border-none">
          </div>
          <div class="col-span-3 md:col-span-2 w-full mt-8">
            <input type="text" placeholder="Asunto " name="asunto"
              class="w-full h-14 bg-[#F8F8F8] rounded-xl border-none">
          </div>
          <div class="col-span-2 w-full mt-8">
            <textarea type="text" placeholder="Mensaje " name="message" class="w-full h-14 bg-[#F8F8F8] rounded-xl border-none"></textarea>
          </div>
        </div>


      </div>
      <div class="flex justify-start mt-7 w-11/12 m-auto px-16 pt-16">
        <button class="bg-[#006BF6] text-white font-Inter_Medium text-[20px] px-10 py-3 rounded-full w-[280px]">Enviar
          Mensaje</button>
      </div>

    </form>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 w-11/12 m-auto px-8 sm:px-16  gap-8">
      <p>Deseas ser Revendedor de nuestros productos ? <a href="{{ route('Register.jsx') }}" class="text-[#006BF6]">Sigue
          el
          siguiente
          enlace </a></p>

    </div>

  </main>


@section('scripts_importados')
  <script>
    function alerta(message) {
      Swal.fire({
        title: message,
        icon: "error",
      });
    }

    function validarEmail(value) {
      console.log(value)
      const regex =
        /^(([^<>()\[\]\\.,;:\s@”]+(\.[^<>()\[\]\\.,;:\s@”]+)*)|(“.+”))@((\[[0–9]{1,3}\.[0–9]{1,3}\.[0–9]{1,3}\.[0–9]{1,3}])|(([a-zA-Z\-0–9]+\.)+[a-zA-Z]{2,}))$/

      if (!regex.test(value)) {
        alerta("El campo email no es válido");
        return false;
      }
      return true;
    }

    $('#formContactos').submit(function(event) {
      // Evita que se envíe el formulario automáticamente
      //console.log('evcnto')

      event.preventDefault();
      let formDataArray = $(this).serializeArray();

      if (!validarEmail($('#email').val())) {
        return;
      };

      /* console.log(formDataArray); */
      $.ajax({
        url: '{{ route('guardarContactos') }}',
        method: 'POST',
        data: $(this).serialize(),
        success: function(response) {
          $('#formContactos')[0].reset();
          Swal.fire({
            title: response.message,
            icon: "success",
          });

          if (!window.location.href.includes('#formularioenviado')) {
            window.location.href = window.location.href.split('#')[0] + '#formularioenviado';
          }

        },
        error: function(error) {
          const obj = error.responseJSON.message;
          const keys = Object.keys(error.responseJSON.message);
          let flag = false;
          keys.forEach(key => {
            if (!flag) {
              const e = obj[key][0];
              Swal.fire({
                title: error.message,
                text: e,
                icon: "error",
              });
              flag = true; // Marcar como mostrado
            }
          });
        }
      });
    })
  </script>

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
      let articulos = Local.get('carrito')
      console.log(articulos)
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
    //     let plantilla = `<div class="flex justify-between bg-white font-Inter_Regular border-b-[1px] border-[#E8ECEF] pb-5">
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
