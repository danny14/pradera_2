function paginador(objeto, url) {
    window.location.href = url + '?page=' + $(objeto).val();
}

function eliminar(id, variable, url, reload) {
    $.ajax({
        url: url,
        data: variable + '=' + id,
        dataType: 'json',
        type: 'POST', //GET POST DELETE PUT
        success: function (data) {
//          funcion para eliminar individual 
            if(data.code === 200){
                window.location.replace(reload);
            }else if(data.code === 500){
                $('#' + data.modal).modal('toggle');
                $('#myModalErrorDelete').modal('toggle');
                $('#myModalErrorDelete .modal-body').html(data.msg);
                function closeModal(){
                $('#myModalErrorDelete').modal('hide');
                }
                setTimeout(closeModal,5000);
            }
            //fin de la funcion
        },
    });
}
function eliminarMasivo() {
    $('#myModalDeleteMasivo').modal('toggle');
}
;

$(document).ready(function () {
    $('#chkAll').click(function () {
        $('input[name="chk[]"]').each(function (index, element) {
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