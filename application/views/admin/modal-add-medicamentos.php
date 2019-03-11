<!--MODAL CADASTRO CATEGORIA-->
<div id="modal-medicamentos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">Adicionar Agente Químico</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <div id="form-medicamento" hidden="">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Fármaco:</label>
                            <input type="text" class="form-control" id="farmaco">
                        </div>

                        <div class="form-group col-md-6">
                            <label>Dose (UI ou mg/kg):</label>
                            <input type="text" class="form-control" id="dose">
                        </div>

                    </div>

                    <div class="row">

                        <div class="form-group col-md-4">
                            <label>Frequência:</label>
                            <input type="text" class="form-control" id="frequencia">
                            <input type="hidden" class="form-control" id="id_medicamento">
                        </div>

                        <div class="form-group col-md-4">
                            <label>Duração:</label>
                            <input type="text" class="form-control" id="duracao">
                        </div>

                        <div class="form-group col-md-4">
                            <label>Via de administração:</label>
                            <input type="text" class="form-control" id="via">
                        </div>

                    </div>


                    <button class="btn btn-success offset-1 col-md-4" id="salvar-medicamento">Salvar</button>
                    <button class="btn btn-warning offset-1 col-md-4" id="cancel-medicamento">Cancelar</button>
                    </form>
                </div>
                <div id="bloco-tabela-medicamentos">
                    <button class="btn btn-success offset-md-4 col-md-4" id="add-medicamento"><i class="fa fa-plus"></i> Adicionar Medicamento</button>
                    <div class="align-items-md-stretch col-md-12 tabelas">
                        <table id="tabela-medicamentos" class="table-hover table-action col-md-12">
                            <thead>
                                <tr>
                                    <th>#ID</th>                                
                                    <th>Fármaco</th>
                                    <th>Dose</th>
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