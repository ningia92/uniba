function showTassoSuccesso(idStudio)
{
    $('#dynamic-content').html('');
    $('#modal_successo_task').modal('show');
 
    $.ajax({
        url: 'esperto_successo_task.php',
        type: 'POST',
        data: 'idstudio='+idStudio,
        dataType: 'html'
    })
    .done(function(data){
        console.log(data);
        $('#dynamic-content').html('');
        $('#dynamic-content').html(data);
        $('#modal-loader').modal('hide');
    })
    .fail(function(){
        $('#dynamic-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
        $('#modal-loader').modal('hide');
    });
}
