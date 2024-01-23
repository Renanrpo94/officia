$('#jobs-register').submit(function (e) {
    e.preventDefault();

    const formData = new FormData(this);
    formData.append('criarAnuncio', '');

    const alertWrapper = $('.alert-wrapper');
    const alertMessage = $('.alert-wrapper>div');
    const checkbox = $('#check-terms')[0];

    if (checkbox.checked == false) {
        alertWrapper.fadeIn(1000).css('display', 'flex');
        alertMessage.html('Os Termos de uso e Política de Privacidade não foram aceitos')
        setTimeout(() => {
            alertWrapper.fadeOut(1000)
        }, 2000)
        return result = false
    } else {
        $.ajax({
            url: '../_server/freelancer/setFreelancer.php',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'JSON',
            success: (result) => {
                if (result.status == '200') {
                    alertWrapper.fadeIn(1000).css('display', 'flex');
                    alertMessage.html(result.content);
                    setInterval(() => {
                        alertWrapper.fadeOut('Slow');
                        window.location.href = result.location;
                    }, 2000)
                } else if (result.status == '401') {
                    console.log(result.pdo);
                }
            }
        })
    }
})

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

$(document).ready(() => {
    listarCategorias();
})