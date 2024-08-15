$(document).ready(function(){
    $('.money').mask('000.000.000.000.000,00', {reverse: true});
    $('#tipo').change(function(){
        var tipo = $(this).val();
        // pessoa fisica
        if(tipo == 0){
            $('#cnpj').hide();
            $('#cpf').show();
        }
        // pessoa juridica
        if(tipo == 1){
            $('#cnpj').show();
            $('#cpf').hide();
        }
    })
});