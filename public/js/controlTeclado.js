$(document).ready(function(){
    $('.bloquearLetras').on('input', function(e) {
        var inputValue = $(this).val();

        var numericValue = inputValue.replace(/[^0-9]/g, '');

        $(this).val(numericValue);
    });

    $('.bloquearNumeros').on('input', function(e) {
        var inputValue = $(this).val();
    
        var alphabeticValue = inputValue.replace(/[^a-zA-Z]/g, '');
    
        $(this).val(alphabeticValue);
    });
    
});