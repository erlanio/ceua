$BASE_URL = "http://localhost/ceua/";

$(document).ready(function () {

//    $('.accordion').find('.accordion-toggle').click(function () {
//        //Expand or collapse this panel
//        $(this).next().slideToggle(250);
//        //Hide the other panels
//        $('.accordion-content').not($(this).next()).slideUp(400);
//        //Turn the arrow
//        $('.arrow-open').removeClass('arrow-open');
//        $(this).find('.arrow').toggleClass('arrow-open');
//    });

    $("#experiencia-previa").change(function () {

        if ($('#experiencia-previa').val() == "n") {
            $('#xp-quanto-tempo').attr("disabled", "true");

        } else {
            $('#xp-quanto-tempo').removeAttr("disabled");
        }

    });

    $("#treinamento-previo").change(function () {

        if ($('#treinamento-previo').val() == "n") {
            $('#treinamento-quanto-tempo').attr("disabled", "true");

        } else {
            $('#treinamento-quanto-tempo').removeAttr("disabled");
        }

    });

    $('#box-1').click(function (e) {
        if ($("#box-1").is(':checked')) {
            $.ajax({
                url: $BASE_URL + 'Pessoa/buscar',
                type: 'POST',
                dataType: 'html',
                data: ({
                    'id_pessoa': $('#id_usuario').val(),
                })

            }).done(function (data) {
                var obj = JSON.parse(data);
                obj.forEach(function (o, index) {
                    $('#nome-responsavel').val(o.nome_pessoa);
                    $('#cpf_responsavel').val(o.cpf_pessoa);
                    $('#email_responsavel').val(o.email_pessoa);
                    $('#telefone').val(o.telefone);
                    $('#lattes_responsavel').val(o.lattes);
                    $('#instituicao_responsavel').val(o.instituicao);
                    $('#dpto_responsavel').val(o.departamento);

                });
            });
        } else {
            $('#nome-responsavel').val("");
            $('#cpf_responsavel').val("");
            $('#email_responsavel').val("");
            $('#telefone').val("");
            $('#lattes_responsavel').val("");
            $('#instituicao_responsavel').val("");
            $('#dpto_responsavel').val("");
        }



    })


    $("#finalidade").change(function () {

        finalidade = $('#finalidade').val();
        $.ajax({
            url: $BASE_URL + 'projeto/selectedSubFinalidade',
            type: 'POST',
            dataType: 'html',
            data: ({
                'id': finalidade,

            })

        }).done(function (data) {
            console.log(data);
            $('#titulo-acordion').hide();
            $("#subfinalidade").html(data).selectpicker('refresh');
        });

    });

    $("#finalidade").change(function () {

        subfinalidade = $('#finalidade').val();
        if (subfinalidade == 4) {
            $('#ext-form').show("slow");
        } else {
            $('#ext-form').hide("slow");
        }
    });



    $('#ext-form').hide("");



    $('#salvar-projeto').click(function () {
        titulo = $('#titulo').val();
        resumo = $('#resumo').val();
        objetivos = $('#objetivos').val();
        justificativa = $('#justificativa').val();
        relevancia = $('#relevancia').val();
        subarea = $('#subarea').val();
        subfinalidade = $('#subfinalidade').val();
        outras_finalidades = $('#outras_finalidades').val();
        dt_ini = $('#dt_ini').val();
        dt_fim = $('#dt_fim').val();

        if (titulo == "" || resumo == "" || objetivos == "" || justificativa == "" || relevancia == "" || subarea == "" || dt_ini == "" || dt_fim == "") {
            notify("Informe todos os dados para continuar!", "danger");



        } else {
            $.ajax({
                url: $BASE_URL + 'projeto/salvar',
                type: 'POST',
                dataType: 'html',
                data: ({
                    'titulo': titulo,
                    'resumo': resumo,
                    'objetivos': objetivos,
                    'justificativa': justificativa,
                    'relevancia': relevancia,
                    'subarea': subarea,
                    'subfinalidade': subfinalidade,
                    'outras_finalidades': outras_finalidades,
                    'dt_ini': dt_ini,
                    'dt_fim': dt_fim,

                })

            }).done(function (data) {
                notify("Dados salvos com sucesso!", "success");
                $('#titulo-projeto').hide();
                //Expand or collapse this panel
                $("#equipe").next().slideToggle(250);
                //Hide the other panels
                $('.accordion-content').not($("#equipe").next()).slideUp(400);
                //Turn the arrow
                $('.arrow-open').removeClass('arrow-open');
                $('#equipe').find('.arrow').toggleClass('arrow-open');
            });
        }


    })

    $("#cpf").inputmask({
        mask: ["999.999.999-99", ],
        keepStatic: true
    });
    $("#cpf_responsavel").inputmask({
        mask: ["999.999.999-99", ],
        keepStatic: true
    });

    $("#rg").inputmask({
        mask: ["9999999999-9", ],
        keepStatic: true
    });

    $("#telefone").inputmask({
        mask: ["(99)99999-9999", ],
        keepStatic: true
    });


    $(".modal-wide").on("show.bs.modal", function () {
        var height = $(window).height() - 200;
        $(this).find(".modal-body").css("max-height", height);
    });


    $('.cadastro').click(function () {
        $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
    });

    $('#estado').change(function () {
        var id_estado = $('#estado').val();
        $.post('http://localhost/ceua/Pessoa/getCidades', {id_estado: id_estado},
                function (data) {
                    $('#cidades').html(data);
                    $('#cidades').removeAttr('disabled');
                }
        )
    })

    $('#area').change(function () {
        var area = $('#area').val();
        $.post($BASE_URL + 'Projeto/selectedSubArea', {id: area},
                function (data) {
                    //  $('#model_select').selectpicker('refresh');
                    //$('#subarea').html(data);
                    $("#subarea").html(data).selectpicker('refresh');
                    // $('#subarea').removeAttr('disabled');
                    //  $('#subarea').addClass("selectpicker");
                }
        )
    })

    $('#btn-cadastro').click(function () {
        nome = $('#nome').val();
        email = $('#email').val();
        senha = $('#senha').val();
        cpf = $('#cpf').val();
        rg = $('#rg').val();
        estado = $('#estado').val();
        cidades = $('#cidades').val();
        endereco = $('#endereco').val();
        telefone = $('#telefone').val();
        lattes = $('#lattes').val();
        dpto = $('#dpto').val();
        instituicao = $('#instituicao').val();
        if (nome == "" || email == "" || senha == "" || cpf == "" || rg == "" || telefone == "" || lattes == "" || dpto == "" || instituicao == "") {
            $('#retorno-login').addClass("alert alert-danger");
            $('#retorno-login').html("Informe todos os dados para continuar!");
        } else {

            $.ajax({
                url: $BASE_URL + 'pessoa/salvar',
                type: 'POST',
                dataType: 'html',
                data: ({
                    'nome': nome,
                    'email': email,
                    'senha': senha,
                    'cpf': cpf,
                    'rg': rg,
                    'estado': estado,
                    'cidade': cidades,
                    'endereco': endereco,
                    'telefone': telefone,
                    'lattes': lattes,
                    'dpto': dpto,
                    'instituicao': instituicao
                })

            }).done(function (data) {
                $('#retorno-login').addClass("alert alert-success");
                $('#retorno-login').html(data);
                $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
            });

        }
    })

    $('#btn-logar').click(function () {
        email = $('#login-email').val();
        senha = $('#login-senha').val();

        if (email == "" || senha == "") {
            $('#retorno-login').addClass("alert alert-danger");
            $('#retorno-login').html("Informe todos os dados para continuar!");
        } else {
            $.ajax({
                url: $BASE_URL + 'Login/logar',
                type: 'POST',
                dataType: 'html',
                data: ({
                    'email': email,
                    'senha': senha,
                })

            }).done(function (data) {
                if (data == 2) {
                    $('#retorno-login').addClass("alert alert-danger");
                    $('#retorno-login').html("Email ou senha incorretos!");
                } else {
                    location.href = $BASE_URL + "Home";
                }

            });
        }
    })





});

