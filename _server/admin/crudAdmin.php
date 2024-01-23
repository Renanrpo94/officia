<?php
class Admin
{
    /* Login Admin */
    public function loginAdmin($InfoAdmin, $pdo)
    {
        if (empty($InfoAdmin->getEmail()) || empty($InfoAdmin->getEmail())) {
            header('Content-Type: application/json');
            echo json_encode(['status' => '401', 'content' => 'Preencha todos os campos']);
            exit;
        }

        $stmt = $pdo->prepare('SELECT * FROM tb_admins WHERE email = :email AND senha = :senha');

        $stmt->bindValue(':email', $InfoAdmin->getEmail());
        $stmt->bindValue(':senha', $InfoAdmin->getSenha());
        $stmt->execute();
        $result = $stmt->rowCount();

        if ($result > 0) {
            $admin = $stmt->fetch(PDO::FETCH_OBJ);
            session_start();
            $_SESSION['admin'] = $admin;
            header('Content-Type: application/json');
            echo json_encode(['status' => '200']);
        } else {
            header('Content-Type: application/json');
            echo json_encode(['status' => '401', 'content' => 'Email ou senha errados.']);
        }
    }


    /* Create Admin */
    public function createAdmin($InfoAdmin, $pdo)
    {
        try {
            $stmt =  $pdo->prepare('INSERT INTO tb_admins(nome, sobrenome, cpf, nasc, cel, email, senha) VALUES (:nome, :sobrenome, :cpf, :nasc, :cel, :email, :senha)');

            $stmt->bindValue(':nome', $InfoAdmin->getNome());
            $stmt->bindValue(':sobrenome', $InfoAdmin->getSobrenome());
            $stmt->bindValue(':cpf', $InfoAdmin->getCpf());
            $stmt->bindValue(':nasc', $InfoAdmin->getNasc());
            $stmt->bindValue(':cel', $InfoAdmin->getCel());
            $stmt->bindValue(':email', $InfoAdmin->getEmail());
            $stmt->bindValue(':senha', $InfoAdmin->getSenha());

            if ($stmt->execute()) {
                header('Content-Type: application/json');
                echo json_encode(['status' => '200', 'content' => 'Admin registrado com sucesso!']);
                exit;
            }
        } catch (Exception $e) {
            header('Content-Type: application/json');
            echo json_encode(['content' => 'Já existe um usuário com esse email.', 'status' => '401']);
            exit;
        }
    }


    /* Listar Admins */
    public function listAdmins($pdo)
    {
        try {
            $stmt = $pdo->prepare('SELECT * FROM tb_admins');

            if ($stmt->execute()) {
                $result = $stmt->fetchAll(PDO::FETCH_OBJ);
                header('Content-Type: application/json');
                echo json_encode(['status' => '200', 'content' => $result]);
                exit;
            }
        } catch (Exception $e) {
            header('Content-Type: application/json');
            echo json_encode(['status' => '401', 'content' => "Aconteceu algum erro ao listar os anuncios! $e"]);
            exit;
        }
    }


    /* Editar Admin */
    public function editAdmin($InfoAdmin, $pdo)
    {
        try {
            $stmt = $pdo->prepare('UPDATE tb_admins SET nome=:nome, sobrenome=:sobrenome, cpf=:cpf, nasc=:nasc, cel=:cel, email=:email WHERE adminId=:adminId');

            $stmt->bindValue(':nome', $InfoAdmin->getNome());
            $stmt->bindValue(':sobrenome', $InfoAdmin->getSobrenome());
            $stmt->bindValue(':cpf', $InfoAdmin->getCpf());
            $stmt->bindValue(':nasc', $InfoAdmin->getNasc());
            $stmt->bindValue(':cel', $InfoAdmin->getCel());
            $stmt->bindValue(':email', $InfoAdmin->getEmail());
            $stmt->bindValue(':adminId', $InfoAdmin->getId());

            if ($stmt->execute()) {
                header('Content-Type: application/json');
                echo json_encode(['status' => '200', 'content' => 'Admin editado com sucesso!']);
                exit;
            }
        } catch (Exception $e) {
            header('Content-Type: application/json');
            echo json_encode(['status' => '401', 'content' => "Aconteceu algum erro ao editar o anuncio! $e"]);
            exit;
        }
    }


    /* Deletar Admin */
    public function deleteAdmin($InfoAdmin, $pdo)
    {
        try {
            $stmt = $pdo->prepare('DELETE FROM tb_admins WHERE adminId = :adminId');
            $stmt->bindValue(':adminId', $InfoAdmin->getId());

            if ($stmt->execute()) {
                header('Content-Type: application/json');
                echo json_encode(['status' => '200', 'content' => "Usuario excluido com sucesso!"]);
                exit;
            }
        } catch (PDOException $e) {
            header('Content-Type: application/json');
            echo json_encode(['status' => '401', 'content' => "Ocorreu um erro ao excluir o usuario!"]);
            exit;
        }
    }


