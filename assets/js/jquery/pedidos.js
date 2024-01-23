// Coleta de dados dos pedidos
var resultPedidos;
/* Função para listar todos os pedidos do usuario */
const pedidosUser = () => {
  $.ajax({
    url: '../_server/pedidos/setPedidos.php',
    method: 'POST',
    data: {
      pedidosUser: ''
    },
    success: (result) => {
      const pedidosList = $('.pedidos');
      if (result.content.length > 0) {
        resultPedidos = result.content;
        const pedidos = result.content;

        pedidos.forEach(pedido => {
          console.log(pedido)
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
        pedidosList.html('Você não tem nenhum pedido').css('font-size', '1.125em')
      }
    }
  });
}


/* Função para criar o wrapper de cada pedido */
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
                    <div class="wrapper-info-box-pedido-preco">R$${resultado.preco}</div>
                    <div class="wrapper-info-box-pedido-descricao">${resultado.descricao}</div>
                    <div class="wrapper-info-box-pedido-info">
                        #J${resultado.jobId}-F${resultado.freelancerId}-U${resultado.userId}-FU${resultado.free_userId}-P${resultado.pedidoId}
                    </div>
                </div>
                <div class="wrapper-info-box-freelancer">
                    <div class="wrapper-info-box-freelancer-container">
                        <div class="wrapper-info-box-freelancer-container-imagem">
                            <img src="https://picsum.photos/200/300" alt="Picsum">
                        </div>
                        <div>
                            <div class="wrapper-info-box-freelancer-container-nome">
                            ${resultado.free_nome} ${resultado.free_sobrenome}
                            </div>
                            <div class="wrapper-info-box-freelancer-container-email">
                            ${resultado.free_email}
                            </div>
                            <div class="wrapper-info-box-freelancer-container-cel">
                                ${resultado.free_cel}
                            </div>
                        </div>
                    </div>
                    <div class="wrapper-info-box-freelancer-buttons">
                        <a href="profile.php?id=${resultado.free_userId}"  class="main-button-style">Perfil</a>
                        <a href="job.php?id=${resultado.jobId}"  class="main-button-style">Anuncio</a>
                    </div>
                </div>
            </div>
        </div>`
  wrapper.html(wrapperHTML)
  if (resultado.pedido_conclusao === 1 && resultado.conclusao === 0) {
    const rejActPedido = `<div class="wrapper-info-box-freelancer-buttons"><a href="#" class="main-button-style" onclick="concluirPedido(${resultado.pedidoId})">Concluir Pedido</a> <a href="#" class="main-button-style" onclick="rejeitarPedido()">Abrir Disputa</a></div>`

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


/* Função para verificar o status de cada pedido */
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


/* Função para concluir Pedido */
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
        location.reload()
      }
    })
  }
}


/* Função para fechar o wrapper */
const wrapperClose = () => {
  const pedidosWrapper = $('.pedidos-list-wrapper')
  pedidosWrapper.removeClass('active')
}


/* Função para fechar o wrapper apertando ESC */
$(window).keyup((e) => {
  if (e.key == "Escape") {
    wrapperClose()
  }
})


/* Executa funções ao abrir a pagina */
$(document).ready(() => {
  pedidosUser()
});