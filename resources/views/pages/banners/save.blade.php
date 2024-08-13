<x-app-layout>
  @php
    $title = 'Banner';
  @endphp

  <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
    <form action="{{ route('banners.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <input type="hidden" name="id" value="{{ $banners->id }}">
      <div
        class="col-span-full xl:col-span-8 bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
        <header class="px-5 py-4 border-b border-slate-100 dark:border-slate-700">
          <h2 class="font-semibold text-slate-800 dark:text-slate-100 text-2xl tracking-tight">

            @if ($banners->id)
              Editar - {{ $banners->title }}
            @else
              Agregar nuevo {{ $title }}
            @endif
          </h2>

        </header>

        <div class="p-3">
          <div class="rounded shadow-lg p-4 px-4 ">
            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
              <div class="md:col-span-5">
                <label for="title">Titulo de {{ $title }}</label>
                <div class="relative mb-2  mt-2">
                  <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg"
                      version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0"
                      y="0" viewBox="0 0 469.336 469.336" style="enable-background:new 0 0 512 512" xml:space="preserve"
                      class="">
                      <g>
                        <path
                          d="m456.836 76.168-64-64.054c-16.125-16.139-44.177-16.17-60.365.031L45.763 301.682a10.733 10.733 0 0 0-2.688 4.587L.409 455.73a10.682 10.682 0 0 0 10.261 13.606c.979 0 1.969-.136 2.927-.407l149.333-42.703a10.714 10.714 0 0 0 4.583-2.69l289.323-286.983c8.063-8.069 12.5-18.787 12.5-30.192s-4.437-22.124-12.5-30.193zM285.989 89.737l39.264 39.264-204.996 204.997-14.712-29.434a10.671 10.671 0 0 0-9.542-5.896H78.921L285.989 89.737zm-259.788 353.4L40.095 394.5l34.742 34.742-48.636 13.895zm123.135-35.177-51.035 14.579-51.503-51.503 14.579-51.035h28.031l18.385 36.771a10.671 10.671 0 0 0 4.771 4.771l36.771 18.385v28.032zm21.334-17.543v-17.082c0-4.042-2.281-7.729-5.896-9.542l-29.434-14.712 204.996-204.996 39.264 39.264-208.93 207.068zM441.784 121.72l-47.033 46.613-93.747-93.747 46.582-47.001c8.063-8.063 22.104-8.063 30.167 0l64 64c4.031 4.031 6.25 9.385 6.25 15.083s-2.219 11.052-6.219 15.052z"
                          fill="#9F9F9F" opacity="1" data-original="#000000" class=""></path>
                      </g>
                    </svg>
                  </div>
                  <input type="text" id="title" name="title" value="{{ $banners->title }}" required
                    class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Título">
                </div>
              </div>

              <div class="md:col-span-5">
                <label for="description">Descripcion de {{ $title }}</label>
                <div class="relative mb-2 mt-2">
                  <div class="absolute inset-y-0 left-0 flex items-start top-3 pl-3 pointer-events-none ">
                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg"
                      version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0"
                      y="0" viewBox="0 0 469.336 469.336" style="enable-background:new 0 0 512 512" xml:space="preserve"
                      class="">
                      <g>
                        <path
                          d="m456.836 76.168-64-64.054c-16.125-16.139-44.177-16.17-60.365.031L45.763 301.682a10.733 10.733 0 0 0-2.688 4.587L.409 455.73a10.682 10.682 0 0 0 10.261 13.606c.979 0 1.969-.136 2.927-.407l149.333-42.703a10.714 10.714 0 0 0 4.583-2.69l289.323-286.983c8.063-8.069 12.5-18.787 12.5-30.192s-4.437-22.124-12.5-30.193zM285.989 89.737l39.264 39.264-204.996 204.997-14.712-29.434a10.671 10.671 0 0 0-9.542-5.896H78.921L285.989 89.737zm-259.788 353.4L40.095 394.5l34.742 34.742-48.636 13.895zm123.135-35.177-51.035 14.579-51.503-51.503 14.579-51.035h28.031l18.385 36.771a10.671 10.671 0 0 0 4.771 4.771l36.771 18.385v28.032zm21.334-17.543v-17.082c0-4.042-2.281-7.729-5.896-9.542l-29.434-14.712 204.996-204.996 39.264 39.264-208.93 207.068zM441.784 121.72l-47.033 46.613-93.747-93.747 46.582-47.001c8.063-8.063 22.104-8.063 30.167 0l64 64c4.031 4.031 6.25 9.385 6.25 15.083s-2.219 11.052-6.219 15.052z"
                          fill="#9F9F9F" opacity="1" data-original="#000000" class=""></path>
                      </g>
                    </svg>
                  </div>
                  <textarea type="text" rows="2" id="description" name="description" value=""
                    class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Descripción">{{ $banners->description }}</textarea>
                </div>
              </div>

              <div class="md:col-span-3">
                <label for="title_btn"></label>
                <div class="relative mb-2  mt-2">
                  <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg"
                      version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0"
                      y="0" viewBox="0 0 469.336 469.336" style="enable-background:new 0 0 512 512" xml:space="preserve"
                      class="">
                      <g>
                        <path
                          d="m456.836 76.168-64-64.054c-16.125-16.139-44.177-16.17-60.365.031L45.763 301.682a10.733 10.733 0 0 0-2.688 4.587L.409 455.73a10.682 10.682 0 0 0 10.261 13.606c.979 0 1.969-.136 2.927-.407l149.333-42.703a10.714 10.714 0 0 0 4.583-2.69l289.323-286.983c8.063-8.069 12.5-18.787 12.5-30.192s-4.437-22.124-12.5-30.193zM285.989 89.737l39.264 39.264-204.996 204.997-14.712-29.434a10.671 10.671 0 0 0-9.542-5.896H78.921L285.989 89.737zm-259.788 353.4L40.095 394.5l34.742 34.742-48.636 13.895zm123.135-35.177-51.035 14.579-51.503-51.503 14.579-51.035h28.031l18.385 36.771a10.671 10.671 0 0 0 4.771 4.771l36.771 18.385v28.032zm21.334-17.543v-17.082c0-4.042-2.281-7.729-5.896-9.542l-29.434-14.712 204.996-204.996 39.264 39.264-208.93 207.068zM441.784 121.72l-47.033 46.613-93.747-93.747 46.582-47.001c8.063-8.063 22.104-8.063 30.167 0l64 64c4.031 4.031 6.25 9.385 6.25 15.083s-2.219 11.052-6.219 15.052z"
                          fill="#9F9F9F" opacity="1" data-original="#000000" class=""></path>
                      </g>
                    </svg>
                  </div>
                  <input type="text" id="title_btn" name="title_btn" value="{{ $banners->title_btn }}"
                    class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Titulo para botón 1">
                </div>
              </div>








              <div class="md:col-span-2">
                <label for="url_btn"></label>
                <div class="relative mb-2  mt-2">
                  <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg"
                      version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0"
                      y="0" viewBox="0 0 469.336 469.336" style="enable-background:new 0 0 512 512" xml:space="preserve"
                      class="">
                      <g>
                        <path
                          d="m456.836 76.168-64-64.054c-16.125-16.139-44.177-16.17-60.365.031L45.763 301.682a10.733 10.733 0 0 0-2.688 4.587L.409 455.73a10.682 10.682 0 0 0 10.261 13.606c.979 0 1.969-.136 2.927-.407l149.333-42.703a10.714 10.714 0 0 0 4.583-2.69l289.323-286.983c8.063-8.069 12.5-18.787 12.5-30.192s-4.437-22.124-12.5-30.193zM285.989 89.737l39.264 39.264-204.996 204.997-14.712-29.434a10.671 10.671 0 0 0-9.542-5.896H78.921L285.989 89.737zm-259.788 353.4L40.095 394.5l34.742 34.742-48.636 13.895zm123.135-35.177-51.035 14.579-51.503-51.503 14.579-51.035h28.031l18.385 36.771a10.671 10.671 0 0 0 4.771 4.771l36.771 18.385v28.032zm21.334-17.543v-17.082c0-4.042-2.281-7.729-5.896-9.542l-29.434-14.712 204.996-204.996 39.264 39.264-208.93 207.068zM441.784 121.72l-47.033 46.613-93.747-93.747 46.582-47.001c8.063-8.063 22.104-8.063 30.167 0l64 64c4.031 4.031 6.25 9.385 6.25 15.083s-2.219 11.052-6.219 15.052z"
                          fill="#9F9F9F" opacity="1" data-original="#000000" class=""></path>
                      </g>
                    </svg>
                  </div>
                  <input type="text" id="url_btn" name="url_btn" value="{{ $banners->url_btn }}"
                    class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Url para botón ">
                </div>
              </div>
              <div class="md:col-span-1">
                <label for="price">Precio </label>
                <div class="relative mb-2  mt-2">
                  <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg"
                      version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0"
                      y="0" viewBox="0 0 469.336 469.336" style="enable-background:new 0 0 512 512"
                      xml:space="preserve" class="">
                      <g>
                        <path
                          d="m456.836 76.168-64-64.054c-16.125-16.139-44.177-16.17-60.365.031L45.763 301.682a10.733 10.733 0 0 0-2.688 4.587L.409 455.73a10.682 10.682 0 0 0 10.261 13.606c.979 0 1.969-.136 2.927-.407l149.333-42.703a10.714 10.714 0 0 0 4.583-2.69l289.323-286.983c8.063-8.069 12.5-18.787 12.5-30.192s-4.437-22.124-12.5-30.193zM285.989 89.737l39.264 39.264-204.996 204.997-14.712-29.434a10.671 10.671 0 0 0-9.542-5.896H78.921L285.989 89.737zm-259.788 353.4L40.095 394.5l34.742 34.742-48.636 13.895zm123.135-35.177-51.035 14.579-51.503-51.503 14.579-51.035h28.031l18.385 36.771a10.671 10.671 0 0 0 4.771 4.771l36.771 18.385v28.032zm21.334-17.543v-17.082c0-4.042-2.281-7.729-5.896-9.542l-29.434-14.712 204.996-204.996 39.264 39.264-208.93 207.068zM441.784 121.72l-47.033 46.613-93.747-93.747 46.582-47.001c8.063-8.063 22.104-8.063 30.167 0l64 64c4.031 4.031 6.25 9.385 6.25 15.083s-2.219 11.052-6.219 15.052z"
                          fill="#9F9F9F" opacity="1" data-original="#000000" class=""></path>
                      </g>
                    </svg>
                  </div>
                  <input type="text" id="price" name="price" value="{{ $banners->price }}"
                    class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Precio ">
                </div>
              </div>
              <div class="md:col-span-2">
                <label for="potition">Posicion </label>
                <div class="relative mb-2  mt-2">

                  {{-- <input type="text" id="potition" name="potition" value="{{ $banners->potition }}"
                    class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Posicion "> --}}
                  <select
                    class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    name="potition" id="potition">
                    <option value="">Elige una Opcion</option>
                    <option value="top" @if ($banners->potition == 'top') selected @endif>Superior</option>
                    <option value="mid" @if ($banners->potition == 'mid') selected @endif>Medio</option>
                    <option value="bottom" @if ($banners->potition == 'bottom') selected @endif>Inferior</option>

                  </select>
                </div>
              </div>
              <div class="md:col-span-2">
                <label for="url_page">Url Pagina </label>
                <div class="relative mb-2  mt-2">
                  <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg"
                      version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0"
                      y="0" viewBox="0 0 469.336 469.336" style="enable-background:new 0 0 512 512"
                      xml:space="preserve" class="">
                      <g>
                        <path
                          d="m456.836 76.168-64-64.054c-16.125-16.139-44.177-16.17-60.365.031L45.763 301.682a10.733 10.733 0 0 0-2.688 4.587L.409 455.73a10.682 10.682 0 0 0 10.261 13.606c.979 0 1.969-.136 2.927-.407l149.333-42.703a10.714 10.714 0 0 0 4.583-2.69l289.323-286.983c8.063-8.069 12.5-18.787 12.5-30.192s-4.437-22.124-12.5-30.193zM285.989 89.737l39.264 39.264-204.996 204.997-14.712-29.434a10.671 10.671 0 0 0-9.542-5.896H78.921L285.989 89.737zm-259.788 353.4L40.095 394.5l34.742 34.742-48.636 13.895zm123.135-35.177-51.035 14.579-51.503-51.503 14.579-51.035h28.031l18.385 36.771a10.671 10.671 0 0 0 4.771 4.771l36.771 18.385v28.032zm21.334-17.543v-17.082c0-4.042-2.281-7.729-5.896-9.542l-29.434-14.712 204.996-204.996 39.264 39.264-208.93 207.068zM441.784 121.72l-47.033 46.613-93.747-93.747 46.582-47.001c8.063-8.063 22.104-8.063 30.167 0l64 64c4.031 4.031 6.25 9.385 6.25 15.083s-2.219 11.052-6.219 15.052z"
                          fill="#9F9F9F" opacity="1" data-original="#000000" class=""></path>
                      </g>
                    </svg>
                  </div>
                  <input type="text" id="url_page" name="url_page" value="{{ $banners->url_page }}"
                    class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Url Pagina ">
                </div>
              </div>


              <div class="md:col-span-5">
                <label for="image">Subir una Foto</label>
                <div class="relative mb-2  mt-2">
                  <input name="image"
                    class="p-2.5 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                    aria-describedby="user_avatar_help" id="user_avatar" type="file">
                </div>
              </div>



              <div class="md:col-span-5 text-right mt-6 flex justify-between">
                <div class="inline-flex items-end">
                  <a href="{{ URL::previous() }}"
                    class="bg-red-500 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded">Volver</a>
                </div>
                <div class="inline-flex items-end">
                  <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">Guardar
                    {{ $title }}</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>

  </div>



</x-app-layout>
