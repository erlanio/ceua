<section class="dashboard-header section-padding">
    <div class="container-fluid">


        <div class="card">
            <div class="card-header">
                <h4>Administrar Supermercados </h4>
            </div>

            <div class="d-flex align-items-md-stretch">
                <button class="btn btn-primary offset-md-2 col-md-3" data-toggle="modal" data-target="#cadastro-supermercados"><i class="fa fa-plus"></i> Novo Supermercado</button>
                <button class="btn btn-info offset-md-1 col-md-3" id="atualizar-tabela-supermercados"><i class="fa fa-refresh"></i> Atualizar Dados</button>
            </div>


            <div class="card-body col-md-12">
                <div class="align-items-md-stretch">
                    <table id="tabela-supermercados" class="table-hover table-action tabela-marcas">
                        <thead>
                            <tr>
                                <th>#ID</th>                                
                                <th>Supermercado</th>                                
                                <th>Opções</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
</section>


<!--MODAL CADASTRO TAMANHOS-->
<div id="cadastro-supermercados" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade modal-wide text-left">
    <div role="document" class="modal-dialog modal-lg modal-wide">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">Cadastro Tamanhos</h5
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">

                <div id="retorno-salvar-supermercado"></div>


                <div class="form-group">       
                    <label>Nome do Supermercado</label>
                    <input type="text" id="nome-supermercado" class="form-control">
                </div>

                <div class="form-group">       
                    <label>Endereço do Supermercado</label>
                    <input type="text" id="endereco-supermercado" class="form-control">
                </div>

                <div class="form-group">       
                    <label>Telefone do Supermercado</label>
                    <input type="text" id="telefone-supermercado" class="form-control">
                </div>



                <div class="form-group">       
                    <label>Mapa</label>
                    <textarea class="form-control" rows="7" id="maps"></textarea>
                </div>


                <button class="btn btn-success col-md-12" id="btn-salvar-supermercado">Salvar Supermercado</button>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-danger">Fechar</button>                
            </div>
        </div>
    </div>
</div>



<!--MODAL EDITAR marcas-->
<!--MODAL CADASTRO TAMANHOS-->
<div id="editar-supermercados" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade modal-wide text-left">
    <div role="document" class="modal-dialog modal-lg modal-wide">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">Cadastro Tamanhos</h5
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">

                <div id="retorno-salvar-supermercado"></div>


                <div class="form-group">       
                    <label>Nome do Supermercado</label>
                    <input type="text" id="nome-supermercado-edit" class="form-control">
                </div>

                <div class="form-group">       
                    <label>Endereço do Supermercado</label>
                    <input type="text" id="endereco-supermercado-edit" class="form-control">
                </div>

                <div class="form-group">       
                    <label>Telefone do Supermercado</label>
                    <input type="text" id="telefone-supermercado-edit" class="form-control">
                </div>

                <input type="hidden" id="id-supermeracado-edit">

                <div class="form-group">       
                    <label>Mapa</label><br>
                    <button class="btn btn-info" id="btn-alterar-mapa">Alterar Mapa</button><br>
                    <div id="mapa-supermercado-frame" id="frame-maps" class="form-group mapa-supermercado-frame"></div>
                    <textarea class="form-control" hidden="" rows="7" id="maps-edit"></textarea>
                </div>
                <button class="btn btn-success col-md-12" onclick="salvarAlteracoesSupermercado()">Salvar Alterações</button>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-danger">Fechar</button>                
            </div>
        </div>
    </div>
</div>

