<?php
class User
{
    /* Cadastrar o usuario */
    public function createUser($InfoUser, $pdo)
    {
        try {
            $stmt =  $pdo->prepare('INSERT INTO tb_users(nome, sobrenome, cpf, nasc, cel, email, senha) VALUES (:nome, :sobrenome, :cpf, :nasc, :cel, :email, :senha)');

            $stmt->bindValue(':nome', $InfoUser->getNome());
            $stmt->bindValue(':sobrenome', $InfoUser->getSobrenome());
            $stmt->bindValue(':cpf', $InfoUser->getCpf());
            $stmt->bindValue(':nasc', $InfoUser->getNasc());
            $stmt->bindValue(':cel', $InfoUser->getCel());
            $stmt->bindValue(':email', $InfoUser->getEmail());
            $stmt->bindValue(':senha', $InfoUser->getSenha());

            if ($stmt->execute()) {
                header('Content-Type: application/json');
                echo json_encode(['location' => '../index.php', 'status' => '200', 'content' => 'Usuário criado com sucesso']);
                exit;
            }
        } catch (Exception $e) {
            header('Content-Type: application/json');
            echo json_encode(['content' => 'Já existe um usuário com esse email.', 'status' => '401']);
            exit;
        }
    }

    /* Login Usuario */
    public function loginUser($InfoUser, $pdo)
    {
        $stmt = $pdo->prepare('SELECT * FROM tb_users WHERE email = :email AND senha = :senha');

        $stmt->bindValue(':email', $InfoUser->getEmail());
        $stmt->bindValue(':senha', $InfoUser->getSenha());

        $stmt->execute();
        $result = $stmt->rowCount();

        if ($result > 0) {
            $user = $stmt->fetch(PDO::FETCH_OBJ);
            $freelancer = $this->freelancerId($user->userId, $pdo);
            session_start();
            if ($freelancer != false) {
                $_SESSION['freelancer'] = $freelancer;
            }

            if ($user->desabilitado == 0) {
                $_SESSION['email'] = $InfoUser->getEmail();
                $_SESSION['senha'] = $InfoUser->getSenha();
                $_SESSION['user'] = $user;
                header('Content-Type: application/json');
                echo json_encode(['status' => '200']);
            } else {
                header('Content-Type: application/json');
                echo json_encode(['disable' => '1']);
            }
        } else {
            header('Content-Type: application/json');
            echo json_encode(['status' => '401']);
        }
    }

    /* Tornar usuario freelancer */
    public function userFreelancer($pdo)
    {
        try {
            session_start();
            $stmt = $pdo->prepare('INSERT INTO tb_freelancer (userId) VALUES (:userId)');
            $stmt->bindValue(':userId', $_SESSION['user']->userId);
            if ($stmt->execute()) {
                $freelancer = $this->freelancerId($_SESSION['user']->userId, $pdo);
                $_SESSION['freelancer'] = $freelancer;
                header('Content-Type: application/json');
                echo json_encode(['status' => '200', 'content' => 'Freelancer cadastrado com sucesso!']);
                exit;
            }
        } catch (Exception $e) {
            header('Content-Type: application/json');
            echo json_encode(['status' => '401', 'content' => "Aconteceu algum erro ao cadastrar freelancer!"]);
            exit;
        }
    }


    /* Reativar um usuario */
    public function activeUser($InfoUser, $pdo)
    {
        try {
            $stmt = $pdo->prepare('UPDATE tb_users SET desabilitado=0 WHERE email = :email AND senha = :senha');
            $stmt->bindValue(':email', $InfoUser->getEmail());
            $stmt->bindValue(':senha', $InfoUser->getSenha());

            if ($stmt->execute()) {
                header('Content-Type: application/json');
                echo json_encode(['status' => '200', 'content' => 'Conta reativada com sucesso, por favor relogue']);
            }
        } catch (Exception $e) {
            header('Content-Type: application/json');
            echo json_encode(['status' => '401', 'content' => "Aconteceu algum erro ao reativar a sua conta!"]);
            exit;
        }
    }

    /* Verifica se o usuario é um freelancer */
    public function freelancerId($userId, $pdo)
    {
        $stmt = $pdo->prepare('SELECT * FROM tb_users AS x INNER JOIN tb_freelancer AS y ON x.userId = y.userId WHERE y.userId = :userId');
        $stmt->bindValue(':userId', $userId);
        $stmt->execute();
        $result = $stmt->rowCount();

        if ($result > 0) {
            $freelancer = $stmt->fetch(PDO::FETCH_OBJ);
            return $freelancer;
        } else {
            return false;
        }
    }


    /* Lista todos os anuncios */
    public function listarTodosAnuncios($pdo)
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
            y.categoriaId,
            u.nome,
            u.sobrenome
        FROM
            tb_freelancer_jobs AS x
            INNER JOIN tb_categorias AS y ON x.categoria = y.categoriaId
            LEFT JOIN tb_freelancer AS f ON f.freelancerId = x.freelancerId
            LEFT JOIN tb_users AS u ON u.userId = f.userId WHERE u.desabilitado = 0');
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


