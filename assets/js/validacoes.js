$BASE_URL = "http://localhost/App_tabeliao/";

$(document).ready(function () {

    $('.selectpicker').selectpicker({
        style: 'btn-info',
    });


    $("#preco-produto").inputmask('decimal', {
        'alias': 'numeric',
        'groupSeparator': ',',
        'autoGroup': true,
        'digits': 2,
        'radixPoint': ",",
        'digitsOptional': false,
        'allowMinus': false,
        'prefix': '',
        'placeholder': '0,00'
    });

    $("#preco-produto-edit").inputmask('decimal', {
        'alias': 'numeric',
        'groupSeparator': ',',
        'autoGroup': true,
        'digits': 2,
        'radixPoint': ",",
        'digitsOptional': false,
        'allowMinus': false,
        'prefix': '',
        'placeholder': '0,00'
    });



    $(".modal-wide").on("show.bs.modal", function () {
        var height = $(window).height() - 200;
        $(this).find(".modal-body").css("max-height", height);
    });

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



//TABELA PRODUTOS
    if (($("#tabela-produtos")).length) {


        var tabelaProdutos = $('#tabela-produtos').DataTable({
            "ajax": {

                url: $BASE_URL + 'Produtos/getProdutos',
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

    }

    $('#atualizar-tabela-produtos').click(function () {
        tabelaProdutos.ajax.reload();
    })


    $('#img-produto').on('change', function () {

        var fr = new FileReader;

        fr.onload = function () {
            var img = new Image;

            img.onload = function () {

                if (img.width != 250 && this.height != 250) {
                    $('#retorno-imagem-produto').addClass("alert alert-danger");
                    $('#retorno-imagem-produto').html("Ops! A imagem deve conter as seguintes dimensões: <br> Largura: 250px<br>Altura: 250px;");
                } else {
                    $('#btn-salvar-produto').removeAttr('disabled');

                }
            };

            img.src = fr.result;
        };

        fr.readAsDataURL(this.files[0]);

    });



    $('#btn-salvar-produto').click(function () {
        $nome_produto = $('#nome-produto').val();
        $desc_produto = $('#desc-produto').val();

        if ($nome_produto == null || $desc_produto == "") {
            $('#retorno-salvar-produto').addClass("alert alert-danger");
            $('#retorno-salvar-produto').html("Ops! Preencha todos os dados para continuar!");
        } else {
            $('#form-produto').ajaxForm({
                target: '#retorno-salvar-produto' // o callback serÃ¡ no elemento com o id #visualizar
            }).submit();
            $('#atualizar-tabela-produtos').click();
            $('#nome-produto').val("");
            $('#desc-produto').val("");
            $('#img-produto').val("");

            notify("Salvo com sucesso!", "success");

        }

    })

//FIM PRODUTOS











//TABELA MARCAS
    if (($("#tabela-marcas")).length) {

        var tabelaMarcas = $('#tabela-marcas').DataTable({
            "ajax": {

                url: $BASE_URL + 'Marcas/getMarcas',
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

    }

    $('#atualizar-tabela-marcas').click(function () {
        tabelaMarcas.ajax.reload();
    })


    $('#img-marcas').on('change', function () {

        var fr = new FileReader;

        fr.onload = function () {
            var img = new Image;

            img.onload = function () {

                if (img.width != 250 && this.height != 250) {
                    $('#retorno-imagem-marcas').addClass("alert alert-danger");
                    $('#retorno-imagem-marcas').html("Ops! A imagem deve conter as seguintes dimensões: <br> Largura: 250px<br>Altura: 250px;");
                } else {

                    $('#retorno-imagem-marcas').removeClass("alert alert-danger");
                    $('#retorno-imagem-marcas').html("");
                    $('#btn-salvar-marcas').removeAttr('disabled');

                }
            };

            img.src = fr.result;
        };

        fr.readAsDataURL(this.files[0]);

    });



    $('#btn-salvar-marcas').click(function () {
        $nome_produto = $('#nome-marcas').val();
        $desc_produto = $('#desc-marcas').val();

        if ($nome_produto == null || $desc_produto == "") {
            $('#retorno-salvar-marcas').addClass("alert alert-danger");
            $('#retorno-salvar-marcas').html("Ops! Preencha todos os dados para continuar!");
        } else {
            $('#form-marcas').ajaxForm({
                target: '#retorno-salvar-marcas' // o callback serÃ¡ no elemento com o id #visualizar
            }).submit();
            $('#atualizar-tabela-marcas').click();
            $('#nome-marcas').val("");
            $('#desc-marcas').val("");
            $('#img-marcas').val("");

            notify("Salvo com sucesso!", "success");

        }

    })

//FIM MARCAS





//TABELA TAMANHOS
    if (($("#tabela-tamanhos")).length) {

        var tabelaTamanhos = $('#tabela-tamanhos').DataTable({
            "ajax": {

                url: $BASE_URL + 'Tamanhos/getTamanhos',
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

    }

    $('#atualizar-tabela-tamanhos').click(function () {
        tabelaTamanhos.ajax.reload();
    })



    $('#btn-salvar-tamanho').click(function () {
        $tamanho = $('#tamanho-salvar').val();

        if ($tamanho == "") {
            $('#retorno-salvar-tamanho').addClass("alert alert-danger");
            $('#retorno-salvar-tamanho').html("Ops! Preencha todos os dados para continuar!");
        } else {

            $.ajax({
                url: $BASE_URL + 'Tamanhos/salvar',
                type: 'POST',
                dataType: 'html',
                data: ({
                    'nome_tamanho': $tamanho,
                })

            }).done(function (data) {

                if (data == 1) {
                    notify("Tamanho já cadastrado no SISTEMA", "danger");
                    $('#tamanho-salvar').focus();
                } else {
                    tabelaTamanhos.ajax.reload();
                    notify("Cadastrado com sucesso!", "success");
                    ('#cadastro-tamanhos').modal('hide');
                    $('#tamanho-salvar').val("");
                }
                console.log(data);

            });
        }
    });

//FIM TAMANHOS



//TABELA SUPERMERCADOS
    if (($("#tabela-supermercados")).length) {

        var tabelaSupermercados = $('#tabela-supermercados').DataTable({
            "ajax": {

                url: $BASE_URL + 'Supermercados/getSupermercados',
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

    }

    $('#atualizar-tabela-supermercados').click(function () {
        tabelaSupermercados.ajax.reload();
    })

    $("#telefone-supermercado").inputmask({
        mask: ["(99) 9 9999 - 9999", ],
        keepStatic: true
    });
    $("#telefone-supermercado-edit").inputmask({
        mask: ["(99) 9 9999 - 9999", ],
        keepStatic: true
    });

    $('#btn-alterar-mapa').click(function () {
        $('#mapa-supermercado-frame').hide("slow");
        $('#maps-edit').removeAttr("hidden");
        $('#maps-edit').val("");
    })


    $('#btn-salvar-supermercado').click(function () {
        $nomeSupermercado = $('#nome-supermercado').val();
        $endereco = $('#endereco-supermercado').val();
        $telefone = $('#telefone-supermercado').val();
        $mapa = $('#maps').val();

        if ($nome = "" || $endereco == "" || $telefone == "" || $mapa == "") {
            $('#retorno-salvar-supermercado').addClass("alert alert-danger");
            $('#retorno-salvar-supermercado').html("Ops! Preencha todos os dados para continuar!");
        } else {

            $.ajax({
                url: $BASE_URL + 'Supermercados/salvar',
                type: 'POST',
                dataType: 'html',
                data: ({
                    'nome': $nomeSupermercado,
                    'endereco': $endereco,
                    'telefone': $telefone,
                    'mapa': $mapa,
                })

            }).done(function (data) {

                if (data == 1) {
                    notify("Supermercado já cadastrado no SISTEMA", 'danger');
                    $('#nome-supermercado').focus();
                } else {
                    tabelaSupermercados.ajax.reload();
                    $('#cadastro-supermercados').modal('hide');
                    $('#nome-supermercado').val("");
                    $('#endereco-supermercado').val("");
                    $('#telefone-supermercado').val("");
                    $('#maps').val("");
                    notify("Cadastrado com sucesso!", "success");
                }
            });
        }
    });

//FIM TAMANHOS





//TABELA PRODUTOS
    if (($("#tabela-valores")).length) {


        var tabelaValores = $('#tabela-valores').DataTable({
            "ajax": {

                url: $BASE_URL + 'Valores/getValores',
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

    }

    $('#atualizar-tabela-valores').click(function () {
        tabelaValores.ajax.reload();
    })


});


function alterarSupermercados($id) {

    $.ajax({
        url: $BASE_URL + 'Supermercados/buscarSupermercados',
        type: 'POST',
        dataType: 'html',
        data: ({
            'id': $id,
        })

    }).done(function (data) {
        console.log(data);
        var obj = JSON.parse(data);
        obj.forEach(function (o, index) {
            $('#nome-supermercado-edit').val(o.nome_supermercado);
            $('#endereco-supermercado-edit').val(o.endereco_supermercado);
            $('#telefone-supermercado-edit').val(o.telefone_supermercado);
            $('#mapa-supermercado-frame').html(o.maps_supermercado);
            $('#maps-edit').html(o.maps_supermercado);
            $('#id-supermeracado-edit').val(o.id_supermercado);

        });

    });
}



function alterarMarcas($id) {

    $.ajax({
        url: $BASE_URL + 'Marcas/buscarMarcas',
        type: 'POST',
        dataType: 'html',
        data: ({
            'id': $id,
        })

    }).done(function (data) {

        var obj = JSON.parse(data);
        obj.forEach(function (o, index) {
            $('#nome-marcas-edit').val(o.nome_marca);
            $('#desc-marcas-edit').val(o.desc_marca);
            $('#produto-marcas-edit').val(o.id_produto);
            $('#id-marcas-edit').val(o.id_marca);
            $imagem = $BASE_URL + "assets/img/marcas/" + o.img_marca;
            $('#img-edit').attr('src', $imagem);
        });

    });
}


function excluirMarcas($id, $img) {

    bootbox.confirm({
        message: "Tem certeza que deseja deletar esta Marca?",
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
                    url: $BASE_URL + "Marcas/deletar",
                    type: 'POST',
                    dataType: 'html',
                    data: ({
                        'id': $id,
                        'img': $img
                    })

                }).done(function (data) {
                    notify("Excluido com sucesso!", "danger");
                    $('#atualizar-tabela-marcas').click();
                });
            }
        }
    });

}



function salvarAlteracoesMarcas() {
    $('#form-marcas-update').ajaxForm({
        target: '#retorno-edit-marcas' // o callback serÃ¡ no elemento com o id #visualizar
    }).submit();
    $('#atualizar-tabela-marcas').click();
    notify("Dados alterados com sucesso!", "info");
    $('#editar-marcas').modal('hide');
}

function alterarCategoria($id) {
    $.ajax({
        url: $BASE_URL + 'Categorias/buscarCategoria',
        type: 'POST',
        dataType: 'html',
        data: ({
            'id': $id,
        })

    }).done(function (data) {
        console.log(data);
        var obj = JSON.parse(data);
        obj.forEach(function (o, index) {
            $('#nome-categoria-edit').val(o.nome_categoria);
            $('#desc-categoria-edit').val(o.desc_categoria);
            $('#id-categoria-edit').val(o.id_categoria);
            $imagem = $BASE_URL + "assets/img/categorias/" + o.img_categoria;
            $('#img-edit').attr('src', $imagem);


        });

    });
}

function excluirCategoria($id, $img) {

    bootbox.confirm({
        message: "Tem certeza que deseja deletar esta categoria?",
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
                    url: $BASE_URL + "Categorias/deletar",
                    type: 'POST',
                    dataType: 'html',
                    data: ({
                        'id': $id,
                        'img': $img
                    })

                }).done(function (data) {
                    notify("Excluido com sucesso!", "danger");
                    $('#atualizar-tabela-categorias').click();
                });
            }
        }
    });

}


function salvarAlteracoesCategoria() {
    $('#form-categoria-update').ajaxForm({
        target: '#retorno-edit-categorias' // o callback serÃ¡ no elemento com o id #visualizar
    }).submit();
    notify("Dados alterados com sucesso!", "info");
    $('#atualizar-tabela-categorias').click();
}




function excluirProduto($id, $img) {

    bootbox.confirm({
        message: "Tem certeza que deseja deletar esta produto?",
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
                    url: $BASE_URL + "Produtos/deletar",
                    type: 'POST',
                    dataType: 'html',
                    data: ({
                        'id': $id,
                        'img': $img
                    })

                }).done(function (data) {
                    notify("Excluido com sucesso!", "danger");
                    $('#atualizar-tabela-produtos').click();
                });
            }
        }
    });

}

function alterarProduto($id) {

    $.ajax({
        url: $BASE_URL + 'Produtos/buscarProdutos',
        type: 'POST',
        dataType: 'html',
        data: ({
            'id': $id,
        })

    }).done(function (data) {

        var obj = JSON.parse(data);
        obj.forEach(function (o, index) {
            $('#nome-produto-edit').val(o.nome_produto);
            $('#desc-produto-edit').val(o.desc_produto);
            $('#categoria-produto-edit').val(o.id_categoria);
            $('#id-produto-edit').val(o.id_produto);
            $imagem = $BASE_URL + "assets/img/produtos/" + o.img_produto;
            $('#img-edit').attr('src', $imagem);
        });

    });
}



function salvarAlteracoesTamanho() {
    $tamanho = $('#nome-tamanho-edit').val();
    $id = $('#id-tamanho-edit').val();


    $.ajax({
        url: $BASE_URL + 'Tamanhos/update',
        type: 'POST',
        dataType: 'html',
        data: ({
            'id': $id,
            'tamanho': $tamanho,
        })

    }).done(function (data) {
        if (data == 1) {
            notify("Já existe este tamanho cadastrado no SISTEMA", "danger");
            $('#nome-tamanho-edit').focus();
        } else {
            $('#atualizar-tabela-tamanhos').click();
            notify("Tamanho alterado com sucesso!", "success");

        }
    });

}


function alterarTamanhos($id) {
    $.ajax({
        url: $BASE_URL + 'Tamanhos/buscarTamanhos',
        type: 'POST',
        dataType: 'html',
        data: ({
            'id': $id,
        })

    }).done(function (data) {

        var obj = JSON.parse(data);
        obj.forEach(function (o, index) {
            $('#nome-tamanho-edit').val(o.desc_tamanho);
            $('#id-tamanho-edit').val(o.id_tamanho);
        });

    });
}

function salvarAlteracoesProduto() {
    $('#form-produto-update').ajaxForm({
        target: '#' // o callback serÃ¡ no elemento com o id #visualizar
    }).submit();
    notify("Dados alterados com sucesso!", "info");
    $('#atualizar-tabela-produtos').click();
    $('#editar-produto').modal('hide');
}


function salvarAlteracoesSupermercado() {

    $nome = $('#nome-supermercado-edit').val();
    $endereco = $('#endereco-supermercado-edit').val();
    $telefone = $('#telefone-supermercado-edit').val();
    $mapa = $('#maps-edit').val();
    $id = $('#id-supermeracado-edit').val();

    $.ajax({
        url: $BASE_URL + 'Supermercados/update',
        type: 'POST',
        dataType: 'html',
        data: ({
            'nome': $nome,
            'endereco': $endereco,
            'telefone': $telefone,
            'maps': $mapa,
            'id': $id,
        })

    }).done(function (data) {
        if (data == 1) {
            $('#atualizar-tabela-supermercados').click();
            $nome = $('#nome-supermercado-edit').val("");
            $endereco = $('#endereco-supermercado-edit').val("");
            $telefone = $('#telefone-supermercado-edit').val("");
            $mapa = $('#maps-edit').val("");
            $id = $('#id-supermeracado-edit').val("");

            $('#editar-supermercados').modal('hide');

            notify("Alterações realizadas com sucesso!", "success");
        } else {
            notify("Houve algum erro, tente novamente!", "danger");
        }

    });
}




function desativarSupermercado($id, $ativo) {

    bootbox.confirm({
        message: "Tem certeza que deseja desativar este supermercado?",
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
                    url: $BASE_URL + "Supermercados/desativar",
                    type: 'POST',
                    dataType: 'html',
                    data: ({
                        'id': $id,
                        'ativo': $ativo
                    })

                }).done(function (data) {

                    notify("Desativado com sucesso!", "danger");
                    $('#atualizar-tabela-supermercados').click();
                });
            }
        }
    });

}


