<?php
session_start();
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
            <section class="form_contact">
                <header>
                    <h2>Entre em contato conosco!</h2>
                </header>
                <hr />
                <form method="POST" action="proc_contato_msg.php">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="inputNamed4">Nome:</label>
                            <input
                                type="text"
                                class="form-control name"
                                placeholder="Nome completo"
                                name="nome"
                            />
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputEmail4">Email:</label>
                            <input
                                type="email"
                                class="form-control email"
                                id="inputEmail4"
                                placeholder="Endereço de email"
                                name="email"
                            />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="inputEstado">Assunto:</label>
                            <select
                                id="inputEstado"
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
                            <label>Telefone:</label>
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
                            <label for="exampleFormControlTextarea1"
                                >Mensagem:</label
                            >
                            <textarea
                                class="form-control"
                                id="exampleFormControlTextarea1"
                                rows="6"
                                name="mensagem"
                                placeholder="Escreva a sua mensagem..."
                            ></textarea>
                        </div>
                    </div>
                    <input name="enviarContato" type="submit" value="Enviar" class="btn btn-success btn-lg">
                    </input>
                </form>
                <div class="msg">
                <?php
                    
                    if(isset( $_SESSION ['msg'])){
                        echo  $_SESSION ['msg'];
                        unset( $_SESSION ['msg']);
                    };
                    
                ?>
                </div>
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
     
        <!-- Máscara para telefone/celular -->
        <script type="text/javascript">
            $("#telefone, #celular").mask("(00) 00000-0000");
        </script>
    </body>
</html>    


