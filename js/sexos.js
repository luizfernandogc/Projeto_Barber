function obterSexos() {
  $.getJSON('../core/obtersexos.php')
    .done(function(response) {
      if (response.success) {
        var options = Object.entries(response.sexos)
          .map(function([key, value]) {
            return '<option value="' + key + '">' + value + '</option>';
          })
          .join('');
        $('#sexo').html(options);
      } else {
        console.error(response.message);
      }
    })
    .fail(function(xhr, status, error) {
      console.error(error);
      console.log('Erro ao obter os sexos.');
    });
}

$(document).ready(function() {
  obterSexos();
});
