/* Função para usuário se fornar freelancer */

$('#terms').submit((e) => {
    e.preventDefault();

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
            url: '../_server/user/setUser.php',
            method: 'POST',
            data: {
                userFreelancer: ''
            },
            success: (result) => {
                if (result.status == '200') {
                    alertWrapper.fadeIn(1000).css('display', 'flex');
                    alertMessage.html(result.content);
                    setTimeout(() => {
                        alertWrapper.fadeOut(1000)
                        window.history.back()
                    }, 2000)
                } else if (result.status == '401') {
                    console.log(result.content)
                }
            }
        })
    }
})