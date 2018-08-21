$(document).ready(function () {
    $('#tabela-categorias').DataTable();
    $BASE_URL = "http://localhost/App_tabeliao/";


    $('#img-categoria').on('change', function () {

        var fr = new FileReader;

        fr.onload = function () {
            var img = new Image;

            img.onload = function () {

                if (img.width < 250 && this.height < 250) {
                    $('#retorno-imagem-categoria').addClass("alert alert-danger");
                    $('#retorno-imagem-categoria').html("Ops! A imagem deve conter as seguintes dimensões: <br> Largura: 250px<br>Altura: 250px;");
                } else {
                    $('#btn-salvar-categoria').removeClass('disabled');
//                    $('#form-categoria').ajaxForm({
//                        target: '#retorno-salvar-categoria' // o callback serÃ¡ no elemento com o id #visualizar
//                    }).submit();
                }
            };

            img.src = fr.result;
        };

        fr.readAsDataURL(this.files[0]);

    });



    $('#btn-salvar-categoria').click(function () {

        $nome_categoria = $('#nome-categoria').val();
        $desc_categoria = $('#desc-categoria').val();

        if ($nome_categoria == null || $desc_categoria == "") {            
            $('#retorno-salvar-categoria').addClass("alert alert-danger");
            $('#retorno-salvar-categoria').html("Ops! Preencha todos os dados para continuar!");
        } else {

            $.ajax({
                url: $BASE_URL + 'Categorias/salvar',
                type: 'POST',
                dataType: 'html',
                data: ({
                    'nome': $nome_categoria,
                    'desc': $desc_categoria,
                })

            }).done(function (data) {
                $('#retorno-salvar-categoria').html(data);

            });
        }

    })


});