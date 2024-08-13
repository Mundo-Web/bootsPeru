@extends('components.public.matrix', ['pagina' => 'index'])

@section('css_importados')

@stop

<style>
  #Aboutus .prose {
    width: 100%;
    max-width: 100%;
    text-align: justify;
    margin-top: 0 !important;
    margin-bottom: 0 !important;
  }

  .prose p {

    margin-top: 0 !important;
    margin-bottom: 0 !important;

  }
</style>

@section('content')

  <main class="z-[15] ">

    <section class="bg-[#f1f1f1] ">
      {{-- <x-swipper-card :items="$slider" /> --}}
    </section>



    {{-- seccion Ultimos Productos  --}}

    <section class="w-full px-[8%] py-10 lg:py-20 ">
      <div class="flex flex-col md:flex-col  w-full gap-3" data-aos="zoom-out-left">
        <h1 class="text-[22px] md:text-3xl font-semibold font-Inter_Medium  text-[#006BF6]">Sobre nosotros</h1>
        <h1 class="text-[48px] md:text-3xl font-semibold font-Inter_Medium  text-[#333333] mt-3">{{ $nosotros[2]->titulo }}
        </h1>


      </div>
      <div class="mt-6  text-justify grid grid-cols-1" id="Aboutus">
        <div class="col-span-1 text-[18px]">{!! $nosotros[2]->descripcion !!}</div>
        <div><img src="{{ asset($nosotros[2]->imagen) }}" alt=""></div>
      </div>

    </section>



    {{-- seccion Productos populares  --}}

    <section class=" bg-[#F8F8F8]">
      <div class="w-full px-[5%] py-14 lg:py-20" data-aos="fade-down-left">
        <div class="pl-10 flex flex-col md:flex-row justify-between w-full gap-3">
          {{-- <h1 class="text-2xl md:text-3xl font-semibold font-Inter_Medium text-[#323232]">Misión</h1> --}}
          {{-- <div class="flex  flex-col md:flex-row gap-2 md:gap-8">
              <a href="/catalogo" class="flex items-center   font-Inter_Medium  hover:text-[#006BF6] ">Todos</a>
              @foreach ($categoriasAll as $item)
                <a href="/catalogo/{{ $item->id }}"
                  class="flex items-center font-Inter_Medium  hover:text-[#006BF6]  transition ease-out duration-300 transform  ">{{ $item->name }}
                </a>
              @endforeach
            </div> --}}
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2  gap-16 mt-14 w-full px-10 ">
          <div><img src="{{ asset($nosotros[0]->imagen) }}" alt=""></div>
          <div class="flex flex-col content-center text-center justify-center gap-16">
            <div class="flex flex-col items-center justify-center">
              <div class="rounded-full w-10 h-10 bg-[#006BF5] flex items-center justify-center mb-4">
                <img src="images/idea.png" alt="">
              </div>
              <h1 class="text-2xl md:text-3xl font-semibold font-Inter_Medium text-[#323232]">Nuestra Misión</h1>
              <div class="text-justify">{!! $nosotros[0]->descripcion !!}</div>
            </div>


            <div class="flex flex-col items-center justify-center">
              <div class="rounded-full w-10 h-10 bg-[#006BF5] flex items-center justify-center"><img src="images/idea.png"
                  alt="">
              </div>
              <h1 class="text-2xl md:text-3xl font-semibold font-Inter_Medium text-[#323232]">Nuestra Visión</h1>
              <div class=" text-justify">{!! $nosotros[3]->descripcion !!}</div>
            </div>


          </div>

        </div>

      </div>
    </section>



    <section class="w-full px-[5%] py-7 lg:py-14" data-aos="fade-up" data-aos-offset="150">
      <div class="grid grid-cols-1 md:grid-cols-2 w-full">
        <div class=" flex flex-col md:flex-col  w-full gap-3 px-10">
          <h1 class="text-[22px] md:text-3xl font-semibold font-Inter_Medium  text-[#006BF6]">Nuestro sello de Garantia
          </h1>
          <h1 class="text-[48px] md:text-3xl font-semibold font-Inter_Medium  text-[#333333] mt-3">

            {{ $nosotros[1]->titulo }}
          </h1>
          <div class=" flex flex-col align-items-end  text-justify">{!! $nosotros[1]->descripcion !!}</div>

        </div>

        <div class="px-10"><img src="{{ asset($nosotros[1]->imagen) }}" alt="" class="object-cover"></div>


      </div>


    </section>


    @if ($benefit->count() > 0)
      <section class="py-10 lg:py-13 bg-[#F8F8F8] w-full px[5%]" data-aos="zoom-out-right">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 ">
          @foreach ($benefit as $item)
            <div class="flex flex-col items-center w-full gap-1 justify-center text-center px-[10%] xl:px-[18%]">
              <img src="{{ asset($item->icono) }}" alt="">
              <h4 class="text-xl font-bold font-Inter_Medium"> {{ $item->titulo }} </h4>
              <div class="text-lg leading-8 text-[#444444] font-Inter_Medium">{!! $item->descripcionshort !!}</div>
            </div>
          @endforeach
        </div>
      </section>
    @endif





  </main>
  {{-- modalOfertas --}}



  <!-- Modal toggle -->


  <!-- Main modal -->
  {{-- 
  <div id="modalofertas" class="modal">

    <!-- Modal body -->
    <div class="p-1 ">
      <x-swipper-card-ofertas :items="$popups" id="modalOfertas" />
    </div>


  </div> --}}


@section('scripts_importados')

  <script>
    function calcularTotal() {
      let articulos = Local.get('carrito')
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
    $(document).ready(function() {
      console.log(pops.length)
      if (pops.length > 0) {
        $('#modalofertas').modal({
          show: true,
          fadeDuration: 100
        })

      }


      $(document).ready(function() {
        articulosCarrito = Local.get('carrito') || [];

        // PintarCarrito();
      });

    })
  </script>


@stop

@stop
