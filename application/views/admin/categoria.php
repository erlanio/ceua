<section class="dashboard-header section-padding">
    <div class="container-fluid">
      
        <button id="atualizar-tabela-categorias" hidden="">atualizar</button>
       
        <div class="card">
            <div class="card-header">
                <h4>Administrar Categorias</h4>
            </div>
            
             <div class="d-flex align-items-md-stretch">
            <button class="btn btn-primary col-md-3" data-toggle="modal" data-target="#cadastro-categoria"><i class="fa fa-plus"></i> Nova Categoria</button>
        </div>

            
            <div class="card-body col-md-12">
                <div class="align-items-md-stretch">
                    <table id="tabela-categorias" class="table-hover table-action tabela-categorias">
                        <thead>
                            <tr>
                                <th>#ID</th>                                
                                <th>Categoria</th>
                                <th>Descrição</th>
                                <th>Opções</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
</section>


<!--MODAL CADASTRO CATEGORIA-->
<div id="cadastro-categoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">Cadastro Categoria</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <p>Cadastrar Categoria</p>

                <div id="retorno-salvar-categoria"></div>
                <form method="post" action="<?php echo base_url('Categorias/salvar'); ?>" id="form-categoria" onsubmit="return false" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Nome Categoria</label>
                        <input type="text" placeholder="Nome da Categoria" id="nome-categoria" name="nome-categoria" class="form-control">
                    </div>
                    <div class="form-group">       
                        <label>Descrição da Categoria</label>
                        <input type="text" placeholder="Descrição da Categoria" id="desc-categoria" name="desc-categoria" class="form-control">
                    </div>

                    <div class="form-group">   

                        <div id="retorno-imagem-categoria"></div>
                        <label>Imagem da Categoria</label>
                        <input type="file" id="img-categoria" name="img-categoria" placeholder="Descrição da Categoria" id="imagem-categoria" class="form-control">

                    </div>
                    <div class="form-group">       
                        <input type="submit" value="Salvar Categoria" id="btn-salvar-categoria" class="btn btn-primary col-md-12" disabled="">
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-danger">Fechar</button>                
            </div>
        </div>
    </div>
</div>



<!--MODAL EDITAR CATEGORIA-->
<div id="editar-categoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">Editar Categoria</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <p>Editar Categoria</p>  
                
                <div id="retorno-edit-categorias"></div>
                <form method="post" action="<?php echo base_url('Categorias/update'); ?>" id="form-categoria-update" onsubmit="return false" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Nome Categoria</label>
                        <input type="text" placeholder="Nome da Categoria" id="nome-categoria-edit" name="nome-categoria-edit" class="form-control">
                    </div>
                    <div class="form-group">       
                        <label>Descrição da Categoria</label>
                        <input type="text" placeholder="Descrição da Categoria" id="desc-categoria-edit" name="desc-categoria-edit" class="form-control">
                    </div>

                    <input type="hidden" id="id-categoria-edit" name="id-categoria-edit" value="">

                    <div class="form-group">  
                        Imagem Atual<br>
                        <img src="" id="img-edit" class="img-responsive col-md-2">
                        <input type="file" id="img-categoria-edit" name="img-categoria-edit">

                    </div>

                    <div class="form-group">                               
                        <input type="submit" id="btn-salvar-edicao" onclick="salvarAlteracoesCategoria();" value="Salvar Alterações" class="btn btn-info col-md-12">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-danger">Fechar</button>                
            </div>
        </div>
    </div>
</div>