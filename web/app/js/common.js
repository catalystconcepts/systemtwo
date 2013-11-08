$(document).ready(function(){
    /* init jquery validation */
    $('form').validate({
        errorPlacement: function(label, element) {
            label.addClass('inline text-error');
            label.insertAfter(element);
        },
        wrapper: 'span'
    });

});