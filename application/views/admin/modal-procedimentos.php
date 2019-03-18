
<!--modal-add-animal-experimental-->
<div id="modal-procedimentos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal modal-wide fade text-left">
    <div role="document" class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">PROCEDIMENTOS EXPERIMENTAIS</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-md-12" id="bloco-select-restricao-alimentar">
                        <label>Restrição Alimentar:</label>
                        <select class="form-control selectpicker" id="select-restricao-alimentar">

                            <option value="n">NÃO</option>
                            <option value="s">SIM</option>

                        </select> 
                    </div>
                    <div class="form-group col-md-6" hidden="" id="bloco-duracao-alimentar">
                        <label>Duração: </label>
                        <input type="text" class="form-control" id="duracao-alimentar">
                    </div>                        
                </div>

                <div class="row">
                    <div class="form-group col-md-12" id="bloco-select-restricao-hidrica">
                        <label>Restrição Hídrica:</label>
                        <select class="form-control selectpicker" id="select-restricao-hidrica">

                            <option value="n">NÃO</option>
                            <option value="s">SIM</option>

                        </select> 
                    </div>
                    <div class="form-group col-md-6" hidden="" id="bloco-duracao-hidrica">
                        <label>Duração: </label>
                        <input type="text" class="form-control" id="duracao-hidrica">
                    </div>                        
                </div>

                <div class="row">
                    <div class="form-group col-md-12" id="bloco-select-imobilizacao">
                        <label>Imobilização do animal:</label>
                        <select class="form-control selectpicker" id="select-imobilizacao">

                            <option value="n">NÃO</option>
                            <option value="s">SIM</option>

                        </select> 
                    </div>
                    <div class="form-group col-md-6" hidden="" id="bloco-imobilizacao">
                        <label>Como: </label>
                        <input type="text" class="form-control" id="como-imobilizacao">
                    </div>                        
                </div>

                <div class="row">
                    <div class="form-group col-md-12" id="bloco-select-lesao">
                        <label>Lesão:</label>
                        <select class="form-control selectpicker" id="select-lesao">

                            <option value="n">NÃO</option>
                            <option value="s">SIM</option>

                        </select> 
                    </div>
                    <div class="form-group col-md-6" hidden="" id="bloco-lesao">
                        <label>Qual: </label>
                        <input type="text" class="form-control" id="como-lesao">
                    </div>                        
                </div>

                <div class="row">
                    <div class="form-group col-md-12" id="bloco-select-cirurgia">
                        <label>Cirurgia:</label>
                        <select class="form-control selectpicker" id="select-cirurgia">

                            <option value="n">NÃO</option>
                            <option value="s">SIM</option>

                        </select> 
                    </div>
                    <div class="form-group col-md-6" hidden="" id="bloco-cirurgia">
                        <label>Como: </label>
                        <input type="text" class="form-control" id="como-cirurgia">
                    </div>                        
                </div>

                <div class="row">
                    <div class="form-group col-md-12" id="bloco-select-anestesia">
                        <label>Anestesia:</label>
                        <select class="form-control selectpicker" id="select-anestesia">

                            <option value="n">NÃO</option>
                            <option value="s">SIM</option>

                        </select> 
                    </div>
                    <div class="form-group col-md-6" hidden="" id="bloco-anestesia">
                        <label>Como: </label>
                        <input type="text" class="form-control" id="como-anestesia">
                    </div>                        
                </div>

                <div class="row">
                    <div class="form-group col-md-12">
                        <label>Descreva os procedimentos:</label>
                        <textarea class="form-control" rows="4" id="procedimentos"></textarea>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-12" id="bloco-select-medicamentos">
                        <label>Agentes Químicos:</label>
                        <button class="btn btn-info" data-toggle="modal" data-target="#modal-medicamentos"><i class="fa fa-gear"></i> Gerenciar Agentes Químicos</button>
                        <mark>Medicamentos, Extrato, Analgésico, Anestésicos, etc</mark>
                    </div>                                                                
                </div>

                <div class="row">
                    <div class="form-group col-md-12" id="bloco-select-recuperacao">
                        <label>Recuperação pós-cirurgia :</label>
                        <select class="form-control selectpicker" id="select-recuperacao">

                            <option value="n">NÃO</option>
                            <option value="s">SIM</option>

                        </select> 
                    </div>
                    <div class="form-group col-md-6" hidden="" id="bloco-recuperacao">
                        <label>Duração: </label>
                        <input type="text" class="form-control" id="como-recuperacao">
                    </div>                        
                </div>

                <div class="row" id="procedimentos-recuperacao" >
                    <div class="form-group col-md-12">
                        <label>Outros procedimentos:</label>
                        <textarea class="form-control" rows="4" id="descricao-recuperacao"></textarea>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-12" id="bloco-select-extracao">
                        <label>Haverá extração de órgãos :</label>
                        <select class="form-control selectpicker" id="select-extracao">

                            <option value="n">NÃO</option>
                            <option value="s">SIM</option>

                        </select> 
                    </div>
                    <div class="form-group col-md-12" hidden="" id="bloco-extracao">
                        <label>Justifique: </label>
                        <textarea class="form-control" rows="4" id="como-extracao"></textarea>
                    </div>                        
                </div>

                <div class="form-group col-md-12">
                    <label>Experimento específico para: </label>

                    <div class="boxes row">
                        <div class="col-md-3">
                            <input type="checkbox" id="exp1">
                            <label for="exp1">Dor</label>
                        </div>
                        <div class="col-md-3">
                            <input type="checkbox" id="exp2">
                            <label for="exp2">Estresse </label>
                        </div>
                        <div class="col-md-3">
                            <input type="checkbox" id="exp3">
                            <label for="exp3">Anorexia </label>
                        </div>
                        <div class="col-md-3">
                            <input type="checkbox" id="exp4">
                            <label for="exp4">Outros </label>
                        </div>

                    </div>

                    <input type="text" class="form-control"  hidden="" placeholder="Informe Outros" id="outros-especifico">

                </div>

                <input type="text" id="id_procedimento"/>

                <button class="btn btn-success offset-md-4 col-md-4" id="btn-procedimento" onclick="salvarProcedimentos()">Salvar</button>


            </div>

            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-danger">Fechar</button>                
            </div>
        </div>
    </div>
</div>