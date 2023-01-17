<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Gazin Tech - Crud</title>
    <link href="{{ asset('bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/bower_components/bootstrap-extension/css/bootstrap-extension.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/bower_components/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/colors/blue.css') }}" id="theme" rel="stylesheet">
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <div id="wrapper">
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Gazin Tech - Crud</h4> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> 
                        <ol class="breadcrumb">
                            <li>Crud</li>
                            <li>Lista</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="white-box">
                            <div class="alert alert-success alert-dismissable" style="display: none;" id="alert_success"></div>
                            <div class="alert alert-danger alert-dismissable" style="display: none;" id="alert_danger"></div>
                            <section>
                                <div class="sttabs tabs-style-line">
                                    <nav>
                                        <ul>
                                            <li><a href="#section-line-1"><span>Níveis</span></a></li>
                                            <li><a href="#section-line-2"><span>Desenvolvedores</span></a></li>
                                        </ul>
                                    </nav>
                                    <div class="content-wrap">
                                        @yield('levels')
                                        @include('developers')                                       
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
            
            <footer class="footer text-center"> Gazin Tech - Crud </footer>
        </div>
    </div>
    <script src="{{ asset('plugins/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('bootstrap/dist/js/tether.min.js') }}"></script>
    <script src="{{ asset('bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/bootstrap-extension/js/bootstrap-extension.min.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js') }}"></script>
    <script src="{{ asset('js/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('js/waves.js') }}"></script>
    <script src="{{ asset('js/custom.min.js') }}"></script>
    <script src="{{ asset('js/cbpFWTabs.js') }}"></script>
    <script type="text/javascript">
    (function() {
        [].slice.call(document.querySelectorAll('.sttabs')).forEach(function(el) {
            new CBPFWTabs(el);
        });
    })();
    </script>


    <script type="text/javascript">
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
                        $('#alert_danger').html('<button type="button" class="close" data-dismiss="alert" aria-hidden="true">' +
                                                        '&times;</button>' + 
                                                        'Ops! Ocorreu um erro para conectar ao banco.');
                            
                            document.getElementById('alert_danger').style.display = "block";
                            document.querySelector('#close_modal').click();
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
                load_developers();
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
            load_developers();
            
            
            $('#FormDev').on('submit', function(event){
                event.preventDefault();
                var form = $('#FormDev');
                if($('#action_dev').val() == 'Add') {   
                    $.ajax({
                        url:"{{ route('post.developer') }}",
                        method:"POST",
                        data: form.serialize(),
                        dataType:"json",
                        success:function(data) {
                            
                            if(data.errors) {
                                $('#alert_danger').html('<button type="button" class="close" data-dismiss="alert" aria-hidden="true">' +
                                                        '&times;</button>' + 
                                                        data.errors);
                                document.getElementById('alert_danger').style.display = "block";
                                document.querySelector('#close_modal_dev').click();
                            }
                            if(data.success) {
                                $('#alert_success').html('<button type="button" class="close" data-dismiss="alert" aria-hidden="true">' +
                                                        '&times;</button>' + 
                                                        data.success);
                                document.getElementById('alert_success').style.display = "block";
                                document.querySelector('#close_modal_dev').click();
                            }
                            
                        }, 
                        error:function (data){
                            $('#alert_danger').html('<button type="button" class="close" data-dismiss="alert" aria-hidden="true">' +
                                                        '&times;</button>' + 
                                                        data.responseJSON.errors);
                            
                            document.getElementById('alert_danger').style.display = "block";
                            document.querySelector('#close_modal_dev').click();
                        }                    
                    })
                    
                }

                if($('#action_dev').val() == "Edit") {
                    $.ajax({
                        url:"{{ route('put.developer') }}",
                        method:"PUT",
                        data: form.serialize(),
                        dataType:"json",
                        success:function(data) {
                            
                            if(data.errors) {
                                $('#alert_danger').html('<button type="button" class="close" data-dismiss="alert" aria-hidden="true">' +
                                                        '&times;</button>' + 
                                                        data.errors);
                                document.getElementById('alert_danger').style.display = "block";
                                document.querySelector('#close_modal_dev').click();
                            }
                            if(data.success) {
                                $('#alert_success').html('<button type="button" class="close" data-dismiss="alert" aria-hidden="true">' +
                                                        '&times;</button>' + 
                                                        data.success);
                                document.getElementById('alert_success').style.display = "block";
                                document.querySelector('#close_modal_dev').click();
                            }
                            
                        }, 
                        error:function (data){
                            $('#alert_danger').html('<button type="button" class="close" data-dismiss="alert" aria-hidden="true">' +
                                                        '&times;</button>' + 
                                                        data.responseJSON.errors);
                            
                            document.getElementById('alert_danger').style.display = "block";
                            document.querySelector('#close_modal_dev').click();
                        }          
                    });
                }
                load_level();
                load_developers();
                reseta_componentes_nivel();
            });

            $(document).on('click', '.view-dev', function(){
                var id = $(this).attr('id');
                var url = "{{ route('get.developer', ':id') }}";
	            url = url.replace(':id', id);
                $.ajax({
                    url: url,
                    method: 'GET',
                    dataType: 'json',
                    success:function(response){
                        $(response).each(function(){
                            $('#nome').val(this.nome);
                            $('#nivel_dev').val(this.nivel);
                            $('#sexo').val(this.sexo);
                            $('#datanascimento').val(this.data_nascimento);
                            $('#idade').val(this.idade);
                            $('#hobby').val(this.hobby);
                            $('#hidden_id').val(this.id);
                            $('#modalLabelDev').text("Visualiza Desenvolvedor");
                            document.getElementById('action_button_dev').style.display = "none";
                            document.querySelector('#showModalDev').click();
                        });                        
                    }
                })
            });

            $(document).on('click', '.edit_dev', function(){
                var id = $(this).attr('id');
                var url = "{{ route('get.developer', ':id') }}";
	            url = url.replace(':id', id);
                $.ajax({
                    url: url,
                    method: 'GET',
                    dataType: 'json',
                    success:function(response){
                        $(response).each(function(){
                            $('#nome').val(this.nome);
                            $('#sexo').val(this.sexo);
                            $('#datanascimento').val(this.datanascimento);
                            $('#hobby').val(this.hobby);
                            $('#hidden_id_dev').val(this.id);
                            $('#action_dev').val("Edit");
                            carregaNivel();
                            document.getElementById('sexo_view').style.display = "none";
                            document.getElementById('viewNivel').style.display = "none";
                            document.getElementById('inputIdade').style.display = "none";
                            document.getElementById('action_button_dev').style.display = "block";
                            $('#modalLabelDev').text("Editar Desenvolvedor");
                            $('#action_button_dev').text("Editar");
                            document.querySelector('#showModalDev').click();
                        });                        
                    }
                })
            });

            var dev_id;

            $(document).on('click', '.delete_dev', function(){
                dev_id = $(this).attr('id');
               
                $('#msg_DelDev').text('Deseja realmente excluir o desenvolvedor selecionado?');
                document.getElementById('action_button_del').style.display = "block";
                $('#action_button_del_dev').text("Excluir");
                      
                document.querySelector('#showModalDelDev').click();
            });

            $('#action_button_del_dev').click(function(){
                event.preventDefault();
                var url = "{{ route('delete.developer', ':id') }}";
                url = url.replace(':id', dev_id);
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
                            document.querySelector('#close_modal_del_dev').click();
                        }
                    }, 
                    error:function (data){
                        $('#alert_danger').html('<button type="button" class="close" data-dismiss="alert" aria-hidden="true">' +
                                                    '&times;</button>' + 
                                                    data.responseJSON.errors);
                        
                        document.getElementById('alert_danger').style.display = "block";
                        document.querySelector('#close_modal_del_dev').click();
                    }  
                })
                load_level();
                load_developers();
                reseta_componentes_nivel();
                reseta_componentes_dev();
            });

            
        
        function reseta_componentes_nivel(){
            $('#nivel').val('');
            $('#hidden_id').val('');
        }


        function load_developers(){
            $('#listagem_dev').html("");
            $.ajax({
                url: "{{ route('get.developers') }}",
                method: 'GET',
                dataType: 'json',
                success: function (data, textStatus, XMLHttpRequest) {
                    $(data).each(function(){
                        $('#myTable').append('<tr>'+
                            '<td>' + this.id + '</td>' +
                            '<td>' + this.nome + '</td>' +
                            '<td>' + this.sexo + '</td>' +
                            '<td>' + this.nivel + '</td>' +
                            '<td>'+
                                '<div class="button-box"> '+
                                    '<button name="view" id="'+ this.id +'" class="view-dev btn btn-primary waves-effect waves-light">' +
                                        '<i class="fa fa-eye"></i>' + 
                                    '</button>' +
                                    '<button name="edit_dev" id="'+ this.id +'" class="edit_dev btn btn-success waves-effect waves-light">'+
                                        '<i class="fa fa-pencil"></i>' +
                                    '</button>' +
                                    '<button class="delete_dev btn btn-danger waves-effect waves-light" name="delete_dev" id="'+ this.id +'">' +
                                        '<i class="fa fa-trash-o"></i>' + 
                                    '</button>'+
                                '</div>' +
                            '</td>' +
                        '</tr>');
                    });                    
                },
                error:function (XMLHttpRequest, textStatus, errorThrown){
                    //alert(XMLHttpRequest.responseText);
                }
            })
        }

        $('#btn_acao_dev').click(function(){
            $('.modal-title').text("Cadastrar Desenvolvedor");
            $('#action_button_dev').text("Cadastrar");
            reseta_componentes_nivel();
            carregaNivel();
            $('#action_dev').val("Add");
            document.getElementById('viewNivel').style.display = "none";
            document.getElementById('listaNivel').style.display = "block";
            document.getElementById('inputIdade').style.display = "none";
            document.getElementById('sexo_view').style.display = "none";
            document.querySelector('#showModalDev').click();
        });

        

            

        function reseta_componentes_dev(){
            $('#nome').val('');
            $('#nivel_dev').val('');
            $('#sexo').val('');
            $('#datanascimento').val('');
            $('#idade').val('');
            $('#hobby').val('');
            $('#listaNivel').val('');
            $('#hidden_id_dev').val('');
        }

        function carregaNivel(){
            $('#listNivel').html("");
            $.ajax({
                url: "{{ route('get.levels') }}",
                method: 'GET',
                dataType: 'json',
                success: function (data, textStatus, XMLHttpRequest) {
                    $(data).each(function(){
                        $('#listNivel').append('<option value="'+ this.id +'" name="nivel_id">' +
                            this.nivel + 
                            '</option>');
                    });                    
                },
                error:function (XMLHttpRequest, textStatus, errorThrown){
                    alert(XMLHttpRequest.responseText);
                }
            })
        }

    });

    $(document).ready(function() {
        $("#level_search").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#listagem_nivel tr").filter(function() {
                $(this).toggle($(this).text()
                .toLowerCase().indexOf(value) > -1)
            });
        });
    });

    $(document).ready(function() {
        $("#dev_search").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#listagem_dev tr").filter(function() {
                $(this).toggle($(this).text()
                .toLowerCase().indexOf(value) > -1)
            });
        });
    });
    
    </script>
    <script src="{{ asset('js/mask.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/styleswitcher/jQuery.style.switcher.js') }}"></script>
</body>

</html>