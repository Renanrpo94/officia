// Coleta de dados dos pedidos
var resultPedidos;

/* Função para pegar todos as requisições */
$(document).ready(() => {
    var userId = $('#userId');
    var userId = userId.text();

    $.ajax({
        url: '../_server/pedidos/setPedidos.php',
        method: 'POST',
        data: {
            pedidosFree: '',
            userId: userId
        },
        success: (result) => {
            const pedidosList = $('.pedidos');
            if (result.content.length > 0) {
                resultPedidos = result.content;
                const pedidos = result.content;

                pedidos.forEach(pedido => {
                    var pedidoHTML = `
                    <div class="pedidos-list" onclick='openWrapper(${pedido.pedidoId})'>
                        <div class="pedidos-list-icon">
                        <i class='bx bx-hard-hat'></i>
                        </div>
                        <div class="pedidos-list-item">
                        Pedido #${pedido.pedidoId} - ${pedidoStatus(pedido)}
                        </div>
                        <div class="pedidos-list-arrow">
                        <i class='bx bxs-chevron-up'></i>
                        </div>
                    </div>`
                    pedidosList.append(pedidoHTML)
                });
            } else {
                pedidosList.html('Você não tem nenhum trabalho em andamento')
            }

        }

    });/* Fim Ajax */
});

/* Função para abrir e montar o wrapper do pedido */
const openWrapper = (pedidoId) => {
    $('.pedidos-list-wrapper').addClass('active')

    var resultado = resultPedidos.find(pedido => pedido.pedidoId === pedidoId);
    const wrapper = $('.pedidos-list-wrapper')
    var wrapperHTML = `<div class="wrapper-info">
            <span class="wrapper-info-close" onclick='wrapperClose()'>
                <i class='bx bx-x'></i>
            </span>
            <div class="wrapper-info-title">
                Pedido #${resultado.pedidoId}
                <div class="wrapper-info-title-status">
                    ${pedidoStatus(resultado)}
                </div>
            </div>
            <div class="wrapper-info-box">
                <div class="wrapper-info-box-pedido">
                    <div class="wrapper-info-box-pedido-title">
                        ${resultado.titulo}
                    </div>
                    <div class="wrapper-info-box-pedido-categoria">
                      ${resultado.categoria}
                    </div>
                    <div class="wrapper-info-box-pedido-imagem">
                      <img src="../assets/uploads/${resultado.foto}" alt="Picsum">
                    </div>
                    <div class="wrapper-info-box-pedido-preco">${resultado.preco.toLocaleString('pt-br', { style: 'currency', currency: 'BRL' })}</div>
                    <div class="wrapper-info-box-pedido-descricao">${resultado.descricao}</div>
                    <div class="wrapper-info-box-pedido-info">
                        #J${resultado.jobId}-F${resultado.freelancerId}-U${resultado.userId}-P${resultado.pedidoId}-FU${resultado.free_userId}
                    </div>
                </div>
                <div class="wrapper-info-box-freelancer">
                    <div class="wrapper-info-box-freelancer-container">
                        <div class="wrapper-info-box-freelancer-container-imagem">
                            <img src="https://picsum.photos/200/300" alt="Picsum">
                        </div>
                        <div>
                            <div class="wrapper-info-box-freelancer-container-nome">
                            ${resultado.nome} ${resultado.sobrenome}
                            </div>
                            <div class="wrapper-info-box-freelancer-container-email">
                            ${resultado.email}
                            </div>
                            <div class="wrapper-info-box-freelancer-container-cel">
                                ${resultado.cel}
                            </div>
                        </div>
                    </div>
                    <div class="wrapper-info-box-freelancer-buttons">
                        <a href="profile.php?id=${resultado.userId}"  class="main-button-style">Perfil</a>
                        <a href="job.php?id=${resultado.jobId}"  class="main-button-style">Anuncio</a>
                    </div>
                </div>
            </div>
        </div>`
    wrapper.html(wrapperHTML)

    if (resultado.aceitacao === 0 && resultado.pedido_conclusao === 0) {
        const rejActPedido = `<div class="wrapper-info-box-freelancer-buttons"><a href="#" class="main-button-style" onclick="aceitarPedido(${resultado.pedidoId})">Aceitar Pedido</a> <a href="#" class="main-button-style" onclick="rejeitarPedido()">Rejeitar Pedido</a></div>`

        $('.wrapper-info-box-freelancer').append(rejActPedido)
    } else if (resultado.aceitacao === 1 && resultado.pedido_conclusao === 0) {
        const rejActPedido = `<div class="wrapper-info-box-freelancer-buttons"><a href="#" class="main-button-style" onclick="pedidoConclusao(${resultado.pedidoId})">Concluir pedido</a> <a href="#" class="main-button-style" onclick="rejeitarPedido()">Cancelar Pedido</a></div>`

        $('.wrapper-info-box-freelancer').append(rejActPedido)
    } else if (resultado.conclusao === 1) {
        const rejActPedido = `<div class="wrapper-info-box-freelancer-buttons"><a href="#" id="pedidoFinalizado" class="main-button-style">Pedido Finalizado</a></div>`

        $('.wrapper-info-box-freelancer').append(rejActPedido)
        $('#pedidoFinalizado').css({
            'background-color': 'var(--purple)',
            'color': 'var(--black-blue)',
            'cursor': 'default',
            'user-select': 'none'
        })
    }
}

/* Função para verificar o status do pedido */
const pedidoStatus = (resultado) => {
    var status = (resultado.requisicao + resultado.aceitacao + resultado.pedido_conclusao + resultado.conclusao)
    switch (status) {
        case 1:
            status = 'Aguardando Aceitação'
            break;

        case 2:
            status = 'Aguardando pedido de conclusão'
            break;

        case 3:
            status = 'Esperando confimação de conclusão'
            break;

        case 4:
            status = 'Pedido concluido'
            break;
    }
    return status
}

/* Função para aceitar o pedido */
const aceitarPedido = (pedidoId) => {
    if (window.confirm('Deseja realmente aceitar esse pedido?')) {
        $.ajax({
            url: '../_server/pedidos/setPedidos.php',
            method: 'POST',
            data: {
                aceitarPedido: '',
                pedidoId: pedidoId
            },
            success: (result) => {
                window.alert(result.content)
                location.reload()
            }
        })
    }
}

/* Função para concluir o pedido */
const pedidoConclusao = (pedidoId) => {
    if (window.confirm('Deseja realmente concluir esse pedido?')) {
        $.ajax({
            url: '../_server/pedidos/setPedidos.php',
            method: 'POST',
            data: {
                pedidoConclusao: '',
                pedidoId: pedidoId
            },
            success: (result) => {
                window.alert(result.content)
                location.reload()
            }
        })
    }
}

const wrapperClose = () => {
    const pedidosWrapper = $('.pedidos-list-wrapper')
    pedidosWrapper.removeClass('active')
}

$(window).keyup((e) => {
    if (e.key == "Escape") {
        wrapperClose()
    }
})