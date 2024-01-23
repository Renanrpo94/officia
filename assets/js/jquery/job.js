/* Pega o id do trabalho pela URL */
const jobId = () => {
    const urlAtual = window.location.href;
    const urlClass = new URL(urlAtual);
    var jobId = parseInt(urlClass.searchParams.get('id'));
    return jobId
}

/* Elementos HTML */
const username = $('.username');
const preco = $('.price');
const cat = $('.cat');
const postTitle = $('.job-title');
const desc = $('.desc');
const email = $('.email')
const cel = $('.cel')
const username2 = $('#username2');
const image = new Image();
const foto = $('.job-img');
const userInfo = $('.user-info');
const profile = $('.profile');
const profilePicBox = $('.profilePicBox');
const buttonBox = $('.button-box');
const continuar = $('#continuar');
const orcamento = $('#orcamento');
const profilePic = new Image();
const profilePic2 = new Image();

var resultAnuncio;

/* Lista o o anuncio */
const listUniqAnuncio = () => {
    $.ajax({
        url: '../_server/user/setUser.php',
        method: 'POST',
        data: {
            jobId: jobId(),
            listUniqAnuncio: ''
        },
        success: (result) => {
            const anuncio = result.content;
            resultAnuncio = result.content;
            profilePic.src = `../assets/uploads/profilePic/${anuncio.profilePic}`;
            profilePic2.src = `../assets/uploads/profilePic/${anuncio.profilePic}`;
            profilePicBox.append(profilePic2);
            profile.append(profilePic);
            postTitle.html(anuncio.titulo);
            username.html(anuncio.nome);
            preco.html(anuncio.preco.toLocaleString('pt-br', { style: 'currency', currency: 'BRL' }));
            cat.html(anuncio.categoria);
            image.src = `../assets/uploads/${anuncio.foto}`;
            foto.append(image);
            username2.html(`${anuncio.nome} ${anuncio.sobrenome}`).attr('href', `profile.php?id=${anuncio.userId}`);
            desc.html(anuncio.descricao.substring(0, 500));
            email.html(`Email: ${anuncio.email}`);
            cel.html(`Telefone: ${anuncio.cel}`);
            userInfo.attr('href', `profile.php?id=${anuncio.userId}`)
            profile.attr('href', `profile.php?id=${anuncio.userId}`)
        }
    })
}

/* Verificação se já existe um pedido de um determinado anuncio */
const verificarPedido = () => {
    $.ajax({
        url: '../_server/pedidos/setPedidos.php',
        method: 'POST',
        data: {
            verificarPedido: ''
        },
        success: (result) => {
            if (result.content.length > 0 && result.content.find(x => x.jobId === jobId())) {
                const pedido = result.content.find(pedido => pedido.jobId === jobId());
                if (pedido.requisicao == 1 && pedido.aceitacao == 0) {
                    continuar.html('Aguardando aceitação!')
                    continuar
                        .css({
                            'background-color': 'var(--purple)',
                            'color': 'var(--black-blue)',
                            'cursor': 'default',
                            'user-select': 'none'
                        })
                        .attr('disabled', 'disabled')
                    orcamento.hide()
                } else if (pedido.requisicao == 1 && pedido.aceitacao == 1 && pedido.pedido_conclusao == 0) {
                    continuar.html('Aguardando pedido de conclusão')
                    continuar
                        .css({
                            'background-color': 'var(--purple)',
                            'color': 'var(--black-blue)',
                            'cursor': 'default',
                            'user-select': 'none'
                        })
                        .attr('disabled', 'disabled')
                    orcamento.hide()
                } else if (pedido.requisicao == 1 && pedido.aceitacao == 1 && pedido.pedido_conclusao == 1 && pedido.conclusao === 0) {
                    continuar.html('Concluir pedido').attr('onClick', `concluirPedido(${pedido.pedidoId})`);
                } else if (pedido.requisicao == 1 && pedido.aceitacao == 1 && pedido.pedido_conclusao == 1 && pedido.conclusao === 1) {
                    continuar.html('Pedido finalizado')
                    continuar
                        .css({
                            'background-color': 'var(--purple)',
                            'color': 'var(--black-blue)',
                            'cursor': 'default',
                            'user-select': 'none'
                        })
                        .attr('disabled', 'disabled')
                    orcamento.hide()
                    buttonBox.append(`<button id="novoPedido" class="main-button-style" onClick="novoPedido(${pedido.pedidoId})">Pedir novamente</button>`)
                }
            } else {
                continuar
                    .html('Continuar')
                    .css({
                        'background-color': '',
                        'color': '',
                        'cursor': '',
                        'user-select': ''
                    })
                    .removeAttr('disabled')
                continuar.on('click', () => {
                    /* Criar a requisição */
                    if (confirm('Confirmar?')) {
                        $.ajax({
                            url: '../_server/pedidos/setPedidos.php',
                            method: 'POST',
                            data: {
                                freelancerId: resultAnuncio.freelancerId,
                                jobId: resultAnuncio.jobId,
                                requisicao: ''
                            },
                            success: (result) => {
                                verificarPedido()
                            }
                        })

                    }
                })
            }
        }
    })
}

/* Função para o usuario concluir o pedido */
const concluirPedido = (pedidoId) => {
    if (window.confirm('Deseja realmente concluir esse pedido?')) {
        $.ajax({
            url: '../_server/pedidos/setPedidos.php',
            method: 'POST',
            data: {
                concluirPedido: '',
                pedidoId: pedidoId
            },
            success: (result) => {
                window.alert(result.content)
                verificarPedido()
            }
        })
    }
}


/* Função para criar um novo pedido do mesmo trabalho */
const novoPedido = (pedidoId) => {
    $.ajax({
        url: '../_server/pedidos/setPedidos.php',
        method: 'POST',
        data: {
            novoPedido: '',
            pedidoId: pedidoId
        },
        success: (result) => {
            location.reload()
        }
    })
}


/* Executa funções ao abrir a pagina */
$(document).ready(() => {
    listUniqAnuncio();
    verificarPedido();
});