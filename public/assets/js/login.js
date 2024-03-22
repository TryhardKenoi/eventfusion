$(document).ready(() => {
   
    $('.input100').each(function(){
        if($(this).val().trim() != "") {
            $(this).addClass('has-val');
        }
        else {
            $(this).removeClass('has-val');
        }

        $(this).on('blur', function(){
            console.log($(this).val());
            if($(this).val().trim() != "") {
                $(this).addClass('has-val');
            }
            else {
                $(this).removeClass('has-val');
            }
        });    
    });
    
});