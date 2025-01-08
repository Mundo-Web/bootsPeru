<x-app-layout>
  <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
    <div
      class="col-span-full xl:col-span-8 bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
      <header class="px-5 py-4 border-b border-slate-100 dark:border-slate-700">
        <h2 class="font-semibold text-slate-800 dark:text-slate-100 text-2xl tracking-tight">Pedidos</h2>
      </header>

      <div class="px-5 py-4">
        <ul class="flex space-x-4">
          <li class="tab-item cursor-pointer px-4 py-2 rounded-md hover:bg-gray-200 dark:hover:bg-slate-600" 
                data-tab="0" 
                onclick="changeTab(0)">
              Todos
            </li>
          @foreach ($statuses as $status)
            <li class="tab-item cursor-pointer px-4 py-2 rounded-md hover:bg-gray-200 dark:hover:bg-slate-600" 
                data-tab="{{ $status['id'] }}" 
                onclick="changeTab('{{ $status['id'] }}')">
              {{ $status['name'] }}
            </li>
          @endforeach
        </ul>
        <input type="hidden" id="estado" name="estado" value="0" />
      </div>


      <div class="p-3">
        <!-- Table -->
        <div class="overflow-x-auto">
          <x-sales.table is-admin   />
        </div>
      </div>


    </div>
  </div>

  <x-sales.modal is-admin :statuses="$statuses"/>
</x-app-layout>


<script>
  // JavaScript para cambiar las pestañas
  document.addEventListener('DOMContentLoaded', function () {
    const tabs = document.querySelectorAll('.tab-item');
    const tabPanes = document.querySelectorAll('.tab-pane');

    tabs.forEach(tab => {
      tab.addEventListener('click', function () {
        // Desactivar todas las pestañas
        tabs.forEach(t => t.classList.remove('bg-gray-200', 'dark:bg-slate-600'));
        // Activar la pestaña seleccionada
        tab.classList.add('bg-gray-200', 'dark:bg-slate-600');
        
        const activeTab = tab.getAttribute('data-tab');

        tabPanes.forEach(pane => {
          if (pane.id === activeTab) {
            pane.style.display = 'block';
          } else {
            pane.style.display = 'none';
          }
        });
      });
    });
  });
</script>

<script>
  function changeTab(tabId) {
    document.getElementById("estado").value = tabId;
    salesDataGrid.refresh();
  }
</script>