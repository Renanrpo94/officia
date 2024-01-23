<?php
class Freelancer
{
    /* Criar anuncio */
    public function criarAnuncio($InfoFreelancer, $pdo)
    {
        try {
            $uploadDir = '../../assets/uploads/';
            $extensao = pathinfo($InfoFreelancer->getFile()['name'], PATHINFO_EXTENSION);
            $fileTempName = $InfoFreelancer->getFile()['tmp_name'];
            $fileNewName = uniqid('', true) . ".$extensao";

            $stmt = $pdo->prepare('INSERT INTO tb_freelancer_jobs(freelancerId, titulo, descricao, preco, categoria, foto) VALUES (:freelancerId, :titulo, :descricao, :preco, :categoria, :foto)');

            session_start();
            $stmt->bindValue(':freelancerId', $_SESSION['freelancer']->freelancerId);
            $stmt->bindValue(':titulo', $InfoFreelancer->getTitulo());
            $stmt->bindValue(':descricao', $InfoFreelancer->getDescricao());
            $stmt->bindValue(':preco', $InfoFreelancer->getPreco());
            $stmt->bindValue(':categoria', $InfoFreelancer->getCategoria());
            $stmt->bindValue(':foto', $fileNewName);

            if ($stmt->execute()) {
                if (move_uploaded_file($fileTempName, $uploadDir . $fileNewName)) {
                    header('Content-Type: application/json');
                    echo json_encode(['location' => 'trabalhos.php', 'status' => '200', 'content' => 'Anuncio criado com sucesso']);
                    exit;
                }
            }
        } catch (Exception $e) {
            header('Content-Type: application/json');
            echo json_encode(['content' => "Ocorreu um erro ao criar seu anuncio!", 'status' => '401', 'pdo' => "$e"]);
            exit;
        }
    }


    /* Listar anuncios */
    public function listarAnuncio($pdo)
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
        INNER JOIN tb_categorias AS y ON x.categoria = y.categoriaId WHERE x.freelancerId = :freelancerId;');

            session_start();
            $stmt->bindValue(':freelancerId', $_SESSION['freelancer']->freelancerId);

            if ($stmt->execute()) {
                $result =  $stmt->fetchAll(PDO::FETCH_OBJ);
                header('Content-Type: application/json');
                echo json_encode(['status' => '200', 'content' => $result]);
                exit;
            }
        } catch (Exception $e) {
            header('Content-Type: application/json');
            echo json_encode(['status' => '401', 'content' => "Aconteceu algum erro ao listar os anuncios!"]);
            exit;
        }
    }


    /* Editar Anuncio */
    public function editarAnuncio($InfoFreelancer, $pdo)
    {
        try {
            $stmt = $pdo->prepare('UPDATE tb_freelancer_jobs SET titulo=:titulo, descricao=:descricao, preco=:preco, categoria=:categoria WHERE jobId = :jobId');

            $stmt->bindValue(':titulo', $InfoFreelancer->getTitulo());
            $stmt->bindValue(':descricao', $InfoFreelancer->getDescricao());
            $stmt->bindValue(':preco', $InfoFreelancer->getPreco());
            $stmt->bindValue(':categoria', $InfoFreelancer->getCategoria());
            $stmt->bindValue(':jobId', $InfoFreelancer->getJobId());


            if ($stmt->execute()) {
                header('Content-Type: application/json');
                echo json_encode(['status' => '200', 'content' => 'Anuncio editado com sucesso!']);
                exit;
            }
        } catch (Exception $e) {
            header('Content-Type: application/json');
            echo json_encode(['status' => '401', 'content' => "Aconteceu algum erro ao editar o anuncio! $e"]);
            exit;
        }
    }


    /* Apagar anuncio */
    public function apagarAnuncio($InfoFreelancer, $pdo)
    {
        try {
            $stmt = $pdo->prepare('DELETE FROM tb_freelancer_jobs WHERE jobId = :jobId');

            $stmt->bindValue(':jobId', $InfoFreelancer->getJobId());

            if ($stmt->execute()) {
                header('Content-Type: application/json');
                echo json_encode(['status' => '200', 'content' => 'Anuncio excluido com sucesso!']);
                exit;
            }
        } catch (Exception $e) {
            header('Content-Type: application/json');
            echo json_encode(['status' => '401', 'content' => "Aconteceu algum erro ao excluir o anuncio! $e"]);
            exit;
        }
    }

    public function listarCategorias($pdo)
    {
        try {
            $stmt = $pdo->prepare('SELECT * FROM tb_categorias ORDER BY nome ASC');

            if ($stmt->execute()) {
                $result =  $stmt->fetchAll(PDO::FETCH_OBJ);
                header('Content-Type: application/json');
                echo json_encode(['status' => '200', 'content' => $result]);
                exit;
            }
        } catch (Exception $e) {
            header('Content-Type: application/json');
            echo json_encode(['status' => '401', 'content' => "Aconteceu algum erro ao listar as categorias! $e"]);
            exit;
        }
    }
}
