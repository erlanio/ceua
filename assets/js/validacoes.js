$BASE_URL = "http://localhost/ceua/";

$(document).ready(function () {
    tabelaProjetos();
    criaTabelaMembros();

    //ACORDION
    $('.accordion').find('.accordion-toggle').click(function () {
        //Expand or collapse this panel
        $(this).next().slideToggle(250);
        //Hide the other panels
        $('.accordion-content').not($(this).next()).slideUp(400);
        //Turn the arrow
        $('.arrow-open').removeClass('arrow-open');
        $(this).find('.arrow').toggleClass('arrow-open');
    });

    $('#vinculo-outros').hide();


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
            $("#vinculo").val(1).selectpicker('refresh');
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
                    $('#id_usuario').val(o.id_pessoa);
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
            $("#vinculo").val("selecione").selectpicker('refresh');
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

                $('#atualizar-tabela-projetos').click();

            });
        }


    })

    $("#cpf").inputmask({
        mask: ["999.999.999-99", ],
        keepStatic: true
    });

//MASCARA MODELO ANIMAL EXPERIMENTO
    $('#peso').mask('#.##0', {reverse: true});
    $('#idade').mask('0000', {reverse: true});
    $('#animais-por-grupo').mask('0000', {reverse: true});
    $('#num-grupos').mask('0000', {reverse: true});
    $('#qtdM').mask('0000', {reverse: true});
    $('#qtdF').mask('0000', {reverse: true});
    $('#total').mask('0000', {reverse: true});



//MODELO ANIMAL EXPERIMENTO


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

    $("#vinculo").change(function () {
        if ($('#vinculo').val() == 9) {
            $('#vinculo-outros').show('slow');
            $('#select-vinculo').removeClass("col-md-12");
            $('#select-vinculo').addClass('col-md-6')
        } else {
            $('#vinculo-outros').hide('slow');
            $('#select-vinculo').addClass("col-md-12");
            $('#select-vinculo').removeClass('col-md-6')
        }

    });


    $('#membros').click(function () {
        $('#bloco-tabela-membros').attr("hidden", false);
        $('#tabela-membros').css("width", '100%');
    })


    $('#salvar-equipe').click(function () {
        cpf = $('#cpf_responsavel').val()
        nome = $('#nome-responsavel').val()
        instituicao = $('#instituicao_responsavel').val()
        dpto = $('#dpto_responsavel').val()
        telefone = $('#telefone').val()
        email = $('#email_responsavel').val()
        xptmpo = $('#xp-quanto-tempo').val()
        experiencia_previa = $('#experiencia-previa').val()
        lattes = $('#lattes_responsavel').val()
        treinamento = $('#treinamento-previo').val()
        treiqtotmpo = $('#treinamento-quanto-tempo').val()
        vinculo = $('#vinculo').val()
        outros_vinculo = $('#vinculo-form').val()
        id_usuario = $('#id_usuario').val();
        id_projeto = $('#id_projeto').val();
        if (cpf == "" || nome == "" || dpto == "" || instituicao == "" || telefone == "" || email == "" || experiencia_previa == "" || lattes == "" || treinamento == "" || vinculo == "selecione") {
            notify("Informe todos os dados para continuar!", "danger");
        } else {

            $.ajax({
                url: $BASE_URL + 'pessoa/salvarMembro',
                type: 'POST',
                dataType: 'html',
                data: ({
                    'nome': nome,
                    'email': email,
                    'cpf': cpf,
                    'telefone': telefone,
                    'lattes': lattes,
                    'dpto': dpto,
                    'instituicao': instituicao,
                    'experiencia_previa': experiencia_previa,
                    'xptmpo': xptmpo,
                    'treinamento': treinamento,
                    'treiqtotmpo': treiqtotmpo,
                    'outros_vinculo': outros_vinculo,
                    'id_pessoa': id_usuario,
                    'vinculo': vinculo,
                    'id_projeto': id_projeto,

                })

            }).done(function (data) {
                console.log(data);
                if (data == 1) {
                    notify("Membro adicionado com sucesso!", 'success');
                    $('#atualizar-tabela-membros').click();
                    cpf = $('#cpf_responsavel').val("")
                    nome = $('#nome-responsavel').val("")
                    instituicao = $('#instituicao_responsavel').val("")
                    dpto = $('#dpto_responsavel').val("")
                    telefone = $('#telefone').val("")
                    email = $('#email_responsavel').val("")
                    xptmpo = $('#xp-quanto-tempo').val("")
                    lattes = $('#lattes_responsavel').val("")

                    treiqtotmpo = $('#treinamento-quanto-tempo').val("")
                    vinculo = $('#vinculo').val("selecione")
                    outros_vinculo = $('#vinculo-form').val("")
                    id_usuario = $('#id_usuario').val();
                    id_projeto = $('#id_projeto').val();

                    $("#box-1").prop("checked", false);
                    atualizarNumMembros("+");
                } else {
                    notify("Essa pessoa já faz parte deste projeto!", 'danger');
                }

            });
        }



    })


    $('#cpf_responsavel').keyup(function () {
        $tamanho = $('#cpf_responsavel').val().length;

        if ($tamanho == 11) {

            $cpf = $('#cpf_responsavel').val();

            $.ajax({
                url: $BASE_URL + 'pessoa/buscarCPF',
                type: 'POST',
                dataType: 'html',
                data: ({
                    'cpf': $cpf,
                })

            }).done(function (data) {
                var obj = JSON.parse(data);
                obj.forEach(function (o, index) {
                    $('#id_usuario').val(o.id_pessoa);
                    $('#nome-responsavel').val(o.nome_pessoa);
                    $('#cpf_responsavel').val(o.cpf_pessoa);
                    $('#email_responsavel').val(o.email_pessoa);
                    $('#telefone').val(o.telefone);
                    $('#lattes_responsavel').val(o.lattes);
                    $('#instituicao_responsavel').val(o.instituicao);
                    $('#dpto_responsavel').val(o.departamento);
                });
            });

        } else if ($tamanho < 11 || $tamanho > 11) {
            $('#id_usuario').val("");
            $('#nome-responsavel').val("");
            $('#email_responsavel').val("");
            $('#telefone').val("");
            $('#lattes_responsavel').val("");
            $('#instituicao_responsavel').val("");
            $('#dpto_responsavel').val("");
        }
    });



