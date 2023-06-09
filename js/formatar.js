const dataAtual = new Date().toISOString().split('T')[0];
document.getElementById('data_nascimento').setAttribute('max', dataAtual);

$(document).ready(function() {
    $('#cpf').inputmask('999.999.999-99');
    $('#celular').inputmask('(99)99999-9999')
    });