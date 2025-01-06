<div class="max-w-sm mx-auto p-2 bg-white text-gray-800 font-sans w-full">
  <h1 class="text-xl font-semibold mb-4">DETALLE DE COMPRAS</h1>

  <div id="cart-items"></div>

  <div class="space-y-2 text-sm">
    <div class="flex justify-between">
      <span>Sub Total</span>
      <span id="subtotal"></span>
    </div>
    {{-- <div id="discount-container" class="flex justify-between ">
      <span>Descuento</span>
      <span id="discount"></span>
    </div> --}}
    <div class="flex justify-between">
      <span>Costo de envío</span>
      <span id="shipping-cost"></span>
    </div>
    <div class="flex justify-between font-semibold text-base">
      <span>Total</span>
      <span id="total"></span>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Obtener datos del localStorage
    const cartItems = Local.get('carrito') ?? []
    const costoEnvio = parseFloat(localStorage.getItem('costoEnvio')) || 0;
    const historicoCupones = JSON.parse(localStorage.getItem('historicoCupones')) || [];
    let points = parseFloat(localStorage.getItem('points')) || 0;
    let userPoints = parseFloat(localStorage.getItem('userPoints')) || 0;

    // Calcular subtotal
    let subtotal = cartItems.reduce((carry, item) => {
      let finalQuantity = item.cantidad;
      for (let i = 0; i < item.cantidad; i++) {
        if (item.usePoints && userPoints >= item.points) {
          finalQuantity--;
          userPoints -= item.points;
        }
      }
      return carry + finalQuantity * item.precio;
    }, 0);

    // Calcular descuento
    let descuento = 0;
    let cupon = null;
    if (historicoCupones.length > 0) {
      cupon = historicoCupones[0].cupon || null;
      if (cupon) {
        if (cupon.porcentaje == 1) {
          descuento = (subtotal * cupon.monto) / 100;
        } else {
          descuento = cupon.monto;
        }
      }
    }

    // Calcular total con descuento
    let totalConDescuento = subtotal + costoEnvio - descuento;
    let porcentaje = cupon && cupon.porcentaje == 1 ? '%' : 'S/';
    let cuponMonto = cupon ? porcentaje + ' ' + Number(cupon.monto).toFixed(0) : '';

    // Actualizar el DOM
    document.getElementById('subtotal').innerText = 'S/ ' + subtotal.toFixed(2);
    document.getElementById('shipping-cost').innerText = 'S/ ' + costoEnvio.toFixed(2);
    document.getElementById('total').innerText = 'S/ ' + totalConDescuento.toFixed(2);
    if (cupon) {
      document.getElementById('discount').innerText = cuponMonto;
      document.getElementById('discount-container').classList.remove('hidden');
    }

    // Renderizar los items del carrito
    const cartItemsContainer = document.getElementById('cart-items');
    cartItems.forEach(item => {
      let finalQuantity = item.cantidad;
      for (let i = 0; i < item.cantidad; i++) {
        if (item.usePoints && userPoints >= item.points) {
          finalQuantity--;
          userPoints -= item.points;
        }
      }
      const subtotalf = finalQuantity * item.precio;

      const itemElement = document.createElement('div');
      itemElement.classList.add('border-b', 'pb-4', 'mb-4');
      itemElement.innerHTML = `
        <div class="flex justify-between items-start mb-2">
          <div>
            <h2 class="font-semibold">${item.producto}</h2>
            <p class="text-sm text-gray-600">${item.extracto}</p>
            ${item.usePoints ? '<span class="text-orange-500 text-sm">Usando puntos</span>' : ''}
            <p class="text-sm text-gray-600">SKU: ${item.sku}</p>
          </div>
          <div class="text-right">
            <p class="font-semibold">S/ ${subtotalf.toFixed(2)}</p>
            <p class="text-sm">Cantidad: ${item.cantidad}</p>
          </div>
        </div>
        <button onclick="toggleImage(${item.id})" class="flex items-center text-blue-600 text-sm">
          <span id="toggle-icon-${item.id}">
            <svg class="w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
          </span>
          <span id="toggle-text-${item.id}">Ver imagen</span>
        </button>
        <img id="image-${item.id}" src="/${item.imagen}" alt="${item.producto}" class="mt-2 w-24 h-24 object-cover rounded hidden" />
      `;
      cartItemsContainer.appendChild(itemElement);
    });
  });

  function toggleImage(id) {
    const image = document.getElementById(`image-${id}`);
    const icon = document.getElementById(`toggle-icon-${id}`);
    const text = document.getElementById(`toggle-text-${id}`);

    if (image.classList.contains('hidden')) {
      image.classList.remove('hidden');
      icon.innerHTML =
        '<svg class="w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" /></svg>';
      text.innerText = 'Ocultar imagen';
    } else {
      image.classList.add('hidden');
      icon.innerHTML =
        '<svg class="w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>';
      text.innerText = 'Ver imagen';
    }
  }
</script>
