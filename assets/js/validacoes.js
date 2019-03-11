$BASE_URL = "http://localhost/ceua/";

$(document).ready(function () {
    tabelaProjetos();
    criaTabelaMembros();
    criaTabelaEspecies();

    $('#add-especie').click(function () {
        $('#id_modelo_animal').val("n");
        limparCamposAnimal();
    })

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
        if ($('#vinculo').val() == 9 || $('#vinculo').val() == 3) {
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

    $('#especie').change(function () {
        $id_especie = $('#especie').val();
        nome = $('#especie :selected').text();
        $('#dados-especie').attr("hidden", false);

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

            var paramIdProjeto = $('#id_projeto').val();

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


    $('#proc3').click(function (e) {
        if ($("#proc3").is(':checked')) {
            $('#num-protoco-sisbio').attr("hidden", false);
            $('#metodo-captura').attr("hidden", false);
        } else {
            $('#num-protoco-sisbio').attr("hidden", true);
            $('#metodo-captura').attr("hidden", true);
        }
    })

    $('#proc5').click(function (e) {
        if ($("#proc5").is(':checked')) {
            $('#outro-procedimento-bloco').attr("hidden", false);

        } else {
            $('#outro-procedimento-bloco').attr("hidden", true);

        }
    })

    $('#modificado').click(function (e) {
        if ($("#modificado").is(':checked')) {
            $('#bloco-qual-notificacao').attr("hidden", false);
        } else {
            $('#bloco-qual-notificacao').attr("hidden", true);
        }
    })

    $('#aproveitamento').change(function () {
        $aproveitamento = $('#aproveitamento').val();
        if ($aproveitamento == "n") {
            $('#como').attr("hidden", true);
        } else {
            $('#como').attr("hidden", false);
        }
    })

    $('#racao-comercial').change(function () {
        $racao = $('#racao-comercial').val();
        if ($racao == "s") {
            $('#racao-especial-bloco').attr("hidden", true);
            $('#qual-racao').attr("hidden", false);
        } else {
            $('#qual-racao').attr("hidden", true);
            $('#racao-especial-bloco').attr("hidden", false);
        }
    })


    $('#select-restricao-alimentar').change(function () {
        restricao = $('#select-restricao-alimentar').val();

        if (restricao == "s") {
            $('#bloco-select-restricao-alimentar').removeClass("col-md-12");
            $('#bloco-select-restricao-alimentar').addClass("col-md-6");
            $('#bloco-duracao-alimentar').attr("hidden", false);
        } else {
            $('#bloco-select-restricao-alimentar').addClass("col-md-12");
            $('#bloco-duracao-alimentar').attr("hidden", true);
        }
    })

    $('#select-restricao-hidrica').change(function () {
        restricao = $('#select-restricao-hidrica').val();

        if (restricao == "s") {
            $('#bloco-select-restricao-hidrica').removeClass("col-md-12");
            $('#bloco-select-restricao-hidrica').addClass("col-md-6");
            $('#bloco-duracao-hidrica').attr("hidden", false);
        } else {
            $('#bloco-select-restricao-hidrica').addClass("col-md-12");
            $('#bloco-duracao-hidrica').attr("hidden", true);
        }
    })

    $('#select-imobilizacao').change(function () {
        restricao = $('#select-imobilizacao').val();

        if (restricao == "s") {
            $('#bloco-select-imobilizacao').removeClass("col-md-12");
            $('#bloco-select-imobilizacao').addClass("col-md-6");
            $('#bloco-imobilizacao').attr("hidden", false);
        } else {
            $('#bloco-select-imobilizacao').addClass("col-md-12");
            $('#bloco-como-imobilizacao').attr("hidden", true);
        }
    })

    $('#select-lesao').change(function () {
        restricao = $('#select-lesao').val();

        if (restricao == "s") {
            $('#bloco-select-lesao').removeClass("col-md-12");
            $('#bloco-select-lesao').addClass("col-md-6");
            $('#bloco-lesao').attr("hidden", false);
        } else {
            $('#bloco-select-lesao').addClass("col-md-12");
            $('#bloco-como-lesao').attr("hidden", true);
        }
    })

    $('#select-cirurgia').change(function () {
        restricao = $('#select-cirurgia').val();

        if (restricao == "s") {
            $('#bloco-select-cirurgia').removeClass("col-md-12");
            $('#bloco-select-cirurgia').addClass("col-md-6");
            $('#bloco-cirurgia').attr("hidden", false);
        } else {
            $('#bloco-select-cirurgia').addClass("col-md-12");
            $('#bloco-como-cirurgia').attr("hidden", true);
        }
    })

    $('#select-anestesia').change(function () {
        restricao = $('#select-anestesia').val();

        if (restricao == "s") {
            $('#bloco-select-anestesia').removeClass("col-md-12");
            $('#bloco-select-anestesia').addClass("col-md-6");
            $('#bloco-anestesia').attr("hidden", false);
        } else {
            $('#bloco-select-anestesia').addClass("col-md-12");
            $('#bloco-como-anestesia').attr("hidden", true);
        }
    })
    
    $('#select-recuperacao').change(function () {
        restricao = $('#select-recuperacao').val();

        if (restricao == "s") {
            $('#bloco-select-recuperacao').removeClass("col-md-12");
            $('#bloco-select-recuperacao').addClass("col-md-6");
            $('#bloco-recuperacao').attr("hidden", false);
        } else {
            $('#bloco-select-recuperacao').addClass("col-md-12");
            $('#bloco-recuperacao').attr("hidden", true);
        }
    })
    
     $('#select-extracao').change(function () {
        restricao = $('#select-extracao').val();

        if (restricao == "s") {
            $('#bloco-extracao').attr("hidden", false);
        } else {

            $('#bloco-extracao').attr("hidden", true);
        }
    })
//QUANDO ESTE CÓDIGO FOI CRIADO SEMENTE EU DEUS SABIAMOS O QUE ESTAVÁMOS FAZENDO, HOJE, SÓ DEUS SABE!
    $('#salvar-medicamento').click(function () {

        $.ajax({
            url: $BASE_URL + 'projeto/salvarMedicamento',
            type: 'POST',
            dataType: 'html',
            data: ({
                'id_projeto': $('#id_projeto').val(),
                'farmaco': $('#farmaco').val(),
                'dose': $('#dose').val(),
                'frequencia': $('#frequencia').val(),
                'duracao': $('#duracao').val(),
                'via': $('#via').val(),
                'id_medicamento': $('#id_medicamento').val(),
            })

        }).done(function (data) {
            if (data == true) {
                $('#cancel-medicamento').click();
                criaTabelaMedicamentos();
                notify("Salvo com sucesso", "success");
                $('#farmaco').val("");
                $('#dose').val("");
                $('#frequencia').val("");
                $('#duracao').val("");
                $('#via').val("");
                $('#id_medicamento').val("")
            }
        });
    })
    criaTabelaMedicamentos();

    $('#add-medicamento').click(function () {
        $('#form-medicamento').attr("hidden", false);
        $('#bloco-tabela-medicamentos').attr("hidden", true);
    })

    $('#cancel-medicamento').click(function () {
        $('#form-medicamento').attr("hidden", true);
        $('#bloco-tabela-medicamentos').attr("hidden", false);
        $('#farmaco').val("");
        $('#dose').val("");
        $('#frequencia').val("");
        $('#duracao').val("");
        $('#via').val("");
        $('#id_medicamento').val("");
    })


});

// Fim dO READY

function excluirMedicamento(id) {
    bootbox.confirm({
        message: "Tem certeza que deseja deletar este Medicamento?",
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
                    url: $BASE_URL + 'projeto/excluirMedicamento',
                    type: 'POST',
                    dataType: 'html',
                    data: ({
                        'id': id,
                    })

                }).done(function (data) {
                    console.log(data);
                    if (data == true) {
                        criaTabelaMedicamentos();
                        notify("Medicamento excluido com sucesso!", 'success');
                    } else {
                        notify("Erro ao tentar excluir!<br>Tente novamente!", "danger");
                    }

                });
            }
        }
    });

}

