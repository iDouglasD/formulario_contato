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
        <div class="container">
            <!--INSERIR MSG DO CLIENTE NO BANCO DE DADOS-->
            <?php
                if(isset($_POST['btn_submit']))
                {
                    // EDITAR
                    if(isset($_GET['id_up']) && !empty($_GET['id_up']))
                    {
                        $id_upd = addslashes($_GET['id_up']);
                        $nome = addslashes($_POST['nome']); 
                        $email= addslashes($_POST['email']);
                        $assunto= addslashes($_POST['assunto']);
                        $telefone= addslashes($_POST['telefone']);
                        $mensagem= addslashes($_POST['mensagem']);
    
                        if(!empty($nome) && !empty($email) && !empty($assunto) && !empty($telefone) && !empty($mensagem))
                        {
                            $p->atualizarDados($id_upd,$nome, $email, $assunto, $telefone, $mensagem);
                            echo "<script language='javascript'>window.location.href='index.php';</script>";
    
                        } 
                        else 
                        {
                             ?>
                            <div class='aviso'>
                                <img src="images/aviso.svg" alt="Error">
                                <h5>Não foi possível atualizar, por favor, preencha todos os campos!</h5>
                            </div>
                            <?php
                        }    
                    }
                     // CADASTRAR MSG NOVA
                    else 
                    {
                        $nome = addslashes($_POST['nome']); 
                        $email= addslashes($_POST['email']);
                        $assunto= addslashes($_POST['assunto']);
                        $telefone= addslashes($_POST['telefone']);
                        $mensagem= addslashes($_POST['mensagem']);
    
                        if(!empty($nome) && !empty($email) && !empty($assunto) && !empty($telefone) && !empty($mensagem))
                        {
                            $p->cadastrarMensagem($nome, $email, $assunto, $telefone, $mensagem);
    
                        } 
                        else 
                        {
                            ?>
                            <div class='aviso'>
                                <img src="images/aviso.svg" alt="Error">
                                <h5>Por favor, preencha todos os campos!</h5>
                            </div>
                            <?php
                        }
                    }    
                }
            ?>
            <!--ATUALIZAR MENSAGEM ENVIADA-->
            <?php
                if(isset($_GET['id_up']))
                {
                    $id_update = addslashes($_GET['id_up']);
                    $res = $p->buscarDadosCliente($id_update);
                }
            ?>
            <section class="form_contact">
                <header>
                    <h2>Entre em contato conosco</h2>
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
                                value="<?php if(isset($res)){echo $res['nome'];}?>"
                            />
                        </div>
                        <div class="form-group col-md-4">
                            <label for="email">Email:</label>
                            <input
                                class="form-control email"
                                id="email"
                                type="email"
                                name="email"
                                placeholder="Endereço de email"
                                value="<?php if(isset($res)){echo $res['email'];}?>"
                            />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="assunto">Assunto:</label>
                            <select
                                class="form-control"
                                id="assunto"
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
                                value="<?php if(isset($res)){echo $res['telefone'];}?>"
                            />
                            <br/>
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
                            ><?php if(isset($res)){echo $res['mensagem'];}?></textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <input type="button" id="btn_hidden" class="btn_view btn btn-secondary btn-lg" value="Visualizar Mensagens">
                            <input type="button" id="btn_hidden2" class="btn_hidden btn btn-secondary btn-lg hidden" value="Ocultar Mensagens">
                            <input type="submit" name="btn_submit" value="<?php if(isset($res)){echo "Atualizar";}else {echo "Enviar";}?>" id="btn_sub" class="btn btn-success btn-lg">
                        </div>
                    </div>
                </form>
            </section>
            <br>
            <section id="lista_contato" class="lista hidden">
                <header>
                    <h2>Lista de mensagens</h2>
                </header>
                <hr>
                <table class="table table-bordered">
                    <thead>
                        <tr class="table-active">
                            <th scope="col">Nome</td>
                            <th scope="col">Email</td>
                            <th scope="col">Assunto</td>
                            <th scope="col" >Telefone</td>
                            <th scope="col" colspan="2">Mensagem</td>
                        </tr>
                    </thead>
                    <tbody>
                        <!--LISTAR MSGs DOS CLIENTES NO BANCO DE DADOS-->
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
                                    <td class="btn_list">
                                        <a class="btn btn-secondary" href="index.php?id_up=<?php echo $dados[$i]['id'];?>">Editar</a>
                                        <a class="btn btn-danger" href="index.php?id=<?php echo $dados[$i]['id'];?>">Excluir</a>
                                    </td>
                        <?php
                                    echo "</tr>";
                                }
                            }
                            else 
                            {   
                                ?>
                                <div class="aviso">
                                    <h5>* Ainda não há mensagens cadastradas!</h5>
                                </div>
                                <?php
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

<!-- Excluir mensagem de contato do cliente quando o parâmetro existir -->
<?php
    if(isset($_GET['id']))
    {
        $id_cliente = addslashes($_GET['id']);
        $p->excluirMensagem($id_cliente);
        echo "<script language='javascript'>window.location.href='index.php';</script>";
    }
?>