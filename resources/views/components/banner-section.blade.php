<div class="flex flex-col items-center w-full gap-3  justify-center py-10">
  <span class="text-[#666666] text-sm lg:text-base font-normal font-Inter_Medium uppercase">
    @foreach ($banner as $item)
      {{ $item['title'] }}
    @endforeach
  </span>
  <h2 class="text-xl lg:text-2xl font-normal font-Inter_Medium text-[#323232] text-center px-2">
    @foreach ($banner as $item)
      {{ $item['description'] }}
    @endforeach
  </h2>
  <h3 class="text-xl lg:text-2xl font-normal font-Inter_Bold text-[#15294C]">
    @foreach ($banner as $item)
      {{ $item['price'] }}
    @endforeach
  </h3>
  @foreach ($banner as $item)
    <a href="{{ $item['url_btn'] }}"
      class="bg-[#006BF6] text-sm font-normal text-white text-center font-Inter_Medium p-3 rounded-3xl flex items-center justify-center w-32"
      type="button">
      {{ $item['title_btn'] }}
    </a>
  @endforeach
</div>
<div class="w-full flex items-end justify-center content-center relative px-[5%] ">
  @foreach ($banner as $item)
    <img src="{{ asset($item['image']) }}" alt=""
      class="object-contain lg:-mt-24 object-bottom md:h-[400px] lg:h-[450px]">
  @endforeach
</div>
