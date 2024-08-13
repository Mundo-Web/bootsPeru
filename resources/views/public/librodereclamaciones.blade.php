@extends('components.public.matrix', ['pagina' => ' '])

@section('css_importados')

@stop
<style>
  .fixedWhastapp {
    right: 128px !important;
  }
</style>

@section('content')
  <section class="w-11/12 mx-auto font-poppins">
    @if ($errors->has('g-recaptcha-response'))
      <span class="help-block">
        <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
      </span>
    @endif
    <h2 class="col-span-4 font-bold text-4xl leading-none md:leading-tight text-center pt-3">Libro de Reclamaciones</h2>
    <form class="flex flex-col gap-5" id="formLibroReclamo" action="" method="POST" enctype='multipart/form-data'>
      <div class=" my-16 grid grid-cols-1  lg:grid-cols-4 gap-5 justify-center items-center">
        @csrf

        <h2 class="col-span-4 font-semibold text-[24px] leading-none md:leading-tight">Identificación del Consumidor
        </h2>

        <div class="flex flex-col col-span-4 lg:col-span-2 gap-2">
          <label for="fullname" class="font-medium text-[12px] text-[#6C7275]">Nombre</label>
          <input id="fullname" type="text" placeholder="Nombre Completo" required name="fullname"
            class="w-full py-3 px-4 focus:outline-none placeholder-gray-400 font-normal text-[16px] border-[1.5px] border-gray-200 rounded-xl text-[#6C7275]" />
        </div>


        <div class="flex flex-col col-span-4 lg:col-span-1 gap-2">
          <label for="type_document" class="font-medium text-[12px] text-[#6C7275]">Tipo de documento</label>
          <select id="type_document" required name="type_document"
            class="w-full py-3 px-4 focus:outline-none placeholder-gray-400 font-normal text-[16px] border-[1.5px] border-gray-200 rounded-xl text-[#6C7275]">
            <option>RUC</option>
            <option>C.E</option>
            <option>PASAPORTE</option>
            <option>DNI</option>
          </select>
        </div>


        <div class="flex flex-col col-span-4 lg:col-span-1 gap-2">
          <label for="number_document" class="font-medium text-[12px] text-[#6C7275]">Numero de indentidad</label>
          <input id="number_document" type="text" placeholder="Numero de indentidad" required name="number_document"
            class="w-full py-3 px-4 focus:outline-none placeholder-gray-400 font-normal text-[16px] border-[1.5px] border-gray-200 rounded-xl text-[#6C7275]" />
        </div>

        <div class="flex flex-col col-span-4 lg:col-span-2 gap-2">
          <label for="cellphone" class="font-medium text-[12px] text-[#6C7275]">Celular</label>
          <input id="cellphone" type="text" placeholder="Numero celular" required name="cellphone"
            class="w-full py-3 px-4 focus:outline-none placeholder-gray-400 font-normal text-[16px] border-[1.5px] border-gray-200 rounded-xl text-[#6C7275]" />
        </div>

        <div class="flex flex-col col-span-4 lg:col-span-2 gap-2">
          <label for="email" class="font-medium text-[12px] text-[#6C7275]">Correo
            Electrónico</label>
          <input type="email" placeholder="hola@gmail.com" required name="email" id="email"
            class="w-full py-3 px-4 focus:outline-none placeholder-gray-400 font-normal text-[16px] border-[1.5px] border-gray-200 rounded-xl" />
        </div>

        <div class="flex flex-col col-span-4 lg:col-span-2 gap-2">
          <label for="department" class="font-medium text-[12px] text-[#6C7275]">Departamento</label>
          <select id="selectDepartamento" placeholder="Departamento" required name="department"
            class="w-full py-3 px-4 focus:outline-none placeholder-gray-400 font-normal text-[16px] border-[1.5px] border-gray-200 rounded-xl text-[#6C7275]">
            <option value="">Seleccionar departamento </option>
            @foreach ($departamentofiltro as $item)
              <option value="{{ $item->id }}">{{ $item->description }}</option>
            @endforeach
          </select>
        </div>

        <div class="flex flex-col col-span-4 lg:col-span-1 gap-2">
          <label for="province" class="font-medium text-[12px] text-[#6C7275]">Provincia</label>
          <select id="selectProvincia" type="text" placeholder="Provincia" required name="province"
            class="w-full py-3 px-4 focus:outline-none placeholder-gray-400 font-normal text-[16px] border-[1.5px] border-gray-200 rounded-xl text-[#6C7275]">
            <option value="">Seleccionar provincia </option>
          </select>
        </div>

        <div class="flex flex-col col-span-4 lg:col-span-1 gap-2">
          <label for="district" class="font-medium text-[12px] text-[#6C7275]">Distrito</label>
          <select id="selectDistrito" type="text" placeholder="Distrito" required name="district"
            class="w-full py-3 px-4 focus:outline-none placeholder-gray-400 font-normal text-[16px] border-[1.5px] border-gray-200 rounded-xl text-[#6C7275]">
            <option value="">Seleccionar distrito </option>
          </select>
        </div>

        <div class="flex flex-col col-span-4 gap-2">
          <label for="address" class="font-medium text-[12px] text-[#6C7275]">Direccion</label>
          <input id="address" type="text" placeholder="Direccion" required name="address"
            class="w-full py-3 px-4 focus:outline-none placeholder-gray-400 font-normal text-[16px] border-[1.5px] border-gray-200 rounded-xl text-[#6C7275]" />
        </div>



        <h2 class="col-span-4 font-semibold text-[24px] leading-none md:leading-tight">Identificación del bien
          contratado</h2>

        <div class="flex flex-col col-span-4 gap-2">
          <label for="typeitem" class="font-medium text-[12px] text-[#6C7275]">¿Fue un producto o
            Servicio?</label>
          <select id="typeitem" required name="typeitem"
            class="w-full py-3 px-4 focus:outline-none placeholder-gray-400 font-normal text-[16px] border-[1.5px] border-gray-200 rounded-xl text-[#6C7275]">
            <option>Producto</option>
            <option>Servicio</option>
          </select>
        </div>

        <div class="flex flex-col col-span-4 lg:col-span-2 gap-2">
          <label for="amounttotal" class="font-medium text-[12px] text-[#6C7275]">Monto reclamado</label>
          <input id="amounttotal" type="text" placeholder="Monto total reclamado" required name="amounttotal"
            class="w-full py-3 px-4 focus:outline-none placeholder-gray-400 font-normal text-[16px] border-[1.5px] border-gray-200 rounded-xl text-[#6C7275]" />
        </div>

        {{-- <div class="flex flex-col col-span-4 lg:col-span-1 gap-2">
                    <label for="category_product_service" class="font-medium text-[12px] text-[#6C7275]">Tipo de
                        bien</label>
                    <select id="category_product_service" type="text" required name="category_product_service"
                        class="w-full py-3 px-4 focus:outline-none placeholder-gray-400 font-normal text-[16px] border-[1.5px] border-gray-200 rounded-xl text-[#6C7275]">
                        <option>Producto</option>
                        <option>Servicio</option>
                    </select>
                </div> --}}

        <div class="flex flex-col col-span-4 lg:col-span-2 gap-2">
          <label for="description" class="font-medium text-[12px] text-[#6C7275]">Descripcion de
            producto</label>
          <input id="description" type="text" placeholder="Nombre de producto y/o servicios, codigo(opcional)"
            required name="description"
            class="w-full py-3 px-4 focus:outline-none placeholder-gray-400 font-normal text-[16px] border-[1.5px] border-gray-200 rounded-xl text-[#6C7275]" />
        </div>

        <h2 class="col-span-4 font-semibold text-[24px] leading-none md:leading-tight">Detalle del reclamo del
          pedido del consumidor</h2>


        <div class="flex flex-col col-span-4 gap-2">
          <label for="type_claim" class="font-medium text-[12px] text-[#6C7275]">¿Es un reclamo o queja?</label>
          <select id="type_claim" type="text" required name="type_claim"
            class="w-full py-3 px-4 focus:outline-none placeholder-gray-400 font-normal text-[16px] border-[1.5px] border-gray-200 rounded-xl text-[#6C7275]">
            <option>Reclamo</option>
            <option>Queja</option>
          </select>
        </div>


        <div class="flex flex-col col-span-4 lg:col-span-2 gap-2">
          <label for="date_incident" class="font-medium text-[12px] text-[#6C7275]">Fecha de ocurrencia</label>
          <input id="date_incident" type="date" placeholder="Provincia" required name="date_incident"
            class="w-full py-3 px-4 focus:outline-none placeholder-gray-400 font-normal text-[16px] border-[1.5px] border-gray-200 rounded-xl text-[#6C7275]" />
        </div>

        <div class="flex flex-col col-span-4 lg:col-span-2 gap-2">
          <label for="address_incident" class="font-medium text-[12px] text-[#6C7275]">Numero de Pedido</label>
          <input id="address_incident" type="text" placeholder="Numero de pedido: #95825548" required
            name="address_incident"
            class="w-full py-3 px-4 focus:outline-none placeholder-gray-400 font-normal text-[16px] border-[1.5px] border-gray-200 rounded-xl text-[#6C7275]" />
        </div>

        <div class="flex flex-col col-span-4 gap-2">
          <label for="detail_incident" class="font-medium text-[12px] text-[#6C7275]">Detalle de reclamo o
            queja</label>
          <textarea name="detail_incident" id="detail_incident" cols="30" rows="3"
            class="border-gray-200 border-[1.5px] rounded-xl focus:outline-none" placeholder="Detalle de reclamo"></textarea>
        </div>


        <div class="flex flex-row col-span-4 gap-2 ">
          <input id="termsandconditions" type="checkbox" required class="border-2 rounded-sm w-5 h-5" />
          <label for="termsandconditions" class="font-medium text-sm text-[#6C7275]">Estoy de acuerdo con los <a
              class="font-bold" href="{{ route('terms_condition') }}">terminos y condiciones</a></label>

        </div>
        {{-- <div class="flex flex-col col-span-4 gap-2">
                    <label for="archivo" class="font-medium text-[12px] text-[#6C7275]">Adjuntar archivos
                        (opcional)</label>
                    <input id="archivo" type="file"  name="archivo"
                        class="w-full py-3 px-4 focus:outline-none placeholder-gray-400 font-normal text-[16px] border-[1.5px] border-gray-200 rounded-xl text-[#6C7275]" />
                </div> --}}


        <div class="flex flex-row col-span-4 gap-2 ">
          {!! NoCaptcha::renderJs() !!}
          {!! NoCaptcha::display() !!}
        </div>

        <div class="flex flex-row col-span-2 gap-2 ">
          <input type="submit" value="Enviar a libro de reclamaciones" id="btnAjax"
            class="col-span-4 text-white bg-[#006BF6] py-3 rounded-2xl cursor-pointer border-2 font-semibold text-[16px] text-center border-none w-full md:w-auto px-10 inline-block" />
        </div>

      </div>
    </form>
  </section>

