$(document).ready(function() {
  // Função para exibir as mensagens de notificação
  function showToast(message) {
    $('.toast-body').text(message);
    $('.toast').toast('show');
  }

  // Função para obter os sexos disponíveis
  function obterSexos() {
    $.ajax({
      url: '../core/obterSexos.php',
      method: 'GET',
      dataType: 'json',
      success: function(response) {
        if (response.success) {
          // Preenche a lista de opções de sexo com os valores retornados
          var options = '';
          $.each(response.sexos, function(key, value) {
            options += '<option value="' + key + '">' + value + '</option>';
          });
          $('#sexo').html(options);
        } else {
          showToast(response.message);
        }
      },
      error: function(xhr, status, error) {
        console.error(error);
        showToast('Erro ao obter os sexos.');
      }
    });
  }

  // Chama a função para obter os sexos disponíveis
  obterSexos();

  // Função para salvar os dados
  function salvarDados() {
    var cpf = $('#cpf').val();
    var nome = $('#nome').val();
    var sobrenome = $('#sobrenome').val();
    var sexo = $('#sexo').val();
    var debitos = $('#debitos').val();
    var celular = $('#celular').val();
    var email = $('#email').val();
    var foto = $('#foto').val();

    $.ajax({
      url: '../core/salvar.php',
      method: 'POST',
      data: {
        cpf: cpf,
        nome: nome,
        sobrenome: sobrenome,
        sexo: sexo,
        debitos: debitos,
        celular: celular,
        email: email,
        foto: foto
      },
      dataType: 'json',
      success: function(response) {
        if (response.success) {
          showToast(response.message);
          obterSexos();
        } else {
          showToast(response.message);
        }
      },
      error: function(xhr, status, error) {
        console.error(error);
        showToast('Erro ao salvar os dados.');
      }
    });
  }

  // Função para consultar os dados
  function consultarDados() {
    var cpf = $('#cpf').val();

    $.ajax({
      url: '../core/consulta.php',
      method: 'POST',
      data: { cpf: cpf },
      dataType: 'json',
      success: function(response) {
        if (response.error) {
          showToast(response.error);
        } else {
          $('#resultado').html('<table class="table"><tbody>' +
            '<tr><th>CPF</th><td>' + response.cpf + '</td></tr>' +
            '<tr><th>Nome</th><td><input type="text" id="nome" value="' + response.nome + '" disabled></td></tr>' +
            '<tr><th>Sobrenome</th><td><input type="text" id="sobrenome" value="' + response.sobrenome + '"></td></tr>' +
            '<tr><th>Sexo</th><td>' +
            '<select id="sexo">' +
            '</select>' +
            '</td></tr>' +
            '<tr><th>Débitos</th><td><input type="text" id="debitos" value="' + response.debitos + '"></td></tr>' +
            '<tr><th>Celular</th><td><input type="text" id="celular" value="' + response.celular + '"></td></tr>' +
            '<tr><th>Email</th><td><input type="text" id="email" value="' + response.email + '"></td></tr>' +
            '<tr><th>Foto</th><td><input type="text" id="foto" value="' + response.foto + '"></td></tr>' +
            '</tbody></table>' +
            '<button id="confirmar" class="btn btn-primary">Confirmar</button>');
          
          // Seleciona o sexo correspondente ao valor retornado pela consulta
          $('#sexo').val(response.sexo);
        }
      },
      error: function(xhr, status, error) {
        console.error(error);
        showToast('CPF NÃO ENCONTRADO');
      }
    });
  }

  // Evento de clique no botão "Consultar"
  $('#consultar').click(function() {
    consultarDados();
  });

  // Evento de clique no botão "Confirmar"
  $(document).on('click', '#confirmar', function() {
    salvarDados();
  });
});
