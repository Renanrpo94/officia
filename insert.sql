/* Categorias */
INSERT INTO
    tb_categorias (nome)
VALUES ('Tatuador'), ('Faxineira'), ('Técnico informatica'), ('Pedreiro'), ('Mecânico'), ('Pintor'), ('Cabelereiro'), ('Web Design'), ('Programador');

/* Admin */
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
/* User */
INSERT INTO
    `officia`.`tb_users` (
        `nome`,
        `sobrenome`,
        `cpf`,
        `nasc`,
        `cel`,
        `email`,
        `senha`
    )
VALUES (
        'Luis',
        'TCC',
        '123',
        '2000-01-14',
        '123',
        'Etec@email.com',
        '202cb962ac59075b964b07152d234b70'
    );