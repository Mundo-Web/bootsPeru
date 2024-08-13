@php
  $sliderId = isset($i) ? $id : 'slider-' . uniqid();
@endphp
<style>
  .modal {
    padding: 4px 4px 4px 4px;
  }

  @media (max-width: 400px) {
    .modal.modalbanner {

      /* Ajusta el padding para dispositivos pequeños */

      max-width: 85vw;
      top: -5%;
      left: -60px
    }


    #{{ $sliderId }} .swiper-slide {
      font-size: 14px;
      /* Ajusta el tamaño de fuente para dispositivos pequeños */
    }

    #{{ $sliderId }} .swiper-wrapper {
      /* padding: 10px; */
      /* Ajusta el padding del contenedor del slider */
    }


  }

  @media (max-width: 700px) {
    .modal.modalbanner {

      /* Ajusta el padding para dispositivos pequeños */

      max-width: 80vw;
      top: -5%;
      left: -12%
    }


    #{{ $sliderId }} .swiper-slide {
      font-size: 14px;
      /* Ajusta el tamaño de fuente para dispositivos pequeños */
    }

    #{{ $sliderId }} .swiper-wrapper {
      /* padding: 10px; */
      /* Ajusta el padding del contenedor del slider */
    }


  }
</style>
{{-- <style>
  #{{ $sliderId }} a {
    position: absolute;
    bottom: 10px;
    /* Ajusta este valor para mover el botón hacia abajo o arriba dentro del contenedor */
    left: 0px;
    right: 0px;
    /* Ajusta este valor para alinear el botón a la izquierda o derecha */
    z-index: 10;
    /* Asegura que el botón esté por encima de la imagen */
  }
</style> --}}


<div id="{{ $sliderId }}" class="swiper header-slider">
  <div class="swiper-wrapper">
    @foreach ($items as $item)
      <div class="swiper-slide relative">

        <img src="{{ asset($item->image) }}" alt="" class="w-full max-h-[70vh] 
        ">
        <div class="absolute bottom-10 right-0 left-0  flex content-center justify-center items-center z-10">
          <a href="{{ $item->button_link }}"
            class="font-semibold text-[16px] bg-[#006BF6] py-2 px-4 text-center text-white rounded-3xl  absolute ">
            {{ $item->button_text }}
          </a>

        </div>


      </div>
    @endforeach
  </div>
  <div class="swiper-button-prev"></div>
  <div class="swiper-button-next"></div>
</div>

<script>
  new Swiper("#{{ $sliderId }}", {
    autoHeight: true,
    // autoWidth: true,
    slidesPerView: 1,
    spaceBetween: 10,
    loop: true,
    autoplay: true,
    grab: true,
    centeredSlides: false,
    initialSlide: 0, // Empieza en el cuarto slide (índice 3)
    pagination: {
      el: ".swiper-pagination-slider-header",
      clickable: true,
    },
    breakpoints: {
      0: {
        slidesPerView: 1,
      },
    },
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
  });
</script>