function editarMedicamento(id) {
    $.ajax({
        url: $BASE_URL + 'projeto/getMedicamentoID',
        type: 'POST',
        dataType: 'html',
        data: ({
            'id': id,
        })

    }).done(function (data) {
        var obj = JSON.parse(data);
        obj.forEach(function (o, index) {
            $('#id_medicamento').val(o.id_medicamento);
            $('#farmaco').val(o.farmaco);
            $('#dose').val(o.dose);
            $('#frequencia').val(o.frequencia);
            $('#duracao').val(o.duracao);
            $('#via').val(o.via);
            $('#add-medicamento').click();
        });
    })
}

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




function salvarAnimal() {
    especie = $('#especie').val();
    linhagem = $('#linhagem').val();
    idade = $('#idade').val();
    peso = $('#peso').val();
    numAnimaisGrupo = $('#animais-por-grupo').val();
    numGrupos = $('#num-grupos').val();
    qtdM = $('#qtdM').val();
    qtdF = $('#qtdF').val();
    criterio = $('#criterio').val();
    //FALTA PROCEDENCIA
    sisbio = $('#sisbio').val();
    captura = $('#captura').val();
    qualprocedimento = $('#qualprocedimento').val();
    numctnbio = $('#numctnbio').val();
    aproveitamento = $('#aproveitamento').val();
    qualaproveitamento = $('#qualaproveitamento').val();
    manejo = $('#manejo').val();
    agua = $('#agua').val();
    racaoComercial = $('#racao-comercial').val();
    qualRacao = $('#qualracao').val();
    racaoEspecial = $('#racaoespecial').val();

    $procedencia = "";
    if ($("#proc1").is(':checked')) {
        $procedencia += "Biotério de Criação";
    }
    if ($("#proc2").is(':checked')) {

        if ($procedencia == "") {
            $procedencia = $procedencia + "Estabelecimentos comerciais";
        } else {
            $procedencia = $procedencia + ", Estabelecimentos comerciais";
        }

    }
    if ($('#proc3').is(':checked')) {
        if ($procedencia == "") {
            $procedencia = $procedencia + "Animal selvagem";
        } else {
            $procedencia = $procedencia + ", Animal selvagem";
        }

    }
    if ($('#proc4').is(':checked')) {
        if ($procedencia == "") {
            $procedencia = $procedencia + "Animal doméstico";
        } else {
            $procedencia = $procedencia + ", Animal doméstico";
        }

    }

    if ($('#proc5').is(':checked')) {
        if ($procedencia == "") {
            $procedencia = $procedencia + "Outros";
        } else {
            $procedencia = $procedencia + ", Outros";
        }

    }



    $.ajax({
        url: $BASE_URL + 'projeto/salvarAnimalExperimental',
        type: 'POST',
        dataType: 'html',
        data: ({
            'id_modelo_animal': $('#id_modelo_animal').val(),
            'id_projeto': $('#id_projeto').val(),
            'especie': especie,
            'linhagem': linhagem,
            'idade': idade,
            'peso': peso,
            'numAnimaisGrupo': numAnimaisGrupo,
            'numGrupos': numGrupos,
            'qtdM': qtdM,
            'qtdF': qtdF,
            'criterio': criterio,
            'sisbio': sisbio,
            'procedencia': $procedencia,
            'captura': captura,
            'qualprocedimento': qualprocedimento,
            'numctnbio': numctnbio,
            'aproveitamento': aproveitamento,
            'qualaproveitamento': qualaproveitamento,
            'manejo': manejo,
            'agua': agua,
            'racaoComercial': racaoComercial,
            'qualRacao': qualRacao,
            'racaoEspecial': racaoEspecial,
        })

    }).done(function (data) {

        if (data == true) {
            notify("Salvo com sucesso", "success");
            $('#atualizar-tabela-especies').click();
            $('#modal-add-animal-experimental').modal('hide');
            limparCamposAnimal();
        } else {
            notify("Erro ao tentar salvar!", "danger");
        }
    });

}

