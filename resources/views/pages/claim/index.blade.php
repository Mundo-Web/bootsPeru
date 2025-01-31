<x-app-layout>
  <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

    <div
      class="col-span-full xl:col-span-8 bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
      <header class="px-5 py-4 border-b border-slate-100 dark:border-slate-700">
        <h2 class="font-semibold text-slate-800 dark:text-slate-100 text-2xl tracking-tight">Libro de Reclamaciones</h2>
      </header>
      <div class="p-3">

        <!-- Table -->
        <div class="overflow-x-auto">

          <table id="tabladatos" class="display text-lg" style="width:100%">
            <thead>
              <tr>
                <th>Nombre completo</th>
                <th>Correo</th>
                <th>Celular</th>
                <th>Fecha de incidente</th>
                <th class="w-32">Acciones</th>
              </tr>
            </thead>
            <tbody>

              @foreach ($mensajes as $item)
                <tr>
                  <td>
                    @if ($item->is_read == '0')
                      <a href="{{ route('reclamo.show', $item->id) }}"><span class="mr-4"><i
                            class="fa-regular fa-envelope"></i></span><span
                          class="font-bold dark:text-white">{{ $item->fullname }}</span></a>
                    @else
                      <a href="{{ route('reclamo.show', $item->id) }}"><span class="mr-4"><i
                            class="fa-regular fa-envelope-open"></i></span><span>{{ $item->fullname }}</span></a>
                    @endif

                  </td>
                  <td>{{ $item->email }}</td>
                  <td>{{ $item->cellphone }}</td>
                  <td>{{ $item->created_at ? \Carbon\Carbon::parse($item->created_at)->format('Y-m-d H:i:s') : '' }}</td>
                  <td class="flex flex-row items-center justify-center">

                    <a href="{{ route('reclamo.show', $item->id) }}"
                      class="bg-green-300 px-3 py-2 rounded text-white  "><i class="fa-regular fa-eye"></i></a>

                    {{-- <button method="POST" onclick="borrarmensaje({{ $item->id }})"
                                          class="bg-red-600 p-2 rounded text-white"><i class="fa-regular fa-trash-can"></i></button> --}}
                    <!--a href="" class="bg-yellow-400 p-2 rounded text-white mr-6"><i class="fa-regular fa-pen-to-square"></i></a-->
                  </td>
                </tr>
              @endforeach

            </tbody>
            <tfoot>
              <tr>
                <th>Nombre completo</th>
                <th>Correo</th>
                <th>Celular</th>
                <th>Acciones</th>
              </tr>
            </tfoot>
          </table>

        </div>
      </div>
    </div>

  </div>

  <script>
    $('document').ready(function() {
      new DataTable('#tabladatos', {
        ordering: false,
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
        layout: {
          topStart: 'buttons'
        },
        language: {
          "lengthMenu": "Mostrar _MENU_ registros",
          "zeroRecords": "No se encontraron resultados",
          "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
          "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
          "infoFiltered": "(filtrado de un total de _MAX_ registros)",
          "sSearch": "Buscar:",

          "sProcessing": "Procesando...",
        },
        buttons: [

          {
            extend: 'excelHtml5',
            text: '<i class="fas fa-file-excel"></i> ',
            titleAttr: 'Exportar a Excel',
            className: 'btn btn-success',
          },
          {
            extend: 'pdfHtml5',
            text: '<i class="fas fa-file-pdf"></i> ',
            titleAttr: 'Exportar a PDF',
          },
          {
            extend: 'csvHtml5',
            text: '<i class="fas fa-file-csv"></i> ',
            titleAttr: 'Imprimir',
            className: 'btn btn-info',
          },
          {
            extend: 'print',
            text: '<i class="fa fa-print"></i> ',
            titleAttr: 'Imprimir',
            className: 'btn btn-info',
          },
          {
            extend: 'copy',
            text: '<i class="fas fa-copy"></i> ',
            titleAttr: 'Copiar',
            className: 'btn btn-success',
          },
        ]
      });

    })



    function borrarmensaje(id) {
      console.log(id)
      $.ajax({
        url: '{{ route('reclamo.borrar') }}',
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        data: {
          id
        },
        success: function(success) {
          Swal.fire({
            title: "Exito",
            text: 'Solicitud enviada con exito ',
            icon: "success"
          });

          window.location.href = '/admin/mensajes';
        },
        error: function(error) {
          console.log(error)
          Swal.fire({
            title: "Ops !",
            text: 'El mensaje no ha podido ser enviado, en breves momentos volvera a estar disponible',
            icon: "warning"
          });
        }

      })
    }
  </script>

</x-app-layout>
