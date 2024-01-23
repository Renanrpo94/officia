var resultAdmin, resultUser, resultJobs, adminId, userId, jobId;
/* Funções parar abrir as section */
/* Section Lista Admin */
$('#admin-list').on('click', () => {
    openSection('admin-list')
})

/* Section Lista User */
$('#user-list').on('click', () => {
    openSection('user-list')
})

/* Section Lista Jobs */
$('#jobs-list').on('click', () => {
    openSection('jobs-list')
})

/* Section Lista Pedidos */
$('#pedidos-list').on('click', () => {
    openSection('pedidos-list');
})

/* Função para abrir as section */
const openSection = (list) => {
    const classList = $(`.${list}`);
    if(classList.hasClass('active')) {
        classList.removeClass('active')
    } else {
        $('section').removeClass('active')
        classList.addClass('active')
    }
}
/* ============================================================ */

/* Funções Ajax */

/* Listar Admins */
const listAdmins = () => {
    $.ajax({
        url: '../_server/admin/setAdmin.php',
        method: 'POST',
        data: {
            listAdmins: ''
        },
        success: (result) => {
            const adminList = $('#admin-list-item');
            adminList.html('');
            var adminHTML = '';
            result.content.forEach(admin => {
                let nasc = [];
                admin.nasc.split('-').map(v => nasc.unshift(v));
                nasc = nasc.join('/');
                adminHTML = `
                <tr>
                    <td>${admin.adminId}</td>
                    <td>${admin.nome}</td>
                    <td>${admin.sobrenome}</td>
                    <td>${nasc}</td>
                    <td>${admin.cpf}</td>
                    <td>${admin.cel}</td>
                    <td>${admin.email}</td>
                    <td class='edit-buttons'>
                        <i class='bx bx-edit-alt' onclick='editAdmin(${admin.adminId})'></i>
                        <i class='bx bx-trash' onclick='deleteAdmin(${admin.adminId})'></i>
                    </td>
                </tr>`;
                adminList.append(adminHTML);
            });
            resultAdmin = result.content
        }
    });
};

/* Listar Users */
const listUsers = () => {
    $.ajax({
        url: '../_server/admin/setAdmin.php',
        method: 'POST',
        data: {
            listUsers: ''
        },
        success: (result) => {
            const userList = $('#user-list-item');
            userList.html('')
            var userHTML = '';
            result.content.forEach(user => {
                let nasc = [];
                user.nasc.split('-').map(v => nasc.unshift(v));
                nasc = nasc.join('/');
                userHTML = `
                <tr>
                    <td>${user.userId}</td>
                    <td>${user.nome}</td>
                    <td>${user.sobrenome}</td>
                    <td>${nasc}</td>
                    <td>${user.cpf}</td>
                    <td>${user.cel}</td>
                    <td>${user.email}</td>
                    <td>${user.freelancerId}</td>
                    <td>${user.desabilitado == 0 ? 'Não' : 'Sim'}</td>
                    <td class='edit-buttons'>
                        <i class='bx bx-edit-alt' onclick='editUser(${user.userId})'></i>
                        <i class='bx bx-trash' onclick='deleteUser(${user.userId})'></i>
                    </td>
                </tr>`;
                userList.append(userHTML);
            });

            resultUser = result.content
        }
    });
};

/* Listar Trabalhos */
const listJobs = () => {
    $.ajax({
        url: '../_server/user/setUser.php',
        method: 'POST',
        data: {
            listarTodosAnuncios: ''
        },
        success: (result) => {
            const jobList = $('#jobs-list-item');
            jobList.html('')
            result.content.forEach(job => {
                var jobHTML = `
                <tr>
                    <td>${job.jobId}</td>
                    <td>${job.titulo}</td>
                    <td>${job.categoria}</td>
                    <td>${job.descricao}</td>
                    <td>R$ ${job.preco}</td>
                    <td>${job.freelancerId}</td>
                    <td>${job.nome} ${job.sobrenome}</td>
                    <td class='edit-buttons'>
                        <i class='bx bx-edit-alt' onclick='editJob(${job.jobId})'></i>
                        <i class='bx bx-trash' onclick='deleteJob(${job.jobId})'></i>
                    </td>
                </tr>`
                jobList.append(jobHTML)
            });

            resultJobs = result.content
        }
    })
}

