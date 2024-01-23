create DATABASE officia;

use officia;

create table
    tb_users (
        userId INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        nome VARCHAR(40) NOT NULL,
        sobrenome VARCHAR(80) NOT NULL,
        cpf VARCHAR(14) NOT NULL,
        nasc DATE NOT NULL,
        cel VARCHAR(12) NOT NULL,
        email VARCHAR(80) unique NOT NULL,
        senha CHAR(32) NOT NULL,
        freelancerId INT DEFAULT NULL,
        desabilitado INT DEFAULT '0' NOT NULL,
        foto VARCHAR(50) DEFAULT 'default.png' NOT NULL,
        create_At TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
        updated_At DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    );

create table
    tb_admins (
        adminId INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        create_At TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
        updated_At DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        nome VARCHAR(40) NOT NULL,
        sobrenome VARCHAR(80) NOT NULL,
        cpf VARCHAR(14) NOT NULL,
        nasc DATE NOT NULL,
        cel VARCHAR(12) NOT NULL,
        email VARCHAR(80) unique NOT NULL,
        senha CHAR(32) NOT NULL
    );

create table
    tb_freelancer (
        freelancerId INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        userId INT NOT NULL UNIQUE,
        FOREIGN KEY (userId) references tb_users (userId),
        create_At TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
    );

create table
    tb_endereco (
        ederecoId INT PRIMARY KEY AUTO_INCREMENT NOT NULL UNIQUE,
        userId INT NOT NULL,
        FOREIGN KEY (userId) REFERENCES tb_users (userId),
        nome VARCHAR(120) NOT NULL,
        telefone VARCHAR(16),
        cep CHAR(8) NOT NULL,
        rua VARCHAR(80) NOT NULL,
        numero VARCHAR(10) NOT NULL,
        complemento VARCHAR(10),
        bairro VARCHAR(40) NOT NULL,
        cidade VARCHAR(40) NOT NULL,
        uf CHAR(2) NOT NULL
    );

create table
    tb_freelancer_jobs (
        jobId INT PRIMARY KEY AUTO_INCREMENT NOT NULL UNIQUE,
        freelancerId INT NOT NULL,
        FOREIGN KEY (freelancerId) REFERENCES tb_freelancer (freelancerId),
        titulo VARCHAR(40) NOT NULL,
        descricao varchar(255) NOT NULL,
        preco FLOAT(8, 2) NOT NULL,
        categoria VARCHAR(30) NOT NULL,
        foto VARCHAR(50),
        create_At TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
        updated_At DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    );

create table
    tb_categorias (
        categoriaId INT PRIMARY KEY AUTO_INCREMENT NOT NULL UNIQUE,
        nome VARCHAR(40) NOT NULL,
        create_At TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
    );

create table
    tb_pedidos (
        pedidoId INT PRIMARY KEY AUTO_INCREMENT NOT NULL UNIQUE,
        userId INT NOT NULL,
        FOREIGN KEY (userId) REFERENCES tb_users (userId),
        freelancerId INT NOT NULL,
        FOREIGN KEY (freelancerId) REFERENCES tb_freelancer_jobs (freelancerId),
        jobId INT NOT NULL,
        FOREIGN KEY (jobId) REFERENCES tb_freelancer_jobs (jobId),
        requisicao INT DEFAULT 0,
        aceitacao INT DEFAULT 0,
        pedido_conclusao INT DEFAULT 0,
        conclusao INT DEFAULT 0,
        concluido INT DEFAULT 0,
        create_At TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
        updated_At DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    );
    
INSERT INTO
tb_categorias (nome)
VALUES ('Tatuador'), ('Faxineira'), ('Técnico informatica'), ('Pedreiro'), ('Mecânico'), ('Pintor'), ('Cabelereiro'), ('Web Design'), ('Programador');

INSERT INTO
    `officia`.`tb_admins` (
        `nome`,
        `sobrenome`,
        `cpf`,
        `nasc`,
        `cel`,
        `email`,
        `senha`
    )
VALUES (
        'Etec',
        'TCC',
        '123',
        '2000-01-14',
        '123',
        'etec@email.com',
        '202cb962ac59075b964b07152d234b70'
    );

SELECT
    x.jobId,
    x.freelancerId,
    x.titulo,
    x.descricao,
    x.preco,
    y.nome AS categoria
FROM tb_freelancer_jobs AS x
    INNER JOIN tb_categorias AS y ON x.categoria = y.categoriaId
WHERE x.freelancerId = 1;

SELECT
    u.userId,
    u.nome,
    u.sobrenome,
    u.cel,
    u.email,
    f.freelancerId
FROM tb_users u
    LEFT JOIN tb_freelancer f ON u.userId = f.userId
WHERE u.userId = 90;

SELECT
    x.jobId,
    x.freelancerId,
    x.titulo,
    x.descricao,
    x.preco,
    x.foto,
    y.nome AS categoria,
    y.categoriaId
FROM tb_freelancer_jobs AS x
    INNER JOIN tb_categorias AS y ON x.categoria = y.categoriaId
    LEFT JOIN tb_freelancer AS f ON f.freelancerId = x.freelancerId
    LEFT JOIN tb_users AS u ON u.userId = f.userId
WHERE u.desabilitado = 0;

SELECT
    p.pedidoId,
    p.userId,
    p.freelancerId,
    p.jobId,
    p.requisicao,
    p.aceitacao,
    p.pedido_conclusao,
    p.conclusao,
    p.create_At,
    p.updated_at,
    fj.titulo,
    fj.descricao,
    fj.preco,
    fj.categoria AS categoriaId,
    fj.foto,
    c.nome AS categoria,
    u.nome,
    u.sobrenome,
    u.cel,
    u.email,
    fu.userId AS free_userId,
    fu.nome AS free_nome,
    fu.sobrenome AS free_sobrenome,
    fu.cel AS free_cel,
    fu.email AS free_email
FROM tb_pedidos AS p
    INNER JOIN tb_users AS u ON p.`userId` = u.`userId`
    INNER JOIN tb_freelancer as f ON f.`freelancerId` = p.`freelancerId`
    INNER JOIN tb_users AS fu ON f.`userId` = fu.`userId`
    INNER JOIN tb_freelancer_jobs AS fj ON p.`jobId` = fj.`jobId`
    INNER JOIN tb_categorias AS c ON fj.`categoria` = c.`categoriaId`
WHERE fu.`userId` = 91

SELECT
    f.userId,
    fj.freelancerId,
    fj.jobId,
    fj.titulo,
    fj.descricao,
    fj.preco,
    c.nome AS categoria,
    fj.foto,
    fj.categoria AS categoriaId
FROM tb_freelancer_jobs AS fj
INNER JOIN tb_freelancer AS f ON fj.freelancerId = f.freelancerId
INNER JOIN tb_categorias AS c ON fj.categoria = c.categoriaId
WHERE f.userId = 63