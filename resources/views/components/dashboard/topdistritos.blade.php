<div
  class="flex flex-col col-span-full sm:col-span-6 xl:col-span-4 bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
  <header class="px-5 py-4 border-b border-slate-100 dark:border-slate-700">
    <h2 class="font-semibold text-slate-800 dark:text-slate-100">Top distritos que mas compran</h2>
  </header>
  <div class="grid grid-cols-1 md:grid-cols-2 md:gap-6 max-w-80 w-full px-4">
    <div class="relative z-0 w-full group mt-4 dark:text-white">
      <input type="date" name="topDistrictsFromDate" id="topDistrictsFromDate"
        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
        value="{{ date('Y-m-01') }}" required />
      <label htmlFor="topDistrictsFromDate"
        class="peer-focus:font-medium absolute text-sm text-gray-500  duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Desde</label>
    </div>
    <div class="relative z-0 w-full group mt-4">
      <input type="date" name="topDistrictsToDate" id="topDistrictsToDate"
        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
        value="{{ date('Y-m-t') }}" required />
      <label htmlFor="topDistrictsToDate"
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
              <div class="font-semibold text-left">Distrito</div>
            </th>
            <th class="p-2">
              <div class="font-semibold text-center">Ventas</div>
            </th>
            </th>
          </tr>
        </thead>
        <tbody id="topDistricts" class="text-sm font-medium divide-y divide-slate-100 dark:divide-slate-700">
          {{-- @foreach ($data as $item)
            <tr>
              <td class="p-2">
                <div class="text-slate-800 dark:text-slate-100">{{ $item->district }}</div>
                <div class="text-xs">
                  {{ $item->department }} - {{ $item->province }}
                </div>
              </td>
              <td class="p-2">
                <div class="text-center">{{ $item->quantity }}</div>
              </td>
            </tr>
          @endforeach --}}
        </tbody>
      </table>

    </div>
  </div>
</div>

<script>
  const reloadTopDistricts = () => {
    const startsAt = $('#topDistrictsFromDate').val()
    const endsAt = $('#topDistrictsToDate').val()

    fetch('/api/dashboard/top-districts', {
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
        $('#topDistricts').empty()
        rows.forEach(row => {
          $('#topDistricts').append(`<tr>
            <td class="p-2">
              <div class="text-slate-800 dark:text-slate-100">${row.district || '<i class="text-slate-500">- Sin distrito -</i>'}</div>
              <div class="text-xs">
                ${row.district ? `${row.department} - ${row.province}` : ''}
              </div>
            </td>
            <td class="p-2">
              <div class="text-center">${row.quantity}</div>
            </td>
          </tr>`)
        })
      })
  }
  $(document).on('change', '#topDistrictsFromDate', () => reloadTopDistricts())
  $(document).on('change', '#topDistrictsToDate', () => reloadTopDistricts())
  reloadTopDistricts()
</script>