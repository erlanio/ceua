<div class="login-page">
    <div class="form">
        <div id="retorno-login"></div>

        <form class="register-form" onsubmit="return false">
            <input type="text" placeholder="Nome" id="nome" name="nome" required=""/>
            <input type="email" placeholder="Email" id="email" name="email" required=""/>
            <input type="password" placeholder="Senha" id="senha" name="senha" required=""/>
            <input type="text" id="cpf" name="cpf" placeholder="CPF" required=""/>
            <input type="text" placeholder="RG" id="rg" name="rg" required=""/>
            <input type="text" placeholder="Link Lattes" id="lattes" name="lattes" required=""/>
            <input type="text" placeholder="Telefone" id="telefone" name="telefone" required=""/>
            <input type="text" placeholder="Departamento" id="dpto" required=""/>
            <input type="text" placeholder="Instituicao" id="instituicao"  required=""/>
            <div class="form-group">
                <select class="form-control" id="estado" name="estado" required="">
                    <option>Estado</option>
                    <?php
                    foreach ($estados as $result) {
                        $id_estado = $result->id;
                        $sigla = $result->sigla;
                        echo "<option value='$id_estado'>$result->nome</option>";
                    }
                    ?>
                </select>                                     
            </div>

            <div class="form-group">
                <select class="form-control" id="cidades" name="cidades"  disabled>
                    <option>Cidade</option>
                </select>                                     
            </div>

            <input type="text" placeholder="Endereço" id="endereco" name="endereco"/>



            <button id="btn-cadastro">Criar Cadastro</button>
            <p class="message">Já tem cadastro? <a href="#" class="cadastro">Fazer Login</a></p>
        </form>
        <form class="login-form" onsubmit="return false">
            <input type="text" id="login-email" name="email" placeholder="Email"/>
            <input type="password" id="login-senha" name="senha" placeholder="Senha"/>
            <button id="btn-logar">login</button>
            <br><br>
            <button class="cadastro">Cadastre-se</button>
            <br><br>
            <button class="cadastro">Recuperar senha</button>
        </form>
    </div>
</div>

<script>



</script>