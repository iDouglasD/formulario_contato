<?php

Class Cliente{
    private $pdo;

    // CONEXAO COM O BANCO DE DADOS
    public function __construct($host, $port, $dbname, $user, $senha)
    {
        try
        {
            $this->pdo = new PDO('mysql:host=' . $host . ';port=' . $port . ';dbname=' . $dbname .';', $user, $senha);       
        }
        catch(PDOException $e)
        {
            echo "Erro com banco de dados: ".$e->getMessage();
        }
        catch(Exception $e)
        {
            echo "Erro generico: ".$e->getMessage();
        }
    }


    public function buscarMensagens()
    {   $res = array();
        $cmd = $this->pdo->query("SELECT * FROM mensagens_clientes ORDER BY id");
        $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }

    public function cadastrarMensagem($nome, $email, $telefone, $assunto, $mensagem)
    {
        $cmd = $this->pdo->prepare("INSERT INTO mensagens_clientes (nome, email, assunto, telefone, mensagem) VALUES (:n, :e, :a, :t, :m)");
        $cmd->bindValue(":n", $nome);
        $cmd->bindValue(":e", $email);
        $cmd->bindValue(":a", $assunto);
        $cmd->bindValue(":t", $telefone);
        $cmd->bindValue(":m", $mensagem);
        $cmd->execute();
    }
}

?>