// Fim dO READY

if (($("#tabela-categorias")).length) {


    var tabelaCategorias = $('#tabela-categorias').DataTable({
        "ajax": {

            url: $BASE_URL + 'Categorias/getcategorias',
            type: 'GET',

        },

        "language": {
            "sEmptyTable": "Nenhum registro encontrado",
            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
            "sInfoFiltered": "(Filtrados de _MAX_ registros)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "_MENU_ resultados por página",
            "sLoadingRecords": "Carregando...",
            "sProcessing": "Processando...",
            "sZeroRecords": "Nenhum registro encontrado",
            "sSearch": "Pesquisar",
            "oPaginate": {
                "sNext": "Próximo",
                "sPrevious": "Anterior",
                "sFirst": "Primeiro",
                "sLast": "Último"
            },
            "oAria": {
                "sSortAscending": ": Ordenar colunas de forma ascendente",
                "sSortDescending": ": Ordenar colunas de forma descendente"
            }
        }



    });

    tabelaCategorias.on('click', 'tr', function () {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            tabelaCategorias.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });

    $('#atualizar-tabela-categorias').click(function () {
        tabelaCategorias.ajax.reload();
    })





    $('#img-categoria').on('change', function () {

        var fr = new FileReader;

        fr.onload = function () {
            var img = new Image;

            img.onload = function () {

                if (img.width != 250 && this.height != 250) {
                    $('#retorno-imagem-categoria').addClass("alert alert-danger");
                    $('#retorno-imagem-categoria').html("Ops! A imagem deve conter as seguintes dimensões: <br> Largura: 250px<br>Altura: 250px;");
                } else {
                    $('#btn-salvar-categoria').removeAttr('disabled');

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
            $('#form-categoria').ajaxForm({
                target: '#retorno-salvar-categoria' // o callback serÃ¡ no elemento com o id #visualizar
            }).submit();
            $('#atualizar-tabela-categorias').click();
            $('#nome-categoria').val("");
            $('#desc-categoria').val("");
            $('#img-categoria').val("");

            notify("Salvo com sucesso!", "success");
        }

    })

}






function notify($mensagem, $tipo) {
    $.notify({
        title: "<strong>Atenção: </strong>",
        icon: 'glyphicon glyphicon-warning-sign',
        message: $mensagem,
        position: "top"
    }, {
        type: $tipo,
        animate: {
            enter: 'animated rollIn',
            exit: 'animated rollOut'
        },
        placement: {
            from: "bottom",
            align: "right"
        },
        offset: 50,
        spacing: 10,
        z_index: 9999,
    });

}

