<?php
class Pedidos
{
    /* Criar requisição */
    public function requisicao($InfoPedidos, $pdo)
    {
        try {
            session_start();
            $stmt = $pdo->prepare('INSERT INTO tb_pedidos (userId, freelancerId, jobId, requisicao) VALUES (:userId, :freelancerId, :jobId, :requisicao)');

            $stmt->bindValue(':userId', $_SESSION['user']->userId);
            $stmt->bindValue(':freelancerId', $InfoPedidos->getFreelancerId());
            $stmt->bindValue(':jobId', $InfoPedidos->getJobId());
            $stmt->bindValue(':requisicao', $InfoPedidos->getRequisicao());

            if ($stmt->execute()) {
                header('Content-Type: application/json');
                echo json_encode(['status' => '200', 'content' => 'Requisição criada com sucesso']);
                exit;
            }
        } catch (Exception $e) {
            header('Content-Type: application/json');
            echo json_encode(['content' => "Ocorreu um erro ao criar sua requisição!", 'status' => '401', 'pdo' => "$e"]);
            exit;
        }
    }

    public function verificarPedido($pdo)
    {
        try {
            session_start();
            $stmt = $pdo->prepare('SELECT * FROM tb_pedidos WHERE userId = :userId AND concluido = 0');

            $stmt->bindValue(':userId', $_SESSION['user']->userId);

            if ($stmt->execute()) {
                $result =  $stmt->fetchAll(PDO::FETCH_OBJ);
                header('Content-Type: application/json');
                echo json_encode(['status' => '200', 'content' => $result]);
                exit;
            }
        } catch (Exception $e) {
            header('Content-Type: application/json');
            echo json_encode(['content' => "Ocorreu um erro ao criar sua requisição!", 'status' => '401', 'pdo' => "$e"]);
            exit;
        }
    }

