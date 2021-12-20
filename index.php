<?php
require_once 'classe_cliente.php';
$p = new Cliente("127.0.0.1","3308","contato_clientes", "root","");
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link
            rel="stylesheet"
            href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
            integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
            crossorigin="anonymous"
        />
        <link rel="stylesheet" href="style.css">
        <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Poppins:wght@400;500;700&display=swap"
        rel="stylesheet">

        <title>Formulário de Contato</title>
    </head>
    <body>
    <?php
        if(isset($_POST['nome']))
        {
            $nome = addslashes($_POST['nome']); 
            $email= addslashes($_POST['email']);
            $assunto= addslashes($_POST['assunto']);
            $telefone= addslashes($_POST['telefone']);
            $mensagem= addslashes($_POST['mensagem']);

            if(!empty($nome) && !empty($email) && !empty($assunto) && !empty($telefone) && !empty($mensagem))
            {
                $p->cadastrarMensagem($nome, $email, $assunto, $telefone, $mensagem);

            } else {
                echo "Preencha todos os campos!";
            }
        }
    ?>
        <div class="container">
            <section class="form_contact">
                <header>
                    <h2>Entre em contato conosco!</h2>
                </header>
                <hr />
                <form method="POST">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="nome">Nome:</label>
                            <input
                                id="nome"
                                type="text"
                                class="form-control name"
                                placeholder="Nome completo"
                                name="nome"
                            />
                        </div>
                        <div class="form-group col-md-4">
                            <label for="email">Email:</label>
                            <input
                                type="email"
                                class="form-control email"
                                id="email"
                                placeholder="Endereço de email"
                                name="email"
                            />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="assunto">Assunto:</label>
                            <select
                                id="assunto"
                                class="form-control"
                                name="assunto"
                            >
                                <option selected>Selecione</option>
                                <option>Reclamação de Curso</option>
                                <option>Reclamação de Software</option>
                                <option>Reclamação de Conteúdo</option>
                                <option>Reclamação de Atendimento</option>
                                <option>Elogio</option>
                                <option>Outro</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="telefone">Telefone:</label>
                            <input
                                type="text"
                                class="form-control phone"
                                placeholder="(DDD) número"
                                id="telefone"
                                name="telefone"
                            /><br />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <label for="mensagem"
                                >Mensagem:</label
                            >
                            <textarea
                                class="form-control"
                                id="mensagem"
                                rows="6"
                                name="mensagem"
                                placeholder="Escreva a sua mensagem..."
                            ></textarea>
                        </div>
                    </div>
                    <input type="submit" value="Enviar" id="btn_sub" class="btn btn-success btn-lg">
                    <button type="button" id="btn_hidden" class="btn btn-secondary btn-lg">Visualizar Mensagens</button>
                </form>
            </section>
            <br>
            <section id="lista_contato" class="lista hidden">
                <header>
                    <h2>Lista de mensagens!</h2>
                </header>
                <hr>
                <table class="table table-bordered">
                    <thead>
                        <tr id="titulo">
                            <th scope="col">Nome</td>
                            <th scope="col">Email</td>
                            <th scope="col">Telefone</td>
                            <th scope="col">Assunto</td>
                            <th scope="col" colspan="2">Mensagem</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $dados = $p->buscarMensagens();
                            if(count($dados) > 0)
                            {
                                for($i=0; $i < count($dados); $i++) 
                                {
                                    echo "<tr>";
                                    foreach($dados[$i] as $key => $value){
                                        if($key != "id")
                                        {
                                            echo "<td>".$value."</td>";
                                        }
                                    }
                        ?>
                                    <td><a class="btn btn-secondary" href="">Editar</a><a class="btn btn-danger" href="">Excluir</a></td>
                        <?php
                                    echo "</tr>";
                                }
                            }else {
                                echo "Ainda não há pessoas cadastradas!";
                            }
                        ?>
                    </tbody>
                </table>
            </section>
        </div>
        <script
            src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"
        ></script>
        <script
            src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
            integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
            crossorigin="anonymous"
        ></script>
        <script
            src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
            integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
            crossorigin="anonymous"
        ></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
        <script src="funcoes.js"></script>
    </body>
</html>    

