$(document).ready(function () {
  $('#consultar').click(function () {
    const cpf = $('#cpf').val();
    if (cpf === '') {
      alert('Por favor, digite um CPF.');
      return;
    }

    // Realiza a requisição AJAX
    $.ajax({
      url: '../core/consulta.php',
      method: 'POST',
      data: { cpf: cpf },
      success: function (response) {
        $('#resultado').html(response);
      },
      error: function (xhr, status, error) {
        console.error(error);
        alert('CPF NÃO ENCONTRADO');
      }
    });
  });

  $('#deletar').click(function () {
    const cpf = $('#cpf').val();
    if (cpf === '') {
      alert('Por favor, digite um CPF.');
      return;
    }

    // Realiza a requisição AJAX para deletar o CPF
    $.ajax({
      url: '../core/deletar.php',
      method: 'POST',
      data: { cpf: cpf },
      success: function (response) {
        $('#resultado').html(response);
      },
      error: function (xhr, status, error) {
        console.error(error);
        alert('Erro ao deletar CPF.');
      }
    });
  });
}); 