import 'jquery-mask-plugin/dist/jquery.mask.min.js';

$(document).ready(function() {
    $('.cpf-autocomplete').mask('000.000.000-00', {reverse: true});
});
