$('#form-register').submit(function (e) {
    e.preventDefault();
    var email = $('#email').val();
    var senha = $('#senha').val();
    var confirmEmail = $('#confirm-email').val();
    var confirmSenha = $('#confirm-senha').val();
    const alertWrapper = $('.alert-wrapper');
    const alertMessage = $('.alert-wrapper>div');

    const verify = () => {
        if (email != confirmEmail || senha != confirmSenha) {
            alertWrapper.fadeIn(1000).css('display', 'flex');
            alertMessage.html('Email ou senha não coincidem')
            setInterval(() => {
                alertWrapper.fadeOut('Slow')
            }, 2000)
            return false
        } else if ($('#terms').prop('checked') == false) {
            alertWrapper.fadeIn(1000).css('display', 'flex');
            alertMessage.html('Os Termos de uso e Política de Privacidade não foram aceitos')
            setInterval(() => {
                alertWrapper.fadeOut('Slow')
            }, 2000)
            return false
        } else {
            return true
        }
    }

    if (verify()) {
        const formData = new FormData(this)
        formData.append('createAdmin', '')
        $.ajax({
            url: '../_server/admin/setAdmin.php',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'JSON',
            success: (result) => {
                if (result.status == '200') {
                    alertWrapper.fadeIn(1000).css('display', 'flex');
                    alertMessage.html('Admin registrado com sucesso')
                    setInterval(() => {
                        alertWrapper.fadeOut('Slow')
                        window.location.href = 'painelAdmin.php'
                    }, 2000)
                }
            }
        })
    }
})