<div id="quill-{{ $name }}" name="quill-{{ $name }}"
  class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
  placeholder="Descripción">{{ $value }}</div>
<input id="{{ $name }}" type="hidden" name="{{ $name }}" value='{!! $value !!}' />

<link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>

<script>
  $('document').ready(function() {

    const quill = new Quill('#quill-{{ $name }}', {
      theme: 'snow'
    });

    const existingContent = $('#{{ $name }}').val();
    quill.root.innerHTML = existingContent;

    quill.on('text-change', function() {
      const value = quill.root.innerHTML;
      var tempElem = document.createElement('div');
      tempElem.innerHTML = value;
      tempElem.classList.add('prose')




      $('#{{ $name }}').attr('value', tempElem.outerHTML);
      // $('#{{ $name }}').attr('value', value);
    })

  })
</script>