@section('scripts_importados')

  <script>
    // function alerta(message) {
    //     Swal.fire({
    //         title: message,
    //         icon: "error",
    //     });
    // }

    function validarEmail(value) {
      console.log(value)
      const regex =
        /^(([^<>()\[\]\\.,;:\s@”]+(\.[^<>()\[\]\\.,;:\s@”]+)*)|(“.+”))@((\[[0–9]{1,3}\.[0–9]{1,3}\.[0–9]{1,3}\.[0–9]{1,3}])|(([a-zA-Z\-0–9]+\.)+[a-zA-Z]{2,}))$/

      if (!regex.test(value)) {
        alerta("El campo email no es válido");
        return false;
      }
      return true;
    }

    $('#formLibroReclamo').submit(function(event) {

      event.preventDefault();
      let formData = new FormData(this);
      // formData.append('g-recaptcha-response', token);

      // console.log(formData);

      if (!validarEmail($('#email').val())) {
        return;
      };


      /* console.log(formDataArray); */
      $.ajax({
        url: '{{ route('guardarFormReclamo') }}',
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          $('#formLibroReclamo')[0].reset();
          Swal.fire({
            title: response.message,
            icon: "success",
          });

        },
        error: function(error) {
          if (error.responseJSON && error.responseJSON.errors) {
            const errors = error.responseJSON.errors;
            const keys = Object.keys(errors);
            let errorMessages = '';

            keys.forEach(key => {
              errorMessages += `<p>${errors[key][0]}</p>`;
            });

            Swal.fire({
              title: 'Fallo al enviar el mensaje',
              html: errorMessages,
              icon: 'warning',
            });
          } else {
            Swal.fire({
              title: 'Error',
              text: 'Ocurrió un error inesperado',
              icon: 'error',
            });
          }
        }
      });
    })
  </script>


  <script>
    $(document).ready(function() {
      $('#selectDepartamento').change(function() {
        var departmentId = $(this).val();
        if (departmentId) {
          $.ajax({
            url: '/obtenerProvincia/' + departmentId,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
              $('#selectProvincia').prop('disabled', false).empty().append(
                '<option value="">Selecciona una provincia</option>');
              $.each(data, function(key, value) {
                $('#selectProvincia').append('<option value="' + value
                  .id +
                  '">' + value.description + '</option>');
              });
              $('#selectDistrito').prop('disabled', true).empty().append(
                '<option value="">Selecciona un distrito</option>');
            }
          });
        } else {
          $('#selectProvincia').prop('disabled', true).empty().append(
            '<option value="">Selecciona una provincia</option>');
          $('#selectDistrito').prop('disabled', true).empty().append(
            '<option value="">Selecciona un distrito</option>');
        }
      });

      $('#selectProvincia').change(function() {
        var provinceId = $(this).val();
        if (provinceId) {
          $.ajax({
            url: '/obtenerDistritos/' + provinceId,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
              $('#selectDistrito').prop('disabled', false).empty().append(
                '<option value="">Selecciona un distrito</option>');
              $.each(data, function(key, value) {
                $('#selectDistrito').append('<option value="' + value
                  .id +
                  '">' + value.description + '</option>');
              });
            }
          });
        } else {
          $('#selectDistrito').prop('disabled', true).empty().append(
            '<option value="">Selecciona un distrito</option>');
        }
      });
    });
  </script>
@stop

@stop
