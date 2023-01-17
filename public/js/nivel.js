$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(document).ready(function(){
    function load_level(){
        $('#listagem_nivel').html("");
        $.ajax({
            url: "{{ route('get.levels') }}",
            method: 'GET',
            dataType: 'json',
            success: function (data, textStatus, XMLHttpRequest) {
                $(data).each(function(){
                    $('#myTable2').append('<tr>'+
                        '<td>' + this.id + '</td>' +
                        '<td>' + this.nivel + '</td>' +
                        '<td>'+
                            '<div class="button-box"> '+
                                '<button name="edit" id="'+ this.id +'" class="edit btn btn-success waves-effect waves-light">'+
                                    '<i class="fa fa-pencil"></i>' +
                                '</button>' +
                                '<button class="delete btn btn-danger waves-effect waves-light" name="delete" id="'+ this.id +'" data-delete="'+ this.devs +'">' +
                                    '<i class="fa fa-trash-o"></i>' + 
                                '</button>'+
                            '</div>' +
                        '</td>' +
                    '</tr>');
                });                    
            },
            error:function (XMLHttpRequest, textStatus, errorThrown){
                alert(XMLHttpRequest.responseText);
            }
        })
    }
   
   $(document).on('click', '.edit', function(){
        var id = $(this).attr('id');
        var url = "{{ route('get.level', ':id') }}";
        url = url.replace(':id', id);
        $.ajax({
            url: url,
            method: 'GET',
            dataType: 'json',
            success:function(response){
                $(response).each(function(){
                    $('#nivel').val(this.nivel);
                    $('#hidden_id').val(this.id);
                    $('.modal-title').text("Editar Nível");
                    $('#action_button').text("Editar");
                    $('#action').val("Edit");
                    document.querySelector('#showModal').click();
                });                        
            }
        })
    });

    $('#btn_acao').click(function(){
        $('.modal-title').text("Cadastrar Nível");
        $('#action_button').text("Cadastrar");
        reseta_componentes_nivel();
        $('#action').val("Add");
        document.querySelector('#showModal').click();
    });

    $('#FormNivel').on('submit', function(event){
        event.preventDefault();
        var form = $('#FormNivel');
        if($('#action').val() == 'Add') {                
            $.ajax({
                url:"{{ route('post.level') }}",
                method:"POST",
                data: form.serialize(),
                dataType:"json",
                success:function(data) {
                    
                    if(data.errors) {
                        $('#alert_danger').html('<button type="button" class="close" data-dismiss="alert" aria-hidden="true">' +
                                                '&times;</button>' + 
                                                data.errors);
                        document.getElementById('alert_danger').style.display = "block";
                        document.querySelector('#close_modal').click();
                    }
                    if(data.success) {
                        $('#alert_success').html('<button type="button" class="close" data-dismiss="alert" aria-hidden="true">' +
                                                '&times;</button>' + 
                                                data.success);
                        document.getElementById('alert_success').style.display = "block";
                        document.querySelector('#close_modal').click();
                    }
                    
                }, 
                error:function (data){
                    $('#alert_danger').html('<button type="button" class="close" data-dismiss="alert" aria-hidden="true">' +
                                                '&times;</button>' + 
                                                data.responseJSON.errors);
                    
                    document.getElementById('alert_danger').style.display = "block";
                    document.querySelector('#close_modal').click();
                }                    
            })
            
        }

        if($('#action').val() == "Edit") {
            $.ajax({
                url:"{{ route('put.level') }}",
                method:"PUT",
                data: form.serialize(),
                dataType:"json",
                success:function(data) {
                    
                    if(data.errors) {
                        $('#alert_danger').html('<button type="button" class="close" data-dismiss="alert" aria-hidden="true">' +
                                                '&times;</button>' + 
                                                data.errors);
                        document.getElementById('alert_danger').style.display = "block";
                        document.querySelector('#close_modal').click();
                    }
                    if(data.success) {
                        $('#alert_success').html('<button type="button" class="close" data-dismiss="alert" aria-hidden="true">' +
                                                '&times;</button>' + 
                                                data.success);
                        document.getElementById('alert_success').style.display = "block";
                        document.querySelector('#close_modal').click();
                    }
                    
                }, 
                error:function (data){
                    $('#alert_danger').html('<button type="button" class="close" data-dismiss="alert" aria-hidden="true">' +
                                                '&times;</button>' + 
                                                data.responseJSON.errors);
                    
                    document.getElementById('alert_danger').style.display = "block";
                    document.querySelector('#close_modal').click();
                }          
            });
        }
        load_level();
        reseta_componentes_nivel();
    });
    
    var nivel_id;

    $(document).on('click', '.delete', function(){
        nivel_id = $(this).attr('id');
        var devs = $(this).attr('data-delete');
        if(parseInt(devs) > 0){
            $('#msg_DelNivel').text('Você não pode excluir um nível que contém um ou mais desenvolvedores vinculados!');
            document.getElementById('action_button_del').style.display = "none";
        } else {
            $('#msg_DelNivel').text('Deseja realmente excluir o nível selecionado?');
            document.getElementById('action_button_del').style.display = "block";
            $('#action_button_del').text("Excluir");
        }       
        document.querySelector('#showModalDel').click();
    });

    $('#action_button_del').click(function(){
        event.preventDefault();
        var url = "{{ route('delete.level', ':id') }}";
        url = url.replace(':id', nivel_id);
        $.ajax({                    
            url: url,
            method:"DELETE",
            dataType:"json",
            success:function(data) {
                if(data.success) {
                    $('#alert_success').html('<button type="button" class="close" data-dismiss="alert" aria-hidden="true">' +
                                            '&times;</button>' + 
                                            data.success);
                    document.getElementById('alert_success').style.display = "block";
                    document.querySelector('#close_modal_del').click();
                }
            }, 
            error:function (data){
                $('#alert_danger').html('<button type="button" class="close" data-dismiss="alert" aria-hidden="true">' +
                                            '&times;</button>' + 
                                            data.responseJSON.errors);
                
                document.getElementById('alert_danger').style.display = "block";
                document.querySelector('#close_modal_del').click();
            }  
        })
        load_level();
    });
    load_level();
});
function reseta_componentes_nivel(){
    $('#nivel').val('');
    $('#hidden_id').val('');
}
