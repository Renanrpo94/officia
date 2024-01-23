const openLoginWrapper = $('#login');
const loginWrapper = $('.login-wrapper');
const closeLoginWrapper = $('.close-login-wrapper');

openLoginWrapper.on('click', () => {
    loginWrapper.show();
})

$(window).keyup((e) => {
    if(e.key == "Escape") {
        loginWrapper.hide();
    }
})

closeLoginWrapper.on('click', () => {
    loginWrapper.hide();
})

/* Mobile */
$('#mobile-login').on("click", () => {
    loginWrapper.show();
})