    /* Lista todos os anuncios */
    public function listUniqAnuncio($jobId, $pdo)
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
                y.categoriaId,
                u.nome,
                u.sobrenome,
                u.email,
                u.cel,
                u.create_At,
                u.userId,
                u.foto AS profilePic
            FROM
                tb_freelancer_jobs AS x
                INNER JOIN tb_categorias AS y ON x.categoria = y.categoriaId
                LEFT JOIN tb_freelancer AS f ON f.freelancerId = x.freelancerId
                LEFT JOIN tb_users AS u ON u.userId = f.userId WHERE u.desabilitado = 0 AND x.jobId = :jobId');
            $stmt->bindValue(':jobId', $jobId);
            if ($stmt->execute()) {
                $result =  $stmt->fetch(PDO::FETCH_OBJ);
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


    /* Listar um unico anuncio */
    /* public function listUniqAnuncio($jobId, $pdo)
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
        FROM
            tb_freelancer_jobs AS x
            INNER JOIN tb_categorias AS y ON x.categoria = y.categoriaId
            LEFT JOIN tb_freelancer AS f ON f.freelancerId = x.freelancerId
            WHERE x.jobId = :jobId');
            $stmt->bindValue(':jobId', $jobId);
            if ($stmt->execute()) {
                $result =  $stmt->fetch(PDO::FETCH_OBJ);
                header('Content-Type: application/json');
                echo json_encode(['status' => '200', 'content' => $result]);
                exit;
            }
        } catch (Exception $e) {
            header('Content-Type: application/json');
            echo json_encode(['status' => '401', 'content' => "Aconteceu algum erro ao listar os anuncios! $e"]);
            exit;
        }
    } */


    /* Listar anuncios de uma categoria */
    public function listarAnuncioCategoria($categoria, $pdo)
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
        FROM
            tb_freelancer_jobs AS x
            INNER JOIN tb_categorias AS y ON x.categoria = y.categoriaId
            LEFT JOIN tb_freelancer AS f ON f.freelancerId = x.freelancerId
            LEFT JOIN tb_users AS u ON u.userId = f.userId WHERE u.desabilitado = 0 AND x.categoria = :categoria;');
            $stmt->bindValue(':categoria', $categoria);
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


    /* Listar um unico usuario */
    public function listUniqUser($userId, $pdo)
    {
        try {
            $stmt = $pdo->prepare('SELECT 
            u.userId,
            u.nome,
            u.sobrenome,
            u.cel,
            u.email,
            u.foto,
            f.freelancerId
            FROM tb_users u
            LEFT JOIN tb_freelancer f ON u.userId = f.userId WHERE u.userId = :userId');
            $stmt->bindValue(':userId', $userId);

            if ($stmt->execute()) {
                $result = $stmt->fetch(PDO::FETCH_OBJ);
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

    /* Logout */
    public function logoutUser()
    {
        session_start();
        session_unset();
        session_destroy();
    }

    /* Listar os usuarios */
    public function listUser($pdo)
    {
        try {
            $stmt = $pdo->prepare('SELECT * FROM tb_users ORDER BY user_id ASC');
            $stmt->execute();
            $result =  $stmt->fetchAll(PDO::FETCH_OBJ);
            return $result;
        } catch (PDOException $e) {
            echo "<script>
					alert('Ocorreu um erro ao listar os usuários: {$e->getMessage()}')
					window.history.back()
					</script>";
            return;
        }
    }


    public function deleteUser($InfoUser, $pdo)
    {
        try {
            $stmt = $pdo->prepare('DELETE FROM tb_users WHERE userId = :userId');
            $stmt->bindValue(':userId', $InfoUser->getUserId());

            if ($stmt->execute()) {
                echo "<script>
                    alert('Cliente Excluido com sucesso!')
                    window.history.back()
                    </script>";
                return;
            }
        } catch (PDOException $e) {
            echo "<script>
					alert('Ocorreu um erro ao listar os usuários: {$e->getMessage()}')
					window.history.back()
					</script>";
            return;
        }
    }


    public function changeProfilePic($InfoUser, $pdo)
    {
        try {
            $uploadDir = '../../assets/uploads/profilePic/';
            $extensao = pathinfo($InfoUser->getFile()['name'], PATHINFO_EXTENSION);
            $fileTempName = $InfoUser->getFile()['tmp_name'];
            $fileNewName = uniqid('', true) . ".$extensao";

            $stmt = $pdo->prepare('UPDATE tb_users SET foto = :foto WHERE userId = :userId');

            session_start();

            $stmt->bindValue(':userId', $_SESSION['user']->userId);
            $stmt->bindValue(':foto', $fileNewName);

            if ($stmt->execute()) {
                if (move_uploaded_file($fileTempName, $uploadDir . $fileNewName)) {
                    header('Content-Type: application/json');
                    echo json_encode(['location' => 'trabalhos.php', 'status' => '200', 'content' => 'Foto enviada com sucesso!']);
                    exit;
                }
            }
        } catch (Exception $e) {
            header('Content-Type: application/json');
            echo json_encode(['status' => '401', 'content' => "Aconteceu algum erro ao listar os anuncios! $e"]);
            exit;
        }
    }
}

function debug_to_console($data)
{
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}