//TABELA MEMBROS
    function criaTabelaMembros() {
        if (($("#tabela-membros")).length) {

            var paramIdProjeto = 68;

            var tabelaMembros = $('#tabela-membros').DataTable({
                "ajax": {

                    url: $BASE_URL + 'pessoa/getMembros/',
                    type: 'GET',
                    "data": {
                        "id_projeto": paramIdProjeto
                    }
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

            tabelaMembros.on('click', 'tr', function () {
                if ($(this).hasClass('selected')) {
                    $(this).removeClass('selected');
                } else {
                    tabelaMembros.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                }
            });


            $('#atualizar-tabela-membros').click(function () {
                tabelaMembros.ajax.reload();
            })
        }
    }

    //TABELA PROJETOS
    function tabelaProjetos() {
        if (($("#tabela-projetos")).length) {

            var tabelaProjetos = $('#tabela-projetos').DataTable({
                "ajax": {

                    url: $BASE_URL + 'projeto/getProjetos/',
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

            tabelaProjetos.on('click', 'tr', function () {
                if ($(this).hasClass('selected')) {
                    $(this).removeClass('selected');
                } else {
                    tabelaProjetos.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                }
            });


            $('#atualizar-tabela-projetos').click(function () {
                tabelaProjetos.ajax.reload();
            })
        }
    }




});

// Fim dO READY

function deletarMembro(id) {

    bootbox.confirm({
        message: "Tem certeza que deseja deletar este Projeto?",
        buttons: {
            confirm: {
                label: 'Sim',
                className: 'btn-success'
            },
            cancel: {
                label: 'Não',
                className: 'btn-danger enviar'
            }
        },
        callback: function (result) {
            if (result == true) {

                $.ajax({
                    url: $BASE_URL + 'pessoa/excluirMembro',
                    type: 'POST',
                    dataType: 'html',
                    data: ({
                        'id': id,
                    })

                }).done(function (data) {
                    $('#atualizar-tabela-membros').click();
                    atualizarNumMembros("-");
                    notify("Membro excluido com sucesso!", 'success');
                });
            }
        }
    });

}


function atualizarNumMembros($operacao) {
    $numMembros = $('#num-membros').html();
    $numMembrosI = parseInt($numMembros);
    if ($operacao == "+") {
        $('#num-membros').html($numMembrosI += 1);
    } else {
        $('#num-membros').html($numMembros -= 1);
    }

}


function excluirProjeto($id) {



    bootbox.confirm({
        message: "Tem certeza que deseja deletar este Projeto?",
        buttons: {
            confirm: {
                label: 'Sim',
                className: 'btn-success'
            },
            cancel: {
                label: 'Não',
                className: 'btn-danger enviar'
            }
        },
        callback: function (result) {
            if (result == true) {

                $.ajax({
                    url: $BASE_URL + 'projeto/excluir',
                    type: 'POST',
                    dataType: 'html',
                    data: ({
                        'id': $id,
                    })

                }).done(function (data) {
                    notify("Projeto excluído com sucesso!", "danger");
                    $('#atualizar-tabela-projetos').click();
                });
            }
        }
    });

}


function editarProjeto(id) {
    alert(id);
}

function adminProjeto($id) {
    location.href = $BASE_URL + 'projeto/administrar/' + $id;
}


function calcularTotal() {
    if ($('#qtdM').val() != "" && $('#qtdF').val() != "NaN") {
        $total = parseInt($('#qtdM').val()) + parseInt($('#qtdF').val());
        $('#total').val($total);
    }

}








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

