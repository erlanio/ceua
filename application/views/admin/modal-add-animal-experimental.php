
<!--modal-add-animal-experimental-->
<div id="modal-add-animal-experimental" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal modal-wide fade text-left">
    <div role="document" class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">Informações sobre o Modelo Animal Experimental</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <form method="post" id="form-categoria" onsubmit="return false" enctype="multipart/form-data">


                    <div class="row">
                        <div class="form-group col-md-4" id="select-especie">
                            <label>Papel do membro:</label>
                            <select class="form-control selectpicker" data-live-search="true" id="especie">
                                <option value="selecione">Selecione...</option>
                                <?php
                                foreach ($especies as $especie) {
                                    $id = $especie->id_especie;
                                    $desc = $especie->nome_especie;
                                    echo "<option value='$id'>$desc</option>";
                                }
                                ?>
                            </select> 
                        </div>
                        <div class="form-group col-md-4">
                            <label>Linhagem: </label>
                            <input type="text" class="form-control" id="linhagem">
                        </div>

                        <div class="form-group col-md-2">
                            <label>Idade: </label>
                            <input type="number" class="form-control" id="idade">
                        </div>
                        
                        <div class="form-group col-md-2">
                            <label>Peso (g): </label>
                            <input type="text" class="form-control" id="peso">
                        </div>
                    </div>

                    <div class="row">





                        <div class="form-group col-md-3">
                            <label>Nº Animais Por Grupo: </label>
                            <input type="text" class="form-control" id="animais-por-grupo">
                        </div>

                        <div class="form-group col-md-3">
                            <label>Nº. Grupos: </label>
                            <input type="text" class="form-control" id="num-grupos">
                        </div>

                        <div class="form-group col-md-2">
                            <label>Qtd Masc: </label>
                            <input type="text" class="form-control" id="qtdM" onblur="calcularTotal();">
                        </div>

                        <div class="form-group col-md-2">
                            <label>Qtd Fem: </label>
                            <input type="text" class="form-control" id="qtdF" onblur="calcularTotal();">
                        </div>
                        <div class="form-group col-md-2">
                            <label>Total: </label>
                            <input type="text" class="form-control" disabled="" id="total">
                        </div>
                    </div>



                    <button class="btn btn-success offset-4 col-md-4" id="salvar-equipe">Salvar Equipe</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-danger">Fechar</button>                
            </div>
        </div>
    </div>
</div>