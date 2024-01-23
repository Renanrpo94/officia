const listarAnuncio = () => {
    const jobSection = $('.jobs-section');

    $.ajax({
        url: '../_server/user/setUser.php',
        method: 'POST',
        data: {
            listarTodosAnuncios: ''
        },
        success: (result) => {
            if (result.status == '200') {
                jobSection.html('');
                result.content.forEach(anuncio => {
                    console.log(anuncio)
                    const job =
                        `<a href="job.php?id=${anuncio.jobId}" class="anuncio">
                            <div class="img-box">
                                <img src="../assets/uploads/${anuncio.foto}" alt="Foto do anuncio">    
                            </div>
                            <div class="desc">
                                <p>${anuncio.titulo}</p>
                                <p>${anuncio.descricao.substring(0, 75)}</p>
                                <p>Categoria: ${anuncio.categoria}</p>
                                <p>Preço: R$: ${anuncio.preco.toLocaleString('pt-br', { style: 'currency', currency: 'BRL' })}</p>
                            </div>
                        </a>`
                    jobSection.append(job)
                });
                resultAnuncio = result.content;
            }
        }
    })
};


const selectCategoria = $('#filtro-categoria');

function listarCategorias() {
    $.ajax({
        url: '../_server/freelancer/setFreelancer.php',
        method: 'POST',
        data: {
            listarCategorias: ''
        },
        success: (result) => {
            if (result.status == '200') {
                result.content.forEach(categoria => {
                    const newCategoria = `<option value="${categoria.categoriaId}">${categoria.nome}</option>`;
                    selectCategoria.append(newCategoria);
                })
            }
        }
    })
}


const listarAnuncioCategoria = (categoria) => {
    if(categoria == 0) {
        listarAnuncio()
        return
    }
    const jobSection = $('.jobs-section');

    $.ajax({
        url: '../_server/user/setUser.php',
        method: 'POST',
        data: {
            listarAnuncioCategoria: '',
            categoria: categoria
        },
        success: (result) => {
            if (result.status == '200') {
                jobSection.html('');
                result.content.forEach(anuncio => {
                    const job =
                        `<a href="job.php?id=${anuncio.jobId}" class="anuncio">
                            <div class="img-box">
                                <img src="../assets/uploads/${anuncio.foto}" alt="Foto do anuncio">    
                            </div>
                            <div class="desc">
                                <p>${anuncio.titulo}</p>
                                <p>${anuncio.descricao.substring(0, 75)}</p>
                                <p>Categoria: ${anuncio.categoria}</p>
                                <p>Preço: R$: ${anuncio.preco}</p>
                            </div>
                        </a>`
                    jobSection.append(job)
                });
                resultAnuncio = result.content;
            }
        }
    })
};

selectCategoria.on('change', () => {
    listarAnuncioCategoria(selectCategoria.val())
})

/* Carregar funções quando a pagina abrir */
$(document).ready(() => {
    listarCategorias();
    listarAnuncio();
})