function limparCamposAnimal() {
    $('#especie').val("");
    $('#linhagem').val("");
    $('#idade').val("");
    $('#peso').val("");
    $('#animais-por-grupo').val("");
    $('#num-grupos').val("");
    $('#qtdM').val("");
    $('#qtdF').val("");
    $('#criterio').val("");
    //FALTA PROCEDENCIA
    $('#sisbio').val("");
    $('#captura').val("");
    $('#qualprocedimento').val("");
    $('#numctnbio').val("");
    $('#aproveitamento').val("");
    $('#qualaproveitamento').val("");
    $('#manejo').val("");
    $('#agua').val("");
    $('#racao-comercial').val("");
    $('#qualracao').val("");
    $('#racaoespecial').val("");
    $('#proc2').prop('checked', false);
    $('#proc3').prop('checked', false);
    $('#proc4').prop('checked', false);
    $('#proc5').prop('checked', false);
    $('#proc1').prop('checked', false);
}

function editarModeloAnimal(id) {

    $.ajax({
        url: $BASE_URL + 'projeto/getEspecieID',
        type: 'POST',
        dataType: 'html',
        data: ({
            'id': id,
        })

    }).done(function (data) {

        var obj = JSON.parse(data);
        obj.forEach(function (o, index) {
            $('#id_modelo_animal').val(o.id_modelo_animal);
            $('#especie').val(o.id_especie).selectpicker('refresh');
            $('#linhagem').val(o.linhagem);
            $('#idade').val(o.idade);
            $('#peso').val(o.peso);
            $('#animais-por-grupo').val(o.num_animais_grupo);
            $('#num-grupos').val(o.num_grupos);
            $('#qtdM').val(o.qtd_mas);
            $('#qtdF').val(o.qtd_fem);

            $p = o.procedencia.split(", ");

            for ($i = 0; $i < $p.length; $i++) {
                if ($p[$i] == "Biotério de Criação") {
                    $('#proc1').prop('checked', true);
                }
                if ($p[$i] == "Estabelecimentos comerciais") {
                    $('#proc2').prop('checked', true);
                }
                if ($p[$i] == "Animal selvagem") {
                    $('#proc3').prop('checked', true);
                }
                if ($p[$i] == "Animal doméstico") {
                    $('#proc4').prop('checked', true);
                }
                if ($p[$i] == "Outros") {
                    $('#proc5').prop('checked', true);
                }
            }

            $('#criterio').val(o.criterio);
            //FALTA PROCEDENCIA
            $('#sisbio').val(o.num_sisbio);
            $('#captura').val(o.metodo_captura);
            $('#qualprocedimento').val(o.procedencia_outras);
            $('#numctnbio').val(o.num_ctnbio);

            if (o.gen_modificado == "s") {
                $('#modificado').attr("checked", true);
                $('#bloco-qual-notificacao').attr("hidden", false);
            }

            $('#aproveitamento').val(o.aprv_aniamais).selectpicker('refresh');
            $('#qualaproveitamento').val(o.aprv_animais_como);
            $('#manejo').val(o.manejo_animais);
            $('#agua').val(o.tipo_agua).selectpicker('refresh');
            $('#racao-comercial').val(o.racao_comercia).selectpicker('refresh');
            $('#qualracao').val(o.qual_racao);
            $('#racaoespecial').val(o.racao_especial);
        })
    });
}