    /* Listar Usuarios */
    public function listUsers($pdo)
    {
        try {
            $stmt = $pdo->prepare('SELECT 
            u.userId,
            u.nome,
            u.sobrenome,
            u.nasc,
            u.cpf,
            u.cel,
            u.email,
            f.freelancerId,
            u.desabilitado
            FROM tb_users u
            LEFT JOIN tb_freelancer f ON u.userId = f.userId ORDER BY u.desabilitado ASC');

            if ($stmt->execute()) {
                $result = $stmt->fetchAll(PDO::FETCH_OBJ);
                header('Content-Type: application/json');
                echo json_encode(['status' => '200', 'content' => $result]);
                exit;
            }
        } catch (Exception $e) {
            header('Content-Type: application/json');
            echo json_encode(['status' => '401', 'content' => "Aconteceu algum erro ao listar os anuncios! $e"]);
            exit;
        }
    }


    /* Listar Usuarios desabilitados*/
    public function listUsersDisable($pdo)
    {
        try {
            $stmt = $pdo->prepare('SELECT 
            u.userId,
            u.nome,
            u.sobrenome,
            u.nasc,
            u.cpf,
            u.cel,
            u.email,
            f.freelancerId,
            u.desabilitado
            FROM tb_users u
            LEFT JOIN tb_freelancer f ON u.userId = f.userId WHERE u.desabilitado = 1');

            if ($stmt->execute()) {
                $result = $stmt->fetchAll(PDO::FETCH_OBJ);
                header('Content-Type: application/json');
                echo json_encode(['status' => '200', 'content' => $result]);
                exit;
            }
        } catch (Exception $e) {
            header('Content-Type: application/json');
            echo json_encode(['status' => '401', 'content' => "Aconteceu algum erro ao listar os anuncios! $e"]);
            exit;
        }
    }


    /* Editar Usuario */
    public function editUser($InfoAdmin, $pdo)
    {
        try {
            $stmt = $pdo->prepare('UPDATE tb_users SET nome=:nome, sobrenome=:sobrenome, cpf=:cpf, nasc=:nasc, cel=:cel, email=:email WHERE userId=:userId');

            $stmt->bindValue(':nome', $InfoAdmin->getNome());
            $stmt->bindValue(':sobrenome', $InfoAdmin->getSobrenome());
            $stmt->bindValue(':cpf', $InfoAdmin->getCpf());
            $stmt->bindValue(':nasc', $InfoAdmin->getNasc());
            $stmt->bindValue(':cel', $InfoAdmin->getCel());
            $stmt->bindValue(':email', $InfoAdmin->getEmail());
            $stmt->bindValue(':userId', $InfoAdmin->getId());

            if ($stmt->execute()) {
                header('Content-Type: application/json');
                echo json_encode(['status' => '200', 'content' => 'Admin editado com sucesso!']);
                exit;
            }
        } catch (Exception $e) {
            header('Content-Type: application/json');
            echo json_encode(['status' => '401', 'content' => "Aconteceu algum erro ao editar o anuncio! $e"]);
            exit;
        }
    }


    /* Delete User */
    public function deleteUser($InfoAdmin, $pdo)
    {
        try {
            // $stmt = $pdo->prepare('DELETE FROM tb_users WHERE userId = :userId');
            $stmt = $pdo->prepare('UPDATE tb_users SET desabilitado=1 WHERE  userId=:userId');
            $stmt->bindValue(':userId', $InfoAdmin->getId());

            if ($stmt->execute()) {
                header('Content-Type: application/json');
                echo json_encode(['status' => '200', 'content' => "Usuario excluido com sucesso!"]);
                exit;
            }
        } catch (PDOException $e) {
            header('Content-Type: application/json');
            echo json_encode(['status' => '401', 'content' => "Ocorreu um erro ao excluir o usuario! $e"]);
            exit;
        }
    }


    /* Listar anuncios */
    public function listarAnuncios($pdo)
    {
        try {
            $stmt = $pdo->prepare('SELECT
                x.jobId,
                x.freelancerId,
                x.titulo,
                x.descricao,
                x.preco,
                x.foto,
                y.nome AS categoria,
                y.categoriaId
            FROM tb_freelancer_jobs AS x
            INNER JOIN tb_categorias AS y ON x.categoria = y.categoriaId');

            if ($stmt->execute()) {
                $result =  $stmt->fetchAll(PDO::FETCH_OBJ);
                header('Content-Type: application/json');
                echo json_encode(['status' => '200', 'content' => $result]);
                exit;
            }
        } catch (Exception $e) {
            header('Content-Type: application/json');
            echo json_encode(['status' => '401', 'content' => "Aconteceu algum erro ao listar os anuncios! $e"]);
            exit;
        }
    }
}
