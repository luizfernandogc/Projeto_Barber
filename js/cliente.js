$(document).ready(function () {
  $('#registrar').click(function () {
    const nome = $('#nome').val();
    const sobrenome = $('#sobrenome').val();
    let cpf = $('#cpf').val();
    const sexo = $('#sexo').val();
    const debitos = $('#debitos').val();
    let celular = $('#celular').val();
    const email = $('#email').val();
    const foto = $('#foto').val();

    if (cpf === '' || nome === '' || sobrenome === '' || sexo === '' || celular === '' || email === '') {
      alert('Por favor, preencha todos os campos obrigatórios.');
      return;
    }
     // Remover formatação do campo CPF e do Campo celular
     cpf = cpf.replace(/\D/g, '');
     celular = celular.replace(/\D/g, '');
     // Atualizar o valor do campo CPF sem a formatação
     $('#cpf').val(cpf);
     $('cpf').val(celular);
    // Realiza a requisição AJAX
    $.ajax({
      url: '../core/cliente.php',
      method: 'POST',
      data: { cpf: cpf, nome: nome, sobrenome: sobrenome, sexo: sexo, debitos: debitos, celular: celular, email: email, foto: foto },
      success: function (response) {
        $('#resultado').html(response);
        if (response.includes('sucesso')) {
          alert('Cadastro realizado com sucesso!');
        } else {
          alert('Erro ao realizar o cadastro.');
        }
      },
      error: function (xhr, status, error) {
        console.error(error);
        alert('Erro ao realizar o cadastro.');
      }
    });
  });
});