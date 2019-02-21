
<!--MODAL CADASTRO CATEGORIA-->
<div id="cadastro-projeto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal modal-wide fade text-left">
    <div role="document" class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">Cadastrar Membros</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <form method="post" id="form-categoria" onsubmit="return false" enctype="multipart/form-data">

                    <div class="boxes">
                        <input type="checkbox" id="box-1">
                        <label for="box-1">Sou o responsável pela pesquisa</label>

                    </div>

                    <input type="hidden" id="id_usuario" value="<?php echo $this->session->userdata('usuario')->id_pessoa; ?>">

                    <div class="form-group">
                        <label>CPF:</label>
                        <input type="text" class="form-control" id="cpf_responsavel" maxlength="11">
                    </div>

                    <div class="form-group">
                        <label>Pesquisador Responsável (Pesquisador ou docente responsável):</label>
                        <input type="text" class="form-control" id="nome-responsavel">
                    </div>

                    <div class="form-group">
                        <label>Instituição:</label>
                        <input type="text" class="form-control" id="instituicao_responsavel">
                    </div>

                    <div class="form-group">
                        <label>Departamento:</label>
                        <input type="text" class="form-control" id="dpto_responsavel">
                    </div>



                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Telefone:</label>
                            <input type="text" class="form-control" id="telefone">
                        </div>



                        <div class="form-group col-md-6">
                            <label>Email:</label>
                            <input type="email" class="form-control" id="email_responsavel">
                        </div>

                        <div class="form-group col-md-12">
                            <label>Lattes:</label>
                            <input type="text" class="form-control" id="lattes_responsavel">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-3">
                            <label>Experiência Prévia:</label>
                            <select class="form-control selectpicker" id="experiencia-previa">
                                <option value="s" selected="">SIM</option>
                                <option value="n">NÃO</option>
                            </select> 
                        </div>

                        <div class="form-group col-md-3">
                            <label>Quanto tempo? :</label>
                            <input type="text" class="form-control" id="xp-quanto-tempo">
                        </div>

                        <div class="form-group col-md-3">
                            <label>Treinamento::</label>
                            <select class="form-control selectpicker" id="treinamento-previo">
                                <option value="s" selected="">SIM</option>
                                <option value="n">NÃO</option>
                            </select> 
                        </div>

                        <div class="form-group col-md-3">
                            <label>Quanto tempo? :</label>
                            <input type="text" class="form-control" id="treinamento-quanto-tempo">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-12" id="select-vinculo">
                            <label>Vínculo com a Instituição:</label>
                            <select class="form-control selectpicker" id="vinculo">

                                <?php
                                foreach ($vinculos as $vinculo) {
                                    $id = $vinculo->id_vinculo;
                                    $desc = $vinculo->desc_vinculo;

                                    echo "<option value='$id'>$desc</option>";
                                }
                                ?>
                            </select> 
                        </div>
                        <div class="form-group col-md-6" id="vinculo-outros">
                            <label>Informe qual seu vínculo: </label>
                            
                            <input type="text" class="form-control" id="vinculo-form">
                        </div>
                    </div>
                    <pre class='xdebug-var-dump' dir='ltr'>
<small>C:\wamp64\www\ceua\application\controllers\Pessoa.php:87:</small>
<b>array</b> <i>(size=12)</i>
  'nome_pessoa' <font color='#888a85'>=&gt;</font> <small>string</small> <font color='#cc0000'>'ERLANIO FREIRE BARROS'</font> <i>(length=21)</i>
  'telefone' <font color='#888a85'>=&gt;</font> <small>string</small> <font color='#cc0000'>'88996042686'</font> <i>(length=11)</i>
  'cpf_pessoa' <font color='#888a85'>=&gt;</font> <small>string</small> <font color='#cc0000'>'07172603303'</font> <i>(length=11)</i>
  'email_pessoa' <font color='#888a85'>=&gt;</font> <small>string</small> <font color='#cc0000'>'erlanio.freire@urca.br'</font> <i>(length=22)</i>
  'lattes' <font color='#888a85'>=&gt;</font> <small>string</small> <font color='#cc0000'>'$data[&#39;lattes&#39;] = $this-&gt;input-&gt;post(&#39;lattes&#39;);'</font> <i>(length=47)</i>
  'departamento' <font color='#888a85'>=&gt;</font> <small>string</small> <font color='#cc0000'>'DTI'</font> <i>(length=3)</i>
  'instituicao' <font color='#888a85'>=&gt;</font> <small>string</small> <font color='#cc0000'>'UNIVERSIDADE REGIONAL DO CARIRI '</font> <i>(length=32)</i>
  'xp_previa' <font color='#888a85'>=&gt;</font> <small>string</small> <font color='#cc0000'>'S'</font> <i>(length=1)</i>
  'qt_tmpo_previa' <font color='#888a85'>=&gt;</font> <small>string</small> <font color='#cc0000'>''</font> <i>(length=0)</i>
  'treinamento' <font color='#888a85'>=&gt;</font> <small>string</small> <font color='#cc0000'>'S'</font> <i>(length=1)</i>
  'qt_tmpo_treinamento' <font color='#888a85'>=&gt;</font> <small>string</small> <font color='#cc0000'>''</font> <i>(length=0)</i>
  'outros' <font color='#888a85'>=&gt;</font> <small>string</small> <font color='#cc0000'>''</font> <i>(length=0)</i>
</pre>
                     <button class="btn btn-success offset-4 col-md-4" id="salvar-equipe">Salvar Equipe</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-danger">Fechar</button>                
            </div>
        </div>
    </div>
</div>