//TABELA ESPECIES
function criaTabelaEspecies() {
    if (($("#tabela-especies")).length) {
        $('#tabela-especies').css('width', '100%');
        var tabelaEspecies = $('#tabela-especies').DataTable({

            destroy: true,
            "ajax": {

                url: $BASE_URL + 'projeto/getModeloAnimal/',
                type: 'GET',
                "data": {
                    "id_projeto": $('#id_projeto').val()
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

        tabelaEspecies.on('click', 'tr', function () {
            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected');
            } else {
                tabelaEspecies.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        });


        $('#atualizar-tabela-especies').click(function () {
            tabelaEspecies.ajax.reload();
        })
    }
}

function excluirModeloAnimal($id) {
    bootbox.confirm({
        message: "Tem certeza que deseja excluir esta espécie?",
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
                    url: $BASE_URL + 'projeto/excluirExpecie',
                    type: 'POST',
                    dataType: 'html',
                    data: ({
                        'id': $id,
                    })

                }).done(function (data) {
                    if (data == true) {
                        notify("Excluído com sucesso!", "success");
                        criaTabelaEspecies();
                    }
                });
            }
        }
    });
}



//TABELA ESPECIES
function criaTabelaMedicamentos() {
    if (($("#tabela-medicamentos")).length) {
        $('#tabela-medicamentos').css('width', '100%');
        var tabelaEspecies = $('#tabela-medicamentos').DataTable({

            destroy: true,
            "ajax": {

                url: $BASE_URL + 'projeto/getMedicamentos/',
                type: 'GET',
                "data": {
                    "id_projeto": $('#id_projeto').val()
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

        tabelaEspecies.on('click', 'tr', function () {
            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected');
            } else {
                tabelaEspecies.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        });


        $('#atualizar-tabela-medicamentos').click(function () {
            tabelaEspecies.ajax.reload();
        })
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

