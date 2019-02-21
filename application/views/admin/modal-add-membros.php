
<!--MODAL CADASTRO CATEGORIA-->
<div id="cadastro-projeto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal modal-wide fade text-left">
    <div role="document" class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">Cadastro Projeto</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
               <form method="post" id="form-categoria" onsubmit="return false" enctype="multipart/form-data">

                    <div class="boxes">
                        <input type="checkbox" id="box-1">
                        <label for="box-1">Sou o responsável pela pesquisa</label>

                    </div>

                    <input type="hidden" id="id_usuario" value="<?php echo $this->session->userdata('usuario')->id_pessoa; ?>">

                      <div class="form-group">
                        <label>CPF:</label>
                        <input type="text" class="form-control" id="cpf_responsavel">
                    </div>
                    
                    <div class="form-group">
                        <label>Pesquisador Responsável (Pesquisador ou docente responsável):</label>
                        <input type="text" class="form-control" id="nome-responsavel">
                    </div>

                    <div class="form-group">
                        <label>Instituição:</label>
                        <input type="text" class="form-control" id="instituicao_responsavel">
                    </div>

                    <div class="form-group">
                        <label>Departamento:</label>
                        <input type="text" class="form-control" id="dpto_responsavel">
                    </div>

                  

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Telefone:</label>
                            <input type="text" class="form-control" id="telefone">
                        </div>



                        <div class="form-group col-md-6">
                            <label>Email:</label>
                            <input type="email" class="form-control" id="email_responsavel">
                        </div>

                        <div class="form-group col-md-12">
                            <label>Lattes:</label>
                            <input type="text" class="form-control" id="lattes_responsavel">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-3">
                            <label>Experiência Prévia:</label>
                            <select class="form-control selectpicker" id="experiencia-previa">
                                <option value="s" selected="">SIM</option>
                                <option value="n">NÃO</option>
                            </select> 
                        </div>
                        
                        <div class="form-group col-md-3">
                            <label>Quanto tempo? :</label>
                            <input type="text" class="form-control" id="xp-quanto-tempo">
                        </div>
                        
                        <div class="form-group col-md-3">
                            <label>Treinamento::</label>
                            <select class="form-control selectpicker" id="treinamento-previo">
                                <option value="s" selected="">SIM</option>
                                <option value="n">NÃO</option>
                            </select> 
                        </div>
                        
                        <div class="form-group col-md-3">
                            <label>Quanto tempo? :</label>
                            <input type="text" class="form-control" id="treinamento-quanto-tempo">
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label>Vínculo com a Instituição:</label>
                            <select class="form-control selectpicker" id="experiencia-previa">
                                
                                <?php
                                foreach ($vinculos as $vinculo) {
                                    $id = $vinculo->id_vinculo;
                                    $desc = $vinculo->desc_vinculo;

                                    echo "<option value='$id'>$desc</option>";
                                }
                                ?>
                            </select> 
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-danger">Fechar</button>                
            </div>
        </div>
    </div>
</div>