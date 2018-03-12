(function() {
    'use strict';
    window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
        });
    }, false);
    })();

 //only number
function onlyNumber(input) {
    $(input).on('keypress input', function() {
        var value = $(this).val();
        value = value.replace(/\D+/, '');
        $(this).val(value);
    });
}
function onlyNumberAndDot(input) {
    $(input).on('keypress input', function() {
        var val = $(input).val();
        if(isNaN(val)){
             val = val.replace(/[^0-9\.]/g,'');
             if(val.split('.').length>2) 
                 val =val.replace(/\.+$/,"");
        }
        $(input).val(val); 
    });
}

//reset form
function resetForm(form) {
    $(form).each(function () {
        this.reset();
    });
}
//format error
function formatErrors(errorMsg) {
    var error = null;
    $.each(errorMsg.errors, function(key, value) {
        error =  errorMsg.errors[key];
        return false;
    });

    return error;
}