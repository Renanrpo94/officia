<?php
class InfoUser
{
    private $nome;
    private $sobrenome;
    private $cpf;
    private $nasc;
    private $cel;
    private $email;
    private $senha;
    private $file;
    /* ------------------------------ */

    public function getNome()
    {
        return $this->nome;
    }
    public function setNome($x)
    {
        $this->nome = $x;
    }
    /* ------------------------------ */
    public function getSobrenome()
    {
        return $this->sobrenome;
    }
    public function setSobrenome($x)
    {
        $this->sobrenome = $x;
    }
    /* ------------------------------ */
    public function getCPF()
    {
        return $this->cpf;
    }
    public function setCPF($x)
    {
        $this->cpf = $x;
    }
    /* ------------------------------ */
    public function getNasc()
    {
        return $this->nasc;
    }
    public function setNasc($x)
    {
        $this->nasc = $x;
    }
    /* ------------------------------ */
    public function getCel()
    {
        return $this->cel;
    }
    public function setCel($x)
    {
        $this->cel = $x;
    }
    /* ------------------------------ */
    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($x)
    {
        $this->email = $x;
    }
    /* ------------------------------ */
    public function getSenha()
    {
        return $this->senha;
    }
    public function setSenha($x)
    {
        $this->senha = $x;
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
