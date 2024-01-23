<?php
class InfoPedidos
{
    private $pedidoId;
    private $userId;
    private $freelancerId;
    private $jobId;
    private $requisicao;
    private $aceitacao;
    private $pedidoConclusao;
    private $conclusao;
    private $concluido;
    /* ------------------------------ */

    public function getPedidoId()
    {
        return $this->pedidoId;
    }
    public function setPedidoId($x)
    {
        $this->pedidoId = $x;
    }
    /* ------------------------------ */
    public function getUserId()
    {
        return intval($this->userId);
    }
    public function setUserId($x)
    {
        $this->userId = $x;
    }
    /* ------------------------------ */
    public function getFreelancerId()
    {
        return $this->freelancerId;
    }
    public function setFreelancerId($x)
    {
        $this->freelancerId = $x;
    }
    /* ------------------------------ */
    public function getJobId()
    {
        return $this->jobId;
    }
    public function setJobId($x)
    {
        $this->jobId = $x;
    }
    /* ------------------------------ */
    public function getRequisicao()
    {
        return $this->requisicao;
    }
    public function setRequisicao($x)
    {
        $this->requisicao = $x;
    }
    /* ------------------------------ */
    public function getAceitacao()
    {
        return $this->aceitacao;
    }
    public function setAceitacao($x)
    {
        $this->aceitacao = $x;
    }
    /* ------------------------------ */
    public function getPedidoConclusao()
    {
        return $this->pedidoConclusao;
    }
    public function setPedidoConclusao($x)
    {
        $this->pedidoConclusao = $x;
    }
    /* ------------------------------ */
    public function getConclusao()
    {
        return $this->conclusao;
    }
    public function setConclusao($x)
    {
        $this->conclusao = $x;
    }
    /* ------------------------------ */
    public function getConcluido()
    {
        return $this->concluido;
    }
    public function setConcluido($x)
    {
        $this->concluido = $x;
    }
    /* ------------------------------ */
}
