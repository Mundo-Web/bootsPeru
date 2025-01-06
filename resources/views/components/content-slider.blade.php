<div class="w-full">
  <div class="h-[450px] flex flex-col relative z-20 pt-[35px] lg:pt-[70px] max-w-6xl mx-auto gap-6 lg:gap-8 px-[5%]">

    <h2 class="text-[#006BF6]  font-normal text-xl lg:text-3xl text-center font-Inter_Regular">{{ $item->botontext1 }}
    </h2>

    <h1 class="text-3xl lg:text-6xl font-semibold text-center font-Inter_Regular">{{ $item->title }}</h1>

    <div class="flex flex-col items-center justify-center w-full max-w-4xl mx-auto">
      <h3 class="text-lg text-center font-Inter_Regular font-normal leading-snug lg:leading-loose">
        {{ $item->description }}</h3>
    </div>

    <div class="flex flex-col items-center justify-center  mx-auto mt-3">
      <a href="{{ $item->link2 }}"
        class="bg-[#006BF6] text-base font-Inter_Regular font-normal text-white text-center px-5 py-3 rounded-3xl flex items-center justify-center"
        type="button">
        {{ $item->botontext2 }}
        <img src="{{ asset('images/img/Vector.png') }}" alt="Icono" class="ml-2">
      </a>
    </div>

  </div>

  <div class="h-72 lg:h-96 relative z-10 max-w-6xl mx-auto  flex flex-col items-end justify-end">
    <img class="block h-full  mx-auto object-contain object-bottom"
      src="{{ asset($item->url_image . $item->name_image) }}" alt="">
  </div>
</div>
