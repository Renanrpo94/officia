$('#form-register').submit((e) => {
    e.preventDefault();

    var nome = $('#nome').val();
    var sobrenome = $('#sobrenome').val();
    var cpf = $('#cpf').val();
    var nasc = $('#nasc').val();
    var cel = $('#cel').val();
    var email = $('#email').val();
    var senha = $('#senha').val();
    var confirmEmail = $('#confirm-email').val();
    var confirmSenha = $('#confirm-senha').val();
    const alertWrapper = $('.alert-wrapper');
    const alertMessage = $('.alert-wrapper>div');

    const verifyInput = () => {
        const inputs = document.querySelectorAll('.register-section input')
        var result = true
        inputs.forEach(input => {
            if (input.value == '') {
                input.setAttribute('placeholder', 'Campo Obrigatório')
                input.classList.add('alert')
                input.addEventListener('focus', () => {
                    input.classList.contains('alert') ? input.classList.remove('alert') : null
                })
                return result = false
            }

            var checkbox = null
            input.type == 'checkbox' ? checkbox = input : ''
            if (checkbox != null) {
                if (checkbox.checked == false) {
                    alertWrapper.fadeIn(1000).css('display', 'flex');
                    alertMessage.html('Os Termos de uso e Política de Privacidade não foram aceitos')
                    setTimeout(() => {
                        alertWrapper.fadeOut(1000)
                    }, 2000)
                    return result = false
                }
            }
        })
        return result
    }

    const verifyMailPass = () => {
        if (email != confirmEmail || senha != confirmSenha) {
            alertWrapper.fadeIn(1000).css('display', 'flex');
            alertMessage.html('Email ou senha não coincidem')
            setInterval(() => {
                alertWrapper.fadeOut('Slow')
            }, 2000)
            return false
        } else {
            return true
        }
    }

    if (verifyInput() == true && verifyMailPass() == true) {
        $.ajax({
            url: '../_server/user/setUser.php',
            method: 'POST',
            data: {
                nome: nome,
                sobrenome: sobrenome,
                cpf: cpf,
                nasc: nasc,
                cel: cel,
                email: email,
                senha: senha,
                createUser: ''
            },
            success: (result) => {
                if (result.status == '200') {
                    alertWrapper.fadeIn(1000).css('display', 'flex');
                    alertMessage.html(result.content);
                    setInterval(() => {
                        alertWrapper.fadeOut('Slow');
                        window.location.href = result.location;
                    }, 2000)
                } else if (result.status == "401") {
                    alertWrapper.fadeIn(1000).css('display', 'flex');
                    alertMessage.html(result.content);
                    setInterval(() => {
                        alertWrapper.fadeOut('Slow');
                    }, 2000)
                }
            }
        })
    }
})