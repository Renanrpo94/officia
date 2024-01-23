const newJob = `
<a href="novo-trabalho.php" class="new-job">
    <i class='bx bx-plus'></i>
    <p>Criar novo trabalho</p>
</a>`;

var resultAnuncio, jobId = null;
const editWrapper = $('.edit-wrapper');
const closeEditWrapper = $('.close-login-wrapper');

/* Listar anuncios */
const listarAnuncio = () => {
    const jobSection = $('.jobs-section');

    $.ajax({
        url: '../_server/freelancer/setFreelancer.php',
        method: 'POST',
        data: {
            listarAnuncio: ''
        },
        success: (result) => {
            if (result.status == '200') {
                jobSection.html('');
                result.content.forEach(anuncio => {
                    const job =
                        `<div href="" class="new-job job">
                            <div class="desc">
                                <p>${anuncio.titulo}</p>
                                <p>${anuncio.descricao.substring(0, 75)}</p>
                                <p>Categoria: ${anuncio.categoria}</p>
                                <p>Preço: ${anuncio.preco.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'})}</p>
                            </div>
                            <div class="job-buttons">
                                <button onclick="editarAnuncio(${anuncio.jobId})">Editar</button>
                                <button onclick="apagarAnuncio(${anuncio.jobId})">Apagar</button>
                            </div>
                        </div>`
                    jobSection.append(job)
                });
                jobSection.append(newJob)
                resultAnuncio = result.content;
            }
        }
    })
};

/* Carregar funções quando a pagina abrir */
$(document).ready(() => {
    listarAnuncio();
    listarCategorias();
})

/* Editar anuncio */
function editarAnuncio(x) {
    resultAnuncio.forEach(result => {
        if (result.jobId == x) {
            $('#titulo').val(result.titulo);
            $('#preco').val(result.preco);
            $('#categoria').val(result.categoriaId);
            $('#descricao').val(result.descricao);
            jobId = result.jobId;
            editWrapper.addClass('active');
        }
    })
}

$('.edit-box').submit(e => {
    e.preventDefault();

    var titulo = $('#titulo').val();
    var preco = $('#preco').val();
    var categoria = $('#categoria').val();
    var descricao = $('#descricao').val();

    $.ajax({
        url: '../_server/freelancer/setFreelancer.php',
        method: 'POST',
        data: {
            titulo: titulo,
            preco: preco,
            categoria: categoria,
            descricao: descricao,
            jobId: jobId,
            editarAnuncio: ''
        },
        success: (result) => {
            alertWrapper(result.content, listarAnuncio())
            editWrapper.removeClass('active');
        }
    });
});

/* Apagar anuncio */
function apagarAnuncio(x) {
    if (confirm('Você realmente deseja apagar esse anuncio?')) {
        $.ajax({
            url: '../_server/freelancer/setFreelancer.php',
            method: 'POST',
            data: {
                jobId: x,
                apagarAnuncio: '',
            },
            success: (result) => {
                alertWrapper(result.content, listarAnuncio());
            }
        })
    }
};

/* Listar categorias */
function listarCategorias() {
    $.ajax({
        url: '../_server/freelancer/setFreelancer.php',
        method: 'POST',
        data: {
            listarCategorias: ''
        },
        success: (result) => {
            if (result.status == '200') {
                const selectCategoria = $('#categoria');
                result.content.forEach(categoria => {
                    const newCategoria = `<option value="${categoria.categoriaId}">${categoria.nome}</option>`;
                    selectCategoria.append(newCategoria);
                })
            }
        }
    })
}

closeEditWrapper.on('click', () => {
    editWrapper.removeClass('active')
});


/* Função do alerta */
const alertWrapper = (content, x) => {
    const alertWrapper = $('.alert-wrapper');
    const alertMessage = $('.alert-wrapper>div');
    alertWrapper.fadeIn(1000).css('display', 'flex');
    alertMessage.html(content);
    setTimeout(() => {
        alertWrapper.fadeOut('Slow');
        x !== undefined ? x : null;
    }, 2000);
}