    public function pedidosUser($pdo)
    {
        try {
            session_start();
            $stmt = $pdo->prepare('SELECT
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
        WHERE p.`userId` = :userId');

            $stmt->bindValue(':userId', $_SESSION['user']->userId);

            if ($stmt->execute()) {
                $result =  $stmt->fetchAll(PDO::FETCH_OBJ);
                header('Content-Type: application/json');
                echo json_encode(['status' => '200', 'content' => $result]);
                exit;
            }
        } catch (Exception $e) {
            header('Content-Type: application/json');
            echo json_encode(['content' => "Ocorreu um erro ao criar sua requisição!", 'status' => '401', 'pdo' => "$e"]);
            exit;
        }
    }


    public function pedidosFree($InfoPedidos, $pdo)
    {
        try {
            session_start();
            $stmt = $pdo->prepare('SELECT
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
        WHERE fu.`userId` = :userId');

            $stmt->bindValue(':userId', $InfoPedidos->getUserId());

            if ($stmt->execute()) {
                $result =  $stmt->fetchAll(PDO::FETCH_OBJ);
                header('Content-Type: application/json');
                echo json_encode(['status' => '200', 'content' => $result]);
                exit;
            }
        } catch (Exception $e) {
            header('Content-Type: application/json');
            echo json_encode(['content' => "Ocorreu um erro ao criar sua requisição!", 'status' => '401', 'pdo' => "$e"]);
            exit;
        }
    }


    public function allPedidos($pdo)
    {
        try {
            $stmt = $pdo->prepare('SELECT * FROM tb_pedidos');

            if ($stmt->execute()) {
                $result =  $stmt->fetchAll(PDO::FETCH_OBJ);
                header('Content-Type: application/json');
                echo json_encode(['status' => '200', 'content' => $result]);
                exit;
            }
        } catch (Exception $e) {
            header('Content-Type: application/json');
            echo json_encode(['content' => "Ocorreu um erro ao criar sua requisição!", 'status' => '401', 'pdo' => "$e"]);
            exit;
        }
    }


    public function aceitarPedido($InfoPedidos, $pdo)
    {
        try {
            $stmt = $pdo->prepare('UPDATE tb_pedidos SET aceitacao = :aceitacao WHERE pedidoId = :pedidoId');

            $stmt->bindValue(':aceitacao', $InfoPedidos->getAceitacao());
            $stmt->bindValue(':pedidoId', $InfoPedidos->getPedidoId());

            if ($stmt->execute()) {
                header('Content-Type: application/json');
                echo json_encode(['status' => '200', 'content' => 'Pedido aceito com sucesso']);
                exit;
            }
        } catch (Exception $e) {
            header('Content-Type: application/json');
            echo json_encode(['content' => "Ocorreu um erro ao criar sua requisição!", 'status' => '401', 'pdo' => "$e"]);
            exit;
        }
    }


    public function pedidoConclusao($InfoPedidos, $pdo)
    {
        try {
            $stmt = $pdo->prepare('UPDATE tb_pedidos SET pedido_conclusao = :pedidoConclusao WHERE pedidoId = :pedidoId');

            $stmt->bindValue(':pedidoConclusao', $InfoPedidos->getPedidoConclusao());
            $stmt->bindValue(':pedidoId', $InfoPedidos->getPedidoId());
            
            if ($stmt->execute()) {
                header('Content-Type: application/json');
                echo json_encode(['status' => '200', 'content' => 'Pedido de conclusão enviado com sucesso']);
                exit;
            }
        } catch (Exception $e) {
            header('Content-Type: application/json');
            echo json_encode(['content' => "Ocorreu um erro ao criar sua requisição!", 'status' => '401', 'pdo' => "$e"]);
            exit;
        }
    }
    
    
    public function concluirPedido($InfoPedidos, $pdo)
    {
        try {
            $stmt = $pdo->prepare('UPDATE tb_pedidos SET conclusao = :conclusao WHERE pedidoId = :pedidoId');
            $stmt->bindValue(':conclusao', $InfoPedidos->getConclusao());
            $stmt->bindValue(':pedidoId', $InfoPedidos->getPedidoId());

            if ($stmt->execute()) {
                header('Content-Type: application/json');
                echo json_encode(['status' => '200', 'content' => 'Pedido concluido com sucesso']);
                exit;
            }
        } catch (Exception $e) {
            header('Content-Type: application/json');
            echo json_encode(['content' => "Ocorreu um erro ao criar sua requisição!", 'status' => '401', 'pdo' => "$e"]);
            exit;
        }
    }


    public function novoPedido($InfoPedidos, $pdo)
    {
        try {
            $stmt = $pdo->prepare('UPDATE tb_pedidos SET concluido = :concluido WHERE pedidoId = :pedidoId');
            $stmt->bindValue(':concluido', $InfoPedidos->getConcluido());
            $stmt->bindValue(':pedidoId', $InfoPedidos->getPedidoId());

            if ($stmt->execute()) {
                header('Content-Type: application/json');
                echo json_encode(['status' => '200']);
                exit;
            }
        } catch (Exception $e) {
            header('Content-Type: application/json');
            echo json_encode(['content' => "Ocorreu um erro ao criar sua requisição!", 'status' => '401', 'pdo' => "$e"]);
            exit;
        }
    }


    /* Listar todos os anuncios de um freelancer */
    public function listarAnunciosFree($InfoPedidos, $pdo)
    {
        try {
            $stmt = $pdo->prepare('SELECT
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
                WHERE f.userId = :userId');
            $stmt->bindValue(':userId', $InfoPedidos->getUserId());
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

    public function verifyProfile($InfoPedidos)
    {
        try {
            session_start();
            $userIdAtual = $_SESSION['user']->userId;
            if ($InfoPedidos->getUserId() === $userIdAtual) {
                header('Content-Type: application/json');
                echo json_encode(['status' => '200']);
                exit;
            } else {
                header('Content-Type: application/json');
                echo json_encode(['status' => '401']);
                exit;
            }
        } catch (Exception $e) {
            header('Content-Type: application/json');
            echo json_encode(['status' => '401', 'content' => "Aconteceu algum erro ao listar os anuncios! $e"]);
            exit;
        }
    }
}
