$(function(){
  alert('hola');
    $('#circunscripcion_judicial').on('change', onSelectProjectChange);

});

function onSelectProjectChange() {
    var relacion = $(this).val();
alert('hola');
    // AJAX
    if (! relacion)
    $('#juzgado').html('<option value="">Seleccione Nivel</option>');

    $.get({{ url('/api/denuncia/'+relacion+'/niveles'') }}, function(data) {

        var html_select = '<option value="">Seleccione Nivel</option>';
        for (var i=0; i<data.length; ++i)
            html_select += '<option value="'+data[i].id+'">'+data[i].opcion+'</option>';
        $('#juzgado').html(html_select);
    });
});
