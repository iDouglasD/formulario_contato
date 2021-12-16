<?php 
session_start();
include_once 'conexao.php';

// Verificar se o usuário clicou no botão para enviar
$enviarContato = filter_input(INPUT_POST, 'enviarContato', FILTER_SANITIZE_STRING);

if($enviarContato){

    //Receber os dados do formulário
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    $assunto = filter_input(INPUT_POST, 'assunto', FILTER_SANITIZE_STRING);
    $telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_STRING);
    $mensagem = filter_input(INPUT_POST, 'mensagem', FILTER_SANITIZE_STRING);

    //Verificar se os campos estão vazios
    if(!empty($nome) && !empty($email) && !empty($assunto) && !empty($telefone) && !empty($mensagem)){

        //Inserir no DB
        $result_msg_cont = "INSERT INTO mensagens_clientes (nome, email, assunto, telefone, mensagem) VALUES (:nome, :email, :assunto, :telefone, :mensagem)";
        
    } else {
        $_SESSION['error'] = "<p style='color:red;'>Por favor, preencha todos os campos!</p>";
            header("Location: index.php");
    };

    $insert_msg_cont =  $conn->prepare($result_msg_cont);
    $insert_msg_cont->bindParam(':nome', $nome);
    $insert_msg_cont->bindParam(':email', $email);
    $insert_msg_cont->bindParam(':assunto', $assunto);
    $insert_msg_cont->bindParam(':telefone', $telefone);
    $insert_msg_cont->bindParam(':mensagem', $mensagem);

    if($insert_msg_cont->execute()){
        
        $_SESSION['msg'] = "<p style='color:green;'>Mensagem enviada com sucesso!</p>";
        header("Location: index.php");
        
    } else{
        
        $_SESSION['msg'] = "<p style='color:red;'>Mensagem não foi enviada com sucesso!</p>";
        header("Location: index.php");
    }
} else {
    $_SESSION['msg'] = "<p style='color:red;'>Mensagem não foi enviada com sucesso!</p>";
    header("Location: index.php");
};


?>