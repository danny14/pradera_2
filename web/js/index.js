function paginador(objeto,url){
    window.location.href = url + '?page=' + $(objeto).val();
}

function eliminar(id, variable, url){
    $.ajax({
        url: url,
        data: variable + '=' + id,
        datatype: 'json',
        type: 'POST', //GET POST DELETE PUT
        success: function(data){
            location.reload();
        }        
    });
}
function eliminarMasivo(){
   $('#myModalDeleteMasivo').modal('toggle');
};

$(document).ready(function(){
  $('#chkAll').click(function(){
    $('input[name="chk[]"]').each(function(index, element){
      if ($('#chkAll').is(':checked') == true && $(element).is(':checked') == false) {
        $(element).prop('checked', true);
      } else if ($('#chkAll').is(':checked') == false && $(element).is(':checked') == true) {
        $(element).prop('checked', false);
      }
    });
  });
  
//  $('input[name="chk[]"]').each(function(index, element){
// if ($(element).is(':checked') == true) {
//     $('#btnDeleteMasivo').removeClass('disabled');
//    }
//  });

});