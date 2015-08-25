$(document).ready(function(){
  // $('#mvcIcon').hide();
  $('#mvcIcon .mvcPointer').click(function(){
    $('#mvcMain').toggle(150);
    $('#mvcIcon').toggle(150);
  });
  $('#mvcMain .mvcPointer').click(function(){
    $('#mvcMain').toggle(150);
    $('#mvcIcon').toggle(150);
  });
});

//funcion para cerrar la ventana de error automaticamente
function closeError() {
//   $('div[class="alert alert-danger alert-dismissible"]').alert('close');
   $('div[class="alert alert-danger alert-dismissible"]').fadeTo(2000, 500).slideUp(500, function(){
    $('div[class="alert alert-danger alert-dismissible"]').alert('close');
});
}
function closeSucess(){
    $('div[class="alert alert-success alert-dismissible"]').fadeTo(2000, 500).slideUp(500, function(){
    $('div[class="alert alert-success alert-dismissible"]').alert('close');
});
}
$(document).ready(function () {
    setTimeout(closeError, 10000);
    setTimeout(closeSucess,5000);
});
// FIN DE LA FUNCION