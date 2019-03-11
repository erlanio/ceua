
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
                        <div class="form-group col-md-12" id="select-especie">
                            <label>Espécie:</label>
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
                    </div>
                    <div class=" row col-md-12"id="dados-especie">
                        <div class="form-group col-md-3">
                            <label>Linhagem: </label>
                            <input type="text" class="form-control" id="linhagem">
                        </div>

                        <div class="form-group col-md-3">
                            <label>Idade: </label>
                            <input type="number" class="form-control" id="idade">
                        </div>

                        <div class="form-group col-md-3">
                            <label>Peso (g): </label>
                            <input type="text" class="form-control" id="peso">
                        </div>


                        <div class="form-group col-md-3">
                            <label>Nº Animais Por Grupo: </label>
                            <input type="text" class="form-control" id="animais-por-grupo">
                        </div>


                        <div class="form-group col-md-3">
                            <label>Nº. Grupos: </label>
                            <input type="text" class="form-control" id="num-grupos">
                        </div>

                        <div class="form-group col-md-3">
                            <label>Qtd Masc: </label>
                            <input type="text" class="form-control" id="qtdM" onblur="calcularTotal();">
                        </div>

                        <div class="form-group col-md-3">
                            <label>Qtd Fem: </label>
                            <input type="text" class="form-control" id="qtdF" onblur="calcularTotal();">
                        </div>

                        <div class="form-group col-md-3">
                            <label>Total: </label>
                            <input type="text" class="form-control" disabled="" id="total">
                        </div>


                    </div>

                </form>
                <hr>

                <div class="form-group col-md-12">
                    <label>Qual o critério utilizado para definir a amostra, e qual o planejamento estatístico: </label>
                    <input type="text" class="form-control" id="criterio">
                </div>

                <hr>
                <div class="form-group col-md-12">
                    <label>Procedência: </label>

                    <div class="boxes row">
                        <div class="col-md-4">
                            <input type="checkbox" id="proc1">
                            <label for="proc1">Biotério de criação</label>
                        </div>

                        <div class="col-md-4">
                            <input type="checkbox" id="proc2">
                            <label for="proc2">Estabelecimentos comerciais</label>
                        </div> 

                        <div class="col-md-4">
                            <input type="checkbox" id="proc3">
                            <label for="proc3">Animal selvagem* </label>
                        </div>

                        <div class="col-md-4">
                            <input type="checkbox" id="proc4">
                            <label for="proc4">Animal doméstico</label>
                        </div>

                        <div class="col-md-4">
                            <input type="checkbox" id="proc5">
                            <label for="proc5">Outros</label>
                        </div>
                    </div>
                </div>

                <div class="form-group col-md-12" hidden="" id="num-protoco-sisbio">
                    <label>Número de protocolo SISBIO: </label>
                    <input type="text" class="form-control" id="sisbio">
                </div>

                <div class="form-group col-md-12" hidden="" id="metodo-captura">
                    <label>Métodos de Captura : </label>
                    <input type="text" class="form-control" id="captura">
                </div>
                <input type="hidden" id="editando" value="n">
                <input type="hidden" id="id_modelo_animal" value="">

                <div class="form-group col-md-12" hidden="" id="outro-procedimento-bloco">
                    <label>Qual?: </label>
                    <input type="text" class="form-control" id="qualprocedimento">
                </div>

                <div class="form-group col-md-12">
                    <div class="boxes row">
                        <div class="col-md-4">
                            <input type="checkbox" id="modificado">
                            <label for="modificado">O animal é geneticamente modificado?</label>
                        </div>

                        <div class="col-md-6" id="bloco-qual-notificacao" hidden="">
                            <input type="text" class="form-control" id="numctnbio" placeholder="Número de protocolo CTNBio">
                        </div>
                    </div>
                </div>
                <hr>
                <div class="col-md-12 row">
                    <div class="form-group col-md-4" id="select-especie">
                        <label>Aproveitamento dos Animais:</label>
                        <select class="form-control selectpicker" data-live-search="true" id="aproveitamento">
                            <option value="s">SIM</option>
                            <option value="n">NÃO</option>                                                        
                        </select> 
                    </div>

                    <div class="col-md-6" id="como">
                        <label>Como:</label>
                        <input type="text" class="form-control" id="qualaproveitamento" placeholder="Como">
                    </div>
                </div>
                <hr>
                <div class="col-md-12 row">
                    <div class="col-md-12">
                        <label>Número de Animais/Parcela Experimental (Gaiola, Viveiro, Aquário, etc.) Descrever o manejo (ambiente, forração, Lotação - Número de animais/área, Exaustão do ar: sim ou não, Local onde será mantido o animal etc.):</label>
                        <textarea class="form-control" rows="4" id="manejo"></textarea>

                    </div>
                </div><br>
                <hr>
                <div class="row col-md-12">
                    <div class="form-group col-md-2">
                        <label>Água:</label>
                        <select class="form-control selectpicker" data-live-search="true" id="agua">
                            <option value="n">Natural</option>
                            <option value="f">Filtrada</option>                                                        
                            <option value="a">Autoclavada</option>                                                        
                            <option value="c">Clorada </option>                                                        
                        </select> 
                    </div>

                    <div class="col-md-3">
                        <label>Ração Comercial:</label>
                        <select class="form-control selectpicker" data-live-search="true" id="racao-comercial">
                            <option value="s" selected="">Sim</option>
                            <option value="n">Não</option>                                                                                    
                        </select> 
                    </div>

                    <div class="col-md-7" id="qual-racao">
                        <label>Qual:</label>
                        <input type="text" class="form-control" id="qualracao">
                    </div>

                    <div class="col-md-7" id="racao-especial-bloco" hidden="">
                        <label>Especial:</label>
                        <input type="text" class="form-control" id="racaoespecial">
                    </div>

                    <button class="btn btn-success offset-md-4 col-md-4" onclick="salvarAnimal()">Salvar</button>

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-danger">Fechar</button>                
            </div>
        </div>
    </div>
</div>