/* Listar Pedidos */
const listPedidos = () => {
    $.ajax({
        url: '../_server/pedidos/setPedidos.php',
        method: 'POST',
        data: {
            allPedidos: ''
        },
        success: (result) => {
            const pedidoList = $('#pedidos-list-item');
            pedidoList.html('')
            result.content.forEach(pedido => {
                console.table(pedido)
                var status = (pedido.requisicao + pedido.aceitacao + pedido.pedido_conclusao + pedido.conclusao)
                switch(status) {
                    case 1:
                        status = 'Aguardando Aceitação'
                        break;
                    
                    case 2:
                        status = 'Aguardando pedido de conclusão'
                        break;
                    
                    case 3:
                        status = 'Esperando confimação de conclusão'
                        break;

                    case 4:
                        status = 'Pedido concluido'
                        break;
                }

                var pedidoHTML = `
                <tr>
                    <td>${pedido.pedidoId}</td>
                    <td>${pedido.userId}</td>
                    <td>${pedido.freelancerId}</td>
                    <td>${pedido.jobId}</td>
                    <td>${status}</td>
                    <td>${pedido.create_At}</td>
                    <td>${pedido.updated_at}</td>
                    <td class='edit-buttons'>
                        <i class='bx bx-edit-alt' onclick='editPedido(${pedido.pedidoId})'></i>
                        <i class='bx bx-trash' onclick='deletePedido(${pedido.pedidoId})'></i>
                    </td>
                </tr>`
                pedidoList.append(pedidoHTML)
            });
        }
    })
}
/* Listar Usuarios desabilitados */
$('#show-disable').on('click', () => {
    $.ajax({
        url: '../_server/admin/setAdmin.php',
        method: 'POST',
        data: {
            'listUsersDisable': ''
        },
        success: (result) => {
            if (result.content.length > 0) {
                $('#show-disable').css('display', 'none')
                $('#show-active').css('display', 'block')
                const userList = $('#user-list-item');
                userList.html('')
                var userHTML = '';
                result.content.forEach(user => {
                    let nasc = [];
                    user.nasc.split('-').map(v => nasc.unshift(v));
                    nasc = nasc.join('/');
                    userHTML = `
                <tr>
                    <td>${user.userId}</td>
                    <td>${user.nome}</td>
                    <td>${user.sobrenome}</td>
                    <td>${nasc}</td>
                    <td>${user.cpf}</td>
                    <td>${user.cel}</td>
                    <td>${user.email}</td>
                    <td>${user.freelancerId}</td>
                    <td>${user.desabilitado == 0 ? 'Não' : 'Sim'}</td>
                    <td class='edit-buttons'>
                        <i class='bx bx-edit-alt' onclick='editUser(${user.userId})'></i>
                        <i class='bx bx-trash' onclick='deleteUser(${user.userId})'></i>
                    </td>
                </tr>`;
                    userList.append(userHTML);
                });

                resultUser = result.content
            } else {
                alert('Nenhum usuario desabilitado!')
            }
        }
    });
})

/* Funções de envio de formulario */

/* Formulario de editar admin */
$('.form-edit').submit(function (e) {
    e.preventDefault();

    const formData = new FormData(this);

    if (adminId != undefined) {
        formData.append('editAdmin', '');
        formData.append('adminId', adminId);
        $.ajax({
            url: '../_server/admin/setAdmin.php',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'JSON',
            success: (result) => {
                if (result.status == '200') {
                    closeEditWrapper();
                }
            }
        })
    } else if (userId != undefined) {
        formData.append('editUser', '');
        formData.append('userId', userId);
        $.ajax({
            url: '../_server/admin/setAdmin.php',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'JSON',
            success: (result) => {
                if (result.status == '200') {
                    closeEditWrapper();
                }
            }
        })
    }


})
/* ============================================================ */


/* Funções de editar */

/* Editar Admin */
function editAdmin(x) {
    $('.edit-wrapper').addClass('active');
    resultAdmin.forEach(admin => {
        if (admin.adminId == x) {
            $('#nome').val(admin.nome);
            $('#sobrenome').val(admin.sobrenome);
            $('#cpf').val(admin.cpf);
            $('#nasc').val(admin.nasc);
            $('#cel').val(admin.cel);
            $('#email').val(admin.email);
            adminId = admin.adminId;
        }
    })
}

/* Editar User */
function editUser(x) {
    $('.edit-wrapper').addClass('active');
    resultUser.forEach(user => {
        if (user.userId == x) {
            $('#nome').val(user.nome);
            $('#sobrenome').val(user.sobrenome);
            $('#cpf').val(user.cpf);
            $('#nasc').val(user.nasc);
            $('#cel').val(user.cel);
            $('#email').val(user.email);
            userId = user.userId;
        }
    })
}
/* ============================================================ */


/* Funções de apagar */

/* Apagar Admin */
function deleteAdmin(x) {
    if (confirm(`Deseja realmente excluir esse admin? Admin Id:${x}`)) {
        $.ajax({
            url: '../_server/admin/setAdmin.php',
            method: 'POST',
            data: {
                deleteAdmin: '',
                adminId: x,
            },
            success: (result) => {
                console.log(result)
                closeEditWrapper()
            }
        })
    }
}

/* Apagar Usuario */
function deleteUser(x) {
    if (confirm(`Deseja realmente excluir esse admin? \nUser Id:${x}`)) {
        $.ajax({
            url: '../_server/admin/setAdmin.php',
            method: 'POST',
            data: {
                deleteUser: '',
                userId: x,
            },
            success: (result) => {
                closeEditWrapper()
            }
        })
    }
}


/* Fechar edit wrapper */
$('.close-edit-wrapper').on('click', () => {
    closeEditWrapper();
});

const closeEditWrapper = () => {
    $('.edit-wrapper').removeClass('active');
    adminId = undefined;
    userIdId = undefined;
    listAdmins();
    listUsers();
}
/* ============================================================ */


/* Funções dos botões da navbar */
const adminNavButtons = document.querySelectorAll('.admin-nav-buttons');

adminNavButtons.forEach(button => {
    button.addEventListener('click', () => {
        button.children[0].classList.toggle('active')
        adminNavButtons.forEach(buttons => {
            var adminNavDrop = buttons.children[0];
            if (button != buttons) {
                adminNavDrop.classList.remove('active')
            }
        })
    })
})

$(document).on('click', (e) => {
    console.log(e)
    const buttons = $('.admin-nav-buttons')
    buttons.each(function (i, button) {
        if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && !$(this.children[0]).is(e.target) && $(this.children[0]).hasClass('active')) {
            $(this.children).removeClass('active')
        }
    })
})
/* ============================================================ */

$('#show-active').on('click', () => {
    $('#show-active').css('display', 'none');
    $('#show-disable').css('display', 'block');
    listUsers();
})

/* Funções carregadas ao abrir a pagina */
$(document).ready(() => {
    listAdmins();
    listUsers();
    listJobs();
    listPedidos();
    $('.admin-list').addClass('active')
})