<!--ANIMAIS-->
<div id="modal-especies" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal modal-wide fade text-left">
    <div role="document" class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">Espécies</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <div class="card-body col-md-12" id="bloco-tabela-especies">
                    <button class="btn btn-info offset-md-1 col-md-3" hidden="" id="atualizar-tabela-especies"><i class="fa fa-refresh"></i> Atualizar Dados</button>
                    <button class="btn btn-success offset-md-4 col-md-4" data-toggle="modal" data-target="#modal-add-animal-experimental"><i class="fa fa-plus"></i> Adicionar nova espécie</button>
                    <div class="align-items-md-stretch col-md-12 tabelas">
                        <table id="tabela-especies" class="table-hover table-action col-md-12">
                            <thead>
                                <tr>
                                    <th>#ID</th>                                
                                    <th>Espécie</th>
                                    <th>Criado por</th>
                                    <th>Data Cadastro</th>                                    
                                    <th>Opções</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-danger">Fechar</button>                
            </div>
        </div>
    </div>
</div>