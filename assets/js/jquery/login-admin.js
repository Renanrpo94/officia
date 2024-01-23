$('.login').submit(function (e) {
    e.preventDefault();

    const alertWrapper = $('.alert-wrapper');
    const alertMessage = $('.alert-wrapper>div');
    const formData = new FormData(this);
    formData.append('loginAdmin', '');

    $.ajax({
        url: '_server/admin/setAdmin.php',
        method: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        dataType: 'JSON',
        success: (result) => {
            if (result.status == '200') {
                window.location.href = 'content/painelAdmin.php';
            } else if (result.status == '401') {
                alertWrapper.fadeIn(1000).css('display', 'flex');
                alertMessage.html(result.content);
                setTimeout(() => {
                    alertWrapper.fadeOut(1000);
                }, 2000)
            }
        }
    })
})