$(document).ready(() => {
  //const kdyz nebudu promenout menit
  //let kdyz ve for cyklu nastavim let i = 1 a pak ++

  //close modal on btn close modal click
  $('.modal-close').on('click', () => {

    $('.modal-body3').html("");
    $('.modal-body4').html("");

    $('.modal').removeClass('show');
  });

    
  $("#editForm").submit(function(e){
    //ziskame pole heslo
    const pwd = $('#password').val();
    //ziskame pole heslo kontrola
    const pwdCheck = $('#password-again').val();

    //pokud je vyplneno pole heslo a heslo kontrola
    if(pwd.length >= 1 && pwdCheck.length >= 1) {
      if(pwd != pwdCheck) {
        //todo: error
        e.preventDefault();
        alert('Hesla se neshoduji!')
      }
    }
  });

  /*

  $("#selectUserEvent").bootstrapDualListbox({
      // see next for specifications
  });

  */
});
