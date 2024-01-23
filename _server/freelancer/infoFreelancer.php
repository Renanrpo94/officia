<?php
class InfoFreelancer
{
    private $titulo;
    private $preco;
    private $categoria;
    private $descricao;
    private $jobId;
    private $file;
    /* ------------------------------ */

    public function getTitulo()
    {
        return $this->titulo;
    }
    public function setTitulo($x)
    {
        $this->titulo = $x;
    }
    /* ------------------------------ */
    public function getPreco()
    {
        return $this->preco;
    }
    public function setPreco($x)
    {
        $this->preco = $x;
    }
    /* ------------------------------ */
    public function getCategoria()
    {
        return $this->categoria;
    }
    public function setCategoria($x)
    {
        $this->categoria = $x;
    }
    /* ------------------------------ */
    public function getDescricao()
    {
        return $this->descricao;
    }
    public function setDescricao($x)
    {
        $this->descricao = $x;
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
    public function getFile()
    {
        return $this->file;
    }
    public function setFile($x)
    {
        $this->file = $x;
    }
}
