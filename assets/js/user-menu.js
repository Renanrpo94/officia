var userMenu = $('.user-menu')
var menuButton = $('#menu-button')
menuButton.on('click', (e) => {
    userMenu.toggleClass('active');
})

$(document).on('click', (e) => {
    if(!userMenu.is(e.target) && userMenu.has(e.target).length === 0 && userMenu.hasClass('active') && !menuButton.is(e.target)) {
        userMenu.removeClass('active')
    }
})


/* Função para fazer logout */
$('#logout').on('click', () => {
    $.ajax({
        url: '../_server/user/setUser.php',
        method: 'POST',
        data: {
            logoutUser: ''
        },
        success: (result) => {
            window.location.reload();
        }
    })
})

//Logout Mobile
$('#mobile-logout').on('click', () => {
    $.ajax({
        url: '../_server/user/setUser.php',
        method: 'POST',
        data: {
            logoutUser: ''
        },
        success: (result) => {
            window.location.reload();
        }
    })
})