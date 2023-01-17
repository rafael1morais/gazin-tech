
<section id="section-line-2">
    <div class="row">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-lg-5 col-sm-3 col-xs-12">
                    <div class="input-group">
                        <input type="text" id="dev_search" name="example-input1-group2" class="form-control" placeholder="Digite o Nível"> 
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
                    <button class="btn btn-block btn-outline btn-info" id="btn_acao_dev">Cadastrar Dev</button>
                    <button style="display: none;" class="btn btn-block btn-outline btn-info" data-toggle="modal" data-target=".ModalDevAdd" id="showModalDev"></button>
                    <button style="display: none;" class="btn btn-block btn-outline btn-info" data-toggle="modal" data-target=".ModalDevDel" id="showModalDelDev"></button>
                </div>
            </div>
            <div class="white-box">
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped">
                        <thead>
                            <tr>
                                <th style="width: 10%;">#</th>
                                <th style="width: 50%;">Nome</th>
                                <th style="width: 10%;">Sexo</th>
                                <th style="width: 15%;">Nível</th>
                                <th style="width: 15%;">Ações</th>
                            </tr>
                        </thead>
                        <tbody id="listagem_dev">
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>  
    
    <div class="modal fade ModalDevAdd" tabindex="-1" role="dialog" aria-labelledby="ModalDevAdd" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">                        
                                        
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="modalLabelDev">Cadastrar Desenvolvedor</h4> 
                </div>
                <div class="modal-body">
                    <form enctype="multipart/form-data" id="FormDev">  
                        <div class="white-box">
                            <h3 class="box-title m-b-0">Preencha os dados abaixo:</h3>
                            <div class="row" style="margin-top: 20px;">
                                <div class="col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="nivel">Nome</label>
                                        <input type="text" required class="form-control" id="nome" name="nome" placeholder="Informe o nome do Desenvolvedor">
                                    </div> 
                                    <div class="form-group" id="sexo_view">
                                        <label for="sexo">Sexo</label>
                                        <input type="text" class="form-control" id="sexo" placeholder="Informe o sexo do Desenvolvedor">
                                    </div>   
                                    <div class="form-group" id="sexo_select">
                                        <label for="nivel">Sexo</label>
                                        <div class="col-sm-12">
                                            <select class="custom-select col-12" name="sexo">
                                                <option value="F">Feminino</option>
                                                <option value="M">Masculino</option>
                                            </select>
                                        </div> 
                                    </div>   
                                    <div class="form-group" id="viewNivel">
                                        <label for="nnivel_devivel">Nível</label>
                                        <input type="text" class="form-control" id="nivel_dev" placeholder="Informe o nivel do Desenvolvedor">
                                    </div> 
                                    <div class="form-group" id="listaNivel">
                                        <label for="nivellist">Nível</label>
                                        <div class="col-sm-12">
                                            <select class="custom-select col-12" id="listNivel" name="nivel">
                                            </select>
                                        </div> 
                                    </div> 
                                    <div class="form-group">
                                        <label for="nivel">Data de Nascimento</label>
                                        <input type="text" required class="form-control" id="datanascimento" data-mask="9999-99-99" name="datanascimento" placeholder="Informe a data de nascimento do Desenvolvedor">
                                    </div>  
                                    <div class="form-group" id="inputIdade">
                                        <label for="nivel">Idade</label>
                                        <input type="text" class="form-control" id="idade" name="idade" placeholder="">
                                    </div>   
                                    <div class="form-group">
                                        <label for="nivel">Hobby</label>
                                        <input type="text" class="form-control" id="hobby" name="hobby" placeholder="Informe o Hobby do Desenvolvedor">
                                    </div>                            
                                </div>
                                <input type="hidden" name="action" id="action_dev" />
                                <input type="hidden" name="hidden_id" id="hidden_id_dev" />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success waves-effect text-left" id="action_button_dev">Cadastrar</button>
                            <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal" id="close_modal_dev">Cancelar</button>
                        </div>
                    </form>
                </div>                                                           
                    
            </div>
        </div>
    </div>
    <div class="modal fade ModalDevDel" tabindex="-1" role="dialog" aria-labelledby="ModalDevDel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">                        
                                        
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myLargeModalLabel">Deletar Desenvolvedor</h4> 
                </div>
                <div class="modal-body">
                    <form enctype="multipart/form-data" id="FormDelDev">  
                        <div class="white-box">
                            <h3 class="box-title m-b-0" id="msg_DelDev">Deseja realmente excluir o desenvolvedor selecionado?</h3>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success waves-effect text-left" id="action_button_del_dev">Sim</button>
                            <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal" id="close_modal_del_dev">Cancelar</button>
                        </div>
                    </form>
                </div>                                                           
                    
            </div>
        </div>
    </div>

</section>
                                    