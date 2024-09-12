<div
  class="col-span-full xl:col-span-8 bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
  <header class="px-5 py-4 border-b border-slate-100 dark:border-slate-700 flex justify-between">
    <h2 class="font-semibold text-slate-800 dark:text-slate-100">{{ $title }}</h2>
    <label class="inline-flex items-center cursor-pointer">
      <input id="orderBy" type="checkbox" value="" class="sr-only peer">
      <span class="me-3 text-sm font-medium text-gray-900 dark:text-gray-300">Ingresos</span>
      <div
        class="relative w-9 h-5 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
      </div>
      <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Vendidos</span>
    </label>
  </header>
  <div class="grid grid-cols-1 md:grid-cols-2 md:gap-6 max-w-80 w-full px-4 mt-4">
    <div class="relative z-0 w-full group">
      <input type="date" name="top10FromDate" id="top10FromDate"
        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
        value="{{ date('Y-m-01') }}" required />
      <label htmlFor="top10FromDate"
        class="peer-focus:font-medium absolute text-sm text-gray-500  duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Desde</label>
    </div>
    <div class="relative z-0 w-full group">
      <input type="date" name="top10ToDate" id="top10ToDate"
        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
        value="{{ date('Y-m-t') }}" required />
      <label htmlFor="top10ToDate"
        class="peer-focus:font-medium absolute text-sm text-gray-500  duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Hasta</label>
    </div>
  </div>
  <div class="p-3">
    <div class="overflow-x-auto max-h-[320px] overflow-y-auto">
      <table class="table-auto w-full dark:text-slate-500">
        <thead
          class="text-xs uppercase text-slate-400 dark:text-slate-500 bg-slate-50 dark:bg-slate-700 dark:bg-opacity-50 rounded-sm">
          <tr>
            <th class="p-2">
              <div class="font-semibold text-left">Producto</div>
            </th>
            <th class="p-2">
              <div class="font-semibold text-center">Clientes</div>
            </th>
            <th class="p-2">
              <div class="font-semibold text-center">Ingresos</div>
            </th>
            <th class="p-2">
              <div class="font-semibold text-center">Vendidos</div>
            </th>
          </tr>
        </thead>
        <tbody id="topProducts" class="text-sm font-medium divide-y divide-slate-100 dark:divide-slate-700">
          {{-- @foreach ($data as $item)
            <tr>
              <td class="p-2">
                <div class="flex items-center">
                  <img class="object-center object-cover rounded-md me-2"
                    src="{{ $item->image ? asset($item->image) : '/images/img/noimagen.jpg' }}" width="36"
                    height="36">
                  <div class="text-slate-800 dark:text-slate-100">{!! $item->name !!}
                    @if ($item->color)
                      - {{ $item->color }}
                    @endif
                  </div>
                </div>
              </td>
              <td class="p-2">
                <div class="text-center">{{ $item->total_customers }}</div>
              </td>
              <td class="p-2">
                <div class="text-center text-emerald-500">S/. {{ number_format($item->total_price, 2, '.', ',') }}</div>
              </td>
              <td class="p-2">
                <div class="text-center">{{ $item->total_quantity }}</div>
              </td>
            </tr>
          @endforeach --}}
        </tbody>
      </table>

    </div>
  </div>
</div>

<script>
  const reloadTopProducts = () => {
    const checked = $('#orderBy').prop('checked')
    const startsAt = $('#top10FromDate').val()
    const endsAt = $('#top10ToDate').val()

    console.log(startsAt, endsAt)

    fetch(`/api/dashboard/top-products/${checked ? 'total_quantity' : 'total_price'}`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'x-xsrf-token': decodeURIComponent(Cookies.get('XSRF-TOKEN'))
        },
        body: JSON.stringify({ startsAt, endsAt })
      })
      .then(res => res.json())
      .then(data => {
        const rows = data ?? []
        $('#topProducts').empty()
        rows.forEach(row => {
          $('#topProducts').append(`<tr>
            <td class="p-2">
              <div class="flex items-center">
                <img class="object-center object-contain rounded-md me-2 w-[32px] aspect-square" src="${row.image ? `/${row.image}`: '/images/img/noimagen.jpg'}" alt="Imagen del producto">
                <div class="text-slate-800 dark:text-slate-100">${row.name}
                  ${row.color ? `- ${row.color}`: ''}
                </div>
              </div>
            </td>
            <td class="p-2">
              <div class="text-center">${row.total_customers}</div>
            </td>
            <td class="p-2">
              <div class="text-center text-emerald-500">S/. ${row.total_price}</div>
            </td>
            <td class="p-2">
              <div class="text-center">${row.total_quantity}</div>
            </td>
          </tr>`)
        })
      })
  }
  $(document).on('change', '#orderBy', () => reloadTopProducts())
  $(document).on('change', '#top10FromDate', () => reloadTopProducts())
  $(document).on('change', '#top10ToDate', () => reloadTopProducts())
  reloadTopProducts()
</script>
