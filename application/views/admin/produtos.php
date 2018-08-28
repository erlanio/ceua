<section class="dashboard-header section-padding">
    <div class="container-fluid">

        <div class="card">
            <div class="card-header">
                <h4>Administrar Produtos</h4>
            </div>

            <div class="d-flex align-items-md-stretch">
                <button class="btn btn-primary offset-md-2 col-md-3" data-toggle="modal" data-target="#cadastro-produto"><i class="fa fa-plus"></i> Nova Produto</button>
                <button class="btn btn-info offset-md-1 col-md-3" id="atualizar-tabela-produtos"><i class="fa fa-refresh"></i> Atualizar Dados</button>
            </div>

            <div class="card-body col-md-12">
                <div class="align-items-md-stretch">
                    <table id="tabela-produtos" class="table-hover table-action">
                        <thead>
                            <tr>
                                <th>#ID</th>
                                <th>Nome</th>
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


<!--MODAL CADASTRO PRODUTO-->
<div id="cadastro-produto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">Cadastro Produto</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">


                <div id="retorno-salvar-produto"></div>
                <form method="post" action="<?php echo base_url('Produtos/salvar'); ?>" id="form-produto" onsubmit="return false" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Nome Produto</label>
                        <input type="text" placeholder="Nome do Produto" id="nome-produto" name="nome-produto" class="form-control">
                    </div>
                    <div class="form-group">       
                        <label>Descrição da Produto</label>
                        <input type="text" placeholder="Descrição do Produto" id="desc-produto" name="desc-produto" class="form-control">
                    </div>

                    <div class="form-group">     
                        <label>Categoria do Produto</label>
                        <select class="form-control" name="categoria-produto">
                            <?php foreach ($categorias as $categoria) { ?>
                                <option value="<?php echo $categoria->id_categoria; ?>"><?php echo $categoria->nome_categoria; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">   

                        <div id="retorno-imagem-produto"></div>
                        <label>Imagem da Produto</label>
                        <input type="file" id="img-produto" name="img-produto" placeholder="Descrição do Produto" id="imagem-produto" class="form-control">

                    </div>
                    <div class="form-group">       
                        <input type="submit" value="Salvar Produto" id="btn-salvar-produto" class="btn btn-primary col-md-12" disabled="">
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
<div id="editar-produto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">Editar Produto</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">


                <div id="retorno-edit-produtos"></div>
                <form method="post" action="<?php echo base_url('Produtos/update'); ?>" id="form-produto-update" onsubmit="return false" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Nome do Produto</label>
                        <input type="text" placeholder="Nome do Produto" id="nome-produto-edit" name="nome-produto-edit" class="form-control">
                    </div>
                    <div class="form-group">       
                        <label>Descrição do Produto</label>
                        <input type="text" placeholder="Descrição do Produto" id="desc-produto-edit" name="desc-produto-edit" class="form-control">
                    </div>

                    <div class="form-group">     
                        <label>Categoria do Produto</label>
                        <select class="form-control" name="categoria-produto-edit" id="categoria-produto-edit">
                            <?php foreach ($categorias as $categoria) { ?>
                                <option value="<?php echo $categoria->id_categoria; ?>"><?php echo $categoria->nome_categoria; ?></option>
                            <?php } ?>
                        </select>
                    </div>


                    <input type="hidden" id="id-produto-edit" name="id-produto-edit" value="">

                    <div class="form-group">  
                        Imagem Atual<br>
                        <img src="" id="img-edit" class="img-responsive col-md-2">
                        <input type="file" id="img-produto-edit" name="img-produto-edit">

                    </div>

                    <div class="form-group">                               
                        <input type="submit" id="btn-salvar-edicao-produto" onclick="salvarAlteracoesProduto();" value="Salvar Alterações" class="btn btn-info col-md-12">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-danger">Fechar</button>                
            </div>
        </div>
    </div>
</div>