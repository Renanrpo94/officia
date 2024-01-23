const nome = $('.user-info-name');
const email = $('.free-info-contact-email');
const cel = $('.free-info-contact-cel');
const statusFree = $('.free-info-status');
const freeJobs = $('.free-jobs');
const profilePic = new Image();
const userInfoImg = $('.user-info-img');

const urlAtual = window.location.href;
const urlClass = new URL(urlAtual);
var userId = parseInt(urlClass.searchParams.get('id'));

/* Função para listar um usuario unico */
const listUniqUser = () => {

    $.ajax({
        url: '../_server/user/setUser.php',
        method: 'POST',
        data: {
            userId: userId,
            listUniqUser: ''
        },
        success: (result) => {
            var freelancer = null;
            var user = result.content;
            profilePic.src = `../assets/uploads/profilePic/${user.foto}`;
            userInfoImg.append(profilePic)
            nome.html(`${user.nome} ${user.sobrenome}`);
            email.append(user.email);
            cel.append(user.cel);
            if (user.freelancerId != null) {
                freelancer = 'Freelancer'
                statusFree.html(freelancer);
            } else {
                freelancer = 'Não é freelancer'
                statusFree.html(freelancer);
            }
        }
    })
}


/* Função para listar todos os anuncios de um freelancer */
const listarAnunciosFree = () => {
    $.ajax({
        url: '../_server/pedidos/setPedidos.php',
        method: 'POST',
        data: {
            userId: userId,
            listarAnunciosFree: ''
        },
        success: (result) => {
            const jobs = result.content;
            if (jobs.length > 0) {
                jobs.forEach(job => {
                    var descricao;
                    if (job.descricao.length > 25) {
                        descricao = `${job.descricao.substring(0, 25)}...`
                    } else {
                        descricao = job.descricao
                    }
                    const freeJobHTML = `
                    <a href='job.php?id=${job.jobId}' class="free-jobs-item">
                        <span class="free-jobs-item-id">#${job.jobId}</span>
                        <span class="free-jobs-item-title">${job.titulo}</span>
                        <span class="free-jobs-item-desc">${descricao}</span>
                        <span class="free-jobs-item-cat">${job.categoria}</span>
                        <span class="free-jobs-item-price">${job.preco.toLocaleString('pt-br', { style: 'currency', currency: 'BRL' })}</span>
                    </a>`
                    freeJobs.append(freeJobHTML)
                })
            }
        }
    })
};


/* Função para verificar se o perfil é o do usuario logado */
function verifyProfile() {
    $.ajax({
        url: '../_server/pedidos/setPedidos.php',
        method: 'POST',
        data: {
            userId: userId,
            verifyProfile: ''
        },
        success: (result) => {
            if (result.status === '200') {
                const uploadForm = `
                <form class="profile-pic" enctype="multipart/form-data">
                        <label for="uploadFile">
                            <i class='bx bx-pencil'></i>
                        </label>
                        <input type="file" name="uploadFile" id="uploadFile">
                    </form>`
                    userInfoImg.append(uploadForm)

                $('#uploadFile').on('change', (e) => {
                    const formData = new FormData($('.profile-pic')[0]);
                    formData.append('changeProfilePic', '')
                    $.ajax({
                        url: '../_server/user/setUser.php',
                        method: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        dataType: 'JSON',
                        success: (result) => {
                            listUniqUser();
                        }
                    })

                })
            } else {

            }
        }
    })
};


/* Função para executar funções ao abrir a página */
$(document).ready(() => {
    listUniqUser();
    listarAnunciosFree();
    verifyProfile();
})