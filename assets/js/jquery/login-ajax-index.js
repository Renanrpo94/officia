$('.login').submit((e) => {
    e.preventDefault();

    var email = $('#email-user').val();
    var senha = $('#senha-user').val();
    const alertWrapper = $('.alert-wrapper');
    const alertMessage = $('.alert-wrapper>div');


    $.ajax({
        url: '_server/user/setUser.php',
        method: 'POST',
        data: {
            email: email,
            senha: senha,
            loginUser: ''
        },
        success: (result) => {
            if (result.status == '200') {
                window.location.href = 'content/home.php';
            } else if (result.disable == 1) {
                if (confirm('Deseja reabilitar a sua conta?')) {
                    $.ajax({
                        url: '_server/user/setUser.php',
                        method: 'POST',
                        data: {
                            email: email,
                            senha: senha,
                            activeUser: ''
                        },
                        success: (result) => {
                            alertWrapper.fadeIn(1000).css('display', 'flex');
                            alertMessage.html(result.content);
                            setTimeout(() => {
                                alertWrapper.fadeOut(1000);
                            }, 2000)
                        }
                    })
                } else {
                    $.ajax({
                        url: '_server/user/setUser.php',
                        method: 'POST',
                        data: {
                            logoutUser: ''
                        },
                        success: (result) => {
                            window.location.reload();
                        }
                    })
                }
            } else if (result.status == '401') {
                alertWrapper.fadeIn(1000).css('display', 'flex');
                alertMessage.html('Email ou senha errados.');
                setTimeout(() => {
                    alertWrapper.fadeOut(1000);
                }, 2000)
            }
        }
    })
})