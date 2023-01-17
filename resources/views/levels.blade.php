@extends('welcome')

@section('levels')
<section id="section-line-1">
    <div class="row">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-lg-5 col-sm-3 col-xs-12">
                    <div class="input-group">
                        <input type="text" id="level_search" name="example-input1-group2" class="form-control" placeholder="Digite o Nível"> 
                        <span class="input-group-btn">
                            <button type="button" class="btn waves-effect waves-light btn-info">
                                <i class="fa fa-search"></i>
                            </button>
                        </span> 
                    </div>
                </div> 
                <div class="col-lg-5 col-sm-5 col-xs-12">
                </div>  
                <div class="col-lg-2 col-sm-4 col-xs-12">
                    <button class="btn btn-block btn-outline btn-info" id="btn_acao">Cadastrar Nível</button>
                    <button style="display: none;" class="btn btn-block btn-outline btn-info" data-toggle="modal" data-target=".ModalNivelAdd" id="showModal"></button>
                    <button style="display: none;" class="btn btn-block btn-outline btn-info" data-toggle="modal" data-target=".ModalNivelDel" id="showModalDel"></button>
                </div>
            </div>
            <div class="white-box">
                <div class="table-responsive">
                    <table id="myTable2" class="table table-striped">
                        <thead>
                            <tr>
                                <th style="width: 10%;">#</th>
                                <th style="width: 80%;">Nível</th>
                                <th style="width: 10%;">Ações</th>
                            </tr>
                        </thead>
                        <tbody id="listagem_nivel">
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade ModalNivelAdd" tabindex="-1" role="dialog" aria-labelledby="ModalNivelAdd" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">                        
                                        
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myLargeModalLabel">Cadastrar Nível</h4> 
                </div>
                <div class="modal-body">
                    <form enctype="multipart/form-data" id="FormNivel">  
                        <div class="white-box">
                            <h3 class="box-title m-b-0">Preencha os dados abaixo:</h3>
                            <div class="row" style="margin-top: 20px;">
                                <div class="col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="nivel">Nível</label>
                                        <input type="text" required class="form-control" id="nivel" name="nivel" placeholder="Informe o nível">
                                    </div>                               
                                </div>
                                <input type="hidden" name="action" id="action" />
                                <input type="hidden" name="hidden_id" id="hidden_id" />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success waves-effect text-left" id="action_button">Cadastrar</button>
                            <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal" id="close_modal">Cancelar</button>
                        </div>
                    </form>
                </div>                                                           
                    
            </div>
        </div>
    </div>
    <div class="modal fade ModalNivelDel" tabindex="-1" role="dialog" aria-labelledby="ModalNivelDel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">                        
                                        
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myLargeModalLabel">Deletar Nível</h4> 
                </div>
                <div class="modal-body">
                    <form enctype="multipart/form-data" id="FormDelNivel">  
                        <div class="white-box">
                            <h3 class="box-title m-b-0" id="msg_DelNivel">Deseja realmente excluir o nível selecionado?</h3>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success waves-effect text-left" id="action_button_del">Sim</button>
                            <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal" id="close_modal_del">Cancelar</button>
                        </div>
                    </form>
                </div>                                                           
                    
            </div>
        </div>
    </div>
</section>
@endsection
                                    