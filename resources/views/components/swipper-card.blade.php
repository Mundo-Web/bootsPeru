@php
  $sliderId = isset($i) ? $id : 'slider-' . uniqid();
@endphp

<div id="{{ $sliderId }}" class="swiper header-slider">
  <div class="swiper-wrapper !h-max">
    @foreach ($items as $item)
      <div class="swiper-slide">
        <x-content-slider :item="$item" />
      </div>
    @endforeach
  </div>
</div>

<script>
  new Swiper("#{{ $sliderId }}", {
    slidesPerView: 1,
    spaceBetween: 10,
    loop: true,
    autoplay: false,
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
  });
</script>
