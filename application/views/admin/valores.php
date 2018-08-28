<section class="dashboard-header section-padding">
    <div class="container-fluid">

        <div class="card">
            <div class="card-header">
                <h4>Administrar Valores</h4>
            </div>

            <div class="d-flex align-items-md-stretch">
                <button class="btn btn-primary offset-md-2 col-md-3" data-toggle="modal" data-target="#cadastro-preco"><i class="fa fa-plus"></i> Nova Preço</button>
                <button class="btn btn-info offset-md-1 col-md-3" id="atualizar-tabela-valores"><i class="fa fa-refresh"></i> Atualizar Dados</button>
            </div>


            <div class="card-body col-md-12">
                <div class="card-body col-md-12">
                    <div class="align-items-md-stretch">
                        <table id="tabela-valores" class="table-hover table-action tabela-marcas">
                            <thead>
                                <tr>
                                    <th>#ID</th>                                

                                    <th>Categoria</th>
                                    <th>Produto</th>
                                    <th>Marca</th>
                                    <th>Tamanho</th>
                                    <th>Valor</th>
                                    <th>Supermercado</th>
                                    <th>Opções</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            </section>


            <!--MODAL CADASTRO PRODUTO-->
            <div id="cadastro-preco" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                <div role="document" class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 id="exampleModalLabel" class="modal-title">Cadastro Produto</h5>
                            <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body">

                             <div class="form-group ">     
                                <label>Selecione um Categoria:</label>
                                <select class="selectpicker col-md-12" data-live-search="true" id="categoria">
                                    <?php foreach ($categorias as $categoria) { ?>                    
                                    <option value="<?php echo $categoria->id_categoria; ?>"><?php echo $categoria->nome_categoria; ?></option>
                                    <?php } ?>

                                </select>
                            </div>
                            
                            
                            <div class="form-group ">     
                                <label>Selecione um Supermercado:</label>
                                <select class="selectpicker col-md-12" data-live-search="true" id="supermercado">
                                    <?php foreach ($supermercados as $supermercado) { ?>                    
                                    <option value="<?php echo $supermercado->id_supermercado; ?>"><?php echo $supermercado->nome_supermercado; ?></option>
                                    <?php } ?>

                                </select>
                            </div>

                            <div class="form-group ">     
                                <label>Selecione um Tamanho:</label>
                                <select class="selectpicker col-md-12" data-live-search="true" id="tamanho">
                                    <?php foreach ($tamanhos as $tamanho) { ?>                    
                                        <option value="<?php echo $tamanho->id_tamanho; ?>"><?php echo $tamanho->desc_tamanho; ?></option>
                                    <?php } ?>

                                </select>
                            </div>


                            <div class="form-group ">     
                                <label>Selecione uma Marca:</label>
                                <select class="selectpicker col-md-12" data-live-search="true" id="marca">

                                    <?php foreach ($marcas as $marca) {
                                        ?>                    
                                        <option value="<?php echo $marca->id_marca; ?>"><?php echo $marca->nome_marca; ?></option>
                                    <?php } ?>

                                </select>
                            </div>

                            <div class="form-group ">     
                                <label>Selecione um Produto:</label>
                                <select class="selectpicker col-md-12" data-live-search="true" id="produto">

                                    <?php foreach ($produtos as $produto) {
                                        ?>                    
                                        <option value="<?php echo $produto->id_produto; ?>"><?php echo $produto->nome_produto; ?></option>
                                    <?php } ?>

                                </select>
                            </div>

                            <div class="form-group">
                                <label col-md-1>Preço do Produto</label>
                                <input type="text" placeholder="5,50" id="preco-produto" name="nome-produto-edit" class="col-md-4">
                            </div>
                            
                            <div class="col-md-12"><button class="btn btn-success col-md-12" onclick="salvarValores()">Salvar Valor</button></div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" data-dismiss="modal" class="btn btn-danger">Fechar</button>                
                        </div>
                    </div>
                </div>
            </div>



            <!--MODAL EDITAR CATEGORIA-->

            <!--MODAL CADASTRO PRODUTO-->
            <div id="editar-protudos-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                <div role="document" class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 id="exampleModalLabel" class="modal-title">Cadastro Produto</h5>
                            <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body">

                            <div class="form-group ">     
                                <label>Selecione um Supermercado:</label>
                                <select class="selectpicker col-md-12" data-live-search="true" name="id-supermercado" id="supermercado-edit">
                                    <?php foreach ($supermercados as $supermercado) { ?>                    
                                    <option value="<?php echo $supermercado->id_supermercado; ?>"><?php echo $supermercado->nome_supermercado; ?></option>
                                    <?php } ?>

                                </select>
                            </div>

                            <div class="form-group ">     
                                <label>Selecione um Tamanho:</label>
                                <select class="selectpicker col-md-12" data-live-search="true" name="tamanho-edit" id="tamanho-edit">
                                    <?php foreach ($tamanhos as $tamanho) { ?>                    
                                        <option value="<?php echo $tamanho->id_tamanho; ?>"><?php echo $tamanho->desc_tamanho; ?></option>
                                    <?php } ?>

                                </select>
                            </div>

                            <input type="hidden" id="id-valor-edit">
                            <div class="form-group ">     
                                <label>Selecione uma Marca:</label>
                                <select class="selectpicker col-md-12" data-live-search="true" name="marca-edit" id="marca-edit">

                                    <?php foreach ($marcas as $marca) {
                                        ?>                    
                                        <option value="<?php echo $marca->id_marca; ?>"><?php echo $marca->nome_marca; ?></option>
                                    <?php } ?>

                                </select>
                            </div>

                            <div class="form-group ">     
                                <label>Selecione um Produto:</label>
                                <select class="selectpicker col-md-12" name="produto-edit" data-live-search="true" id="produto-edit">

                                    <?php foreach ($produtos as $produto) {
                                        ?>                    
                                        <option value="<?php echo $produto->id_produto; ?>"><?php echo $produto->nome_produto; ?></option>
                                    <?php } ?>

                                </select>
                            </div>

                            <div class="form-group">
                                <label col-md-1>Preço do Produto</label>
                                <input type="text" placeholder="5,50" id="preco-produto-edit" name="nome-produto-edit" class="col-md-4">
                            </div>
                            
                            <div class="col-md-12"><button class="btn btn-success col-md-12" onclick="salvarAlteracoesValores()">Salvar Alterações</button></div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" data-dismiss="modal" class="btn btn-danger">Fechar</button>                
                        </div>
                    </div>
                </div>
            </div>

