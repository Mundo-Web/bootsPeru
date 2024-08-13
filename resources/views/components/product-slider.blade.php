{{-- <div class="col-span-3">
  <div class="swiper h-full img-complementarias"> 
    <div class="swiper-wrapper"> 
      <div class="swiper-slide w-full h-full col-span-1"> 
        <div class="flex gap-2 items-center justify-start h-full">
          <div class="flex justify-center items-center h-full">
            <img class="size-full object-cover h-full w-full shadow-xl" id="img-complementariaPROD-0"
              src="{{ $product->imagen ? asset($product->imagen) : asset('images/img/noimagen.jpg') }}" />
          </div>
        </div>
      </div>
      @foreach ($product->galeria as $index => $image)
        <div class="swiper-slide w-full h-full col-span-1"> 
          <div class="flex gap-2 items-center justify-start h-full">
            <div class="flex justify-center items-center h-full">
              <img class="size-full object-cover h-full w-full shadow-xl"
                id="img-complementariaPROD-{{ $index }}"
                src="{{ $image->imagen ? asset($image->imagen) : asset('images/img/noimagen.jpg') }}" />
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</div> --}}

<div class="grid grid-cols-3 w-full">
  <div class="col-span-3 h-full">
    <div class="swiper img-complementarias">
      <div class="swiper-wrapper">
        <div class="swiper-slide w-full h-full col-span-1 rounded-lg overflow-hidden border-2 border-azulboost"
          id="img-complementariaPROD-0">
          <div class="flex gap-2 items-center justify-center h-full">
            <div class="flex justify-center items-center h-full">
              <img class="object-center object-contain rounded-lg h-40 w-full shadow-xl"
                src="{{ $product->imagen ? asset($product->imagen) : asset('images/img/noimagen.jpg') }}"
                onerror="this.onerror=null;this.src='/images/img/noimagen.jpg';" />
            </div>
          </div>
        </div>

        @foreach ($product->galeria as $index => $image)
          <div class="swiper-slide w-full h-full col-span-1 rounded-lg overflow-hidden border-2 border-[#E5E7EB]"
            id="img-complementariaPROD-{{ $index }}">
            <div class="flex gap-2 items-center justify-center h-full">
              <div class="flex justify-center items-center h-full">
                <img class="object-center object-contain rounded-lg h-40 w-full shadow-xl"
                  src="{{ $image->imagen ? asset($image->imagen) : asset('images/img/noimagen.jpg') }}"
                  onerror="this.onerror=null;this.src='/images/img/noimagen.jpg';" />
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</div>

<script>
  var headerServices = new Swiper(".img-complementarias", {
    slidesPerView: 3,
    spaceBetween: 10,
    loop: false,
    // {{ count($product->galeria) > 1 ? 'true' : 'false' }},
    centeredSlides: false,
    initialSlide: 0, // Empieza en el cuarto slide (índice 3) */
    /* pagination: {
      el: ".swiper-pagination-estadisticas",
      clickable: true,
    }, */
    //allowSlideNext: false,  //Bloquea el deslizamiento hacia el siguiente slide
    //allowSlidePrev: false,  //Bloquea el deslizamiento hacia el slide anterior
    allowTouchMove: {{ count($product->galeria) > 1 ? 'true' : 'false' }}, // Bloquea el movimiento táctil
    // autoplay: {
    //   delay: 5500,
    //   disableOnInteraction: true,
    //   pauseOnMouseEnter: true
    // },

    breakpoints: {
      0: {
        slidesPerView: 2,
        // centeredSlides: {{ count($product->galeria) <= 2 ? 'true' : 'false' }},
        centeredSlides: false,
        loop: {{ count($product->galeria) > 1 ? 'true' : 'false' }},
      },
      1024: {
        slidesPerView: 3,
      },
    },
  });
</script>

<script>
  //crear un script que detecte el onclick de un img-complementariaPROD  y lo ponga en #containerProductosdetail
  var imgComplementaria = document.getElementById('img-complementariaPROD');

  $(document).on("click", "[id^='img-complementariaPROD-']", function() {
    let img = document.createElement('img');

    $("[id^='img-complementariaPROD-']").removeClass('border-azulboost').addClass('border-[#E5E7EB]');

    $(this).removeClass('border-[#E5E7EB]').addClass('border-azulboost');

    img.src = $(this).find('img').attr('src');
    img.classList.add('w-full', 'h-[330px]', '2xs:h-[400px]', 'sm:h-[450px]', 'xl:h-[550px]', 'object-contain',
      'ease-in', 'duration-500',
      'transform', 'hover:scale-105', 'opacity-0', 'transition-opacity', 'duration-200');
    $("#containerProductosdetail").html(img);
    setTimeout(function() {
      img.classList.remove('opacity-0');
    }, 100);

    setTimeout(function() {
      container.children('img').not(img).remove();
    }, 200);
  });
</script>
{{-- <script>
  $(document).on("click", "[id^='img-complementariaPROD-']", function() {
    let img = document.createElement('img');
    $("[id^='img-complementariaPROD-']").removeClass('border-4 border-azulboost');
    $(this).addClass('border-4 border-azulboost');
    img.src = $(this).find('img').attr('src');
    img.classList.add('w-full', 'h-[330px]', '2xs:h-[400px]', 'sm:h-[450px]', 'xl:h-[550px]', 'object-contain', 'ease-in', 'duration-300',
      'transform', 'hover:scale-105', 'opacity-0', 'transition-opacity', 'duration-500');
    
    let container = $("#containerProductosdetail");
    container.append(img);
    
    // setTimeout(function() {
    //   img.classList.remove('opacity-0');
    // }, 1000);
    
    // setTimeout(function() {
    //   container.children('img').not(img).remove();
    // }, 1000);
  });
</script> --}}
