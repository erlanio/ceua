<section class="dashboard-header section-padding">
    <div class="container-fluid">


        <div class="card">
            <div class="card-header">
                <h4>Administrar Marcas </h4>
            </div>

            <div class="d-flex align-items-md-stretch">
                <button class="btn btn-primary offset-md-2 col-md-3" data-toggle="modal" data-target="#cadastro-tamanhos"><i class="fa fa-plus"></i> Nova Tamanho</button>
                <button class="btn btn-info offset-md-1 col-md-3" id="atualizar-tabela-tamanhos"><i class="fa fa-refresh"></i> Atualizar Dados</button>
            </div>


            <div class="card-body col-md-12">
                <div class="align-items-md-stretch">
                    <table id="tabela-tamanhos" class="table-hover table-action tabela-marcas">
                        <thead>
                            <tr>
                                <th>#ID</th>                                
                                <th>Tamanho</th>                                
                                <th>Opções</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
</section>


<!--MODAL CADASTRO TAMANHOS-->
<div id="cadastro-tamanhos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">Cadastro Tamanhos</h5
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">

                <div id="retorno-salvar-marcas"></div>


                <div class="form-group">       
                    <label>Tamanho</label>
                    <input type="text" placeholder="EX: 1kg, 1lt, 2lt" id="tamanho-salvar" class="form-control">
                </div>


                <button class="btn btn-success col-md-12" id="btn-salvar-tamanho">Salvar Tamanho</button>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-danger">Fechar</button>                
            </div>
        </div>
    </div>
</div>



<!--MODAL EDITAR marcas-->
<div id="editar-marcas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">Editar Marcas</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <p>Editar marcas</p>  


                <div class="form-group">
                    <label>Alterar Tamanho</label>
                    <input type="text" placeholder="" id="nome-tamanho-edit" class="form-control">
                </div>
                <input type="hidden" id="id-tamanho-edit" name="id-marcas-edit" value="">



                <div class="form-group">                               
                    <button class="btn btn-success col-md-12" onclick="salvarAlteracoesTamanho()">Salvar Alterações</button>
                </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-danger">Fechar</button>                
            </div>
        </div>
    </div>
</div>