function salvarValores() {
    $supermercado = $('#supermercado').val();
    $tamanho = $('#tamanho').val();
    $marca = $('#marca').val();
    $produto = $('#produto').val();
    $valor = $('#preco-produto').val();
    $categoria = $('#categoria').val();
    if ($supermercado == "" || $tamanho == "" || $marca == "" || $produto == "" || $valor == "") {
        notify("Preencha todos os dados para continuar!", "danger");
    } else {
        $.ajax({
            url: $BASE_URL + "Valores/salvar",
            type: 'POST',
            dataType: 'html',
            data: ({
                'supermercado': $supermercado,
                'tamanho': $tamanho,
                'marca': $marca,
                'produto': $produto,
                'valor': $valor,
                'categoria': $categoria,
            })

        }).done(function (data) {
            if (data == 1) {
                notify("Preço já cadastrado para este produto", "danger");
            } else {
                $('#atualizar-tabela-valores').click();
                notify("Preço cadastrado com sucesso!", "success");
            }
        });

    }


}

function alterarValor($id) {
    $.ajax({
        url: $BASE_URL + 'Valores/buscarValores',
        type: 'POST',
        dataType: 'html',
        data: ({
            'id': $id,
        })

    }).done(function (data) {
        console.log(data);
        var obj = JSON.parse(data);
        obj.forEach(function (o, index) {
            $('#supermercado-edit').val(o.id_supermercado);
            $('select[name=id-supermercado]').val(o.id_supermercado);
            $('select[name=tamanho-edit]').val(o.id_tamanho);
            $('select[name=marca-edit]').val(o.id_marca);
            $('select[name=produto-edit]').val(o.id_produto);
            $('#preco-produto-edit').val(o.valor);
            $('#id-valor-edit').val(o.id_valor);
            $('.selectpicker').selectpicker('refresh');
        });

    });
}

function salvarAlteracoesValores($id) {
    $supermercado = $('#supermercado-edit').val();
    $tamanho = $('#tamanho-edit').val();
    $marca = $('#marca-edit').val();
    $produto = $('#produto-edit').val();
    $valor = $('#preco-produto-edit').val();
    $id = $('#id-valor-edit').val();
    if ($supermercado == "" || $tamanho == "" || $marca == "" || $produto == "" || $valor == "") {
        notify("Preencha todos os dados para continuar!", "danger");
    } else {
        $.ajax({
            url: $BASE_URL + "Valores/update",
            type: 'POST',
            dataType: 'html',
            data: ({
                'supermercado': $supermercado,
                'tamanho': $tamanho,
                'marca': $marca,
                'produto': $produto,
                'valor': $valor,
                'id': $id
            })

        }).done(function (data) {
            if (data == 1) {
                $('#atualizar-tabela-valores').click();
                notify("Alterações realizadas com sucesso!", "success");
                $('#editar-protudos-modal').modal('hide');
            }
        });

    }


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


