const body = $('body');
const lightModeButton = $('.light-mode-button');
const logoDarkMode = $('#logo-dark-mode')
const logoLightMode = $('#logo-light-mode')

const bodyVerify = () => {
    return body.hasClass('light') ? true : false
}

const logoToggler = () => {
    if (bodyVerify() === true) {
        logoLightMode.show()
        logoDarkMode.hide()
        lightModeButton.html(`<i class='bx bxs-moon'></i>`)
    } else {
        logoLightMode.hide()
        logoDarkMode.show()
        lightModeButton.html(`<i class='bx bxs-sun'></i>`)
    }
}

const retrieveTheme = () => {
    const theme = localStorage.getItem('website-theme')
    if (theme != null) {
        body.removeClass('default light').addClass(theme)
    }
    logoToggler()
}

const detectTheme = () => {
    if (window.matchMedia('(prefers-color-scheme: light)').matches) {
        body.addClass('light')
        retrieveTheme()
    } else {
        body.removeClass('light')
        retrieveTheme()
    }
}

window.matchMedia('(prefers-color-scheme: light)').addEventListener('change', () => {
    detectTheme()
})

lightModeButton.on('click', () => {
    body.toggleClass('light')
    if (bodyVerify() === true) {
        localStorage.setItem('website-theme', 'light')
        logoToggler()
    } else {
        localStorage.setItem('website-theme', 'default')
        logoToggler()
    }
})

$(document).ready( () => {
    detectTheme()
    retrieveTheme()
})