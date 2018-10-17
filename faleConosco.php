<?php 
    require_once('cms/conexao.php');
    
    $conexao = conexaoBD();

    if(isset($_GET["btnSubmit"])) {
        
        #Resgatando os values do form
        $nome = $_GET["txtNome"];
        $email = $_GET["txtEmail"];
        $sexo = $_GET["rdoSexo"];
        $profissao = $_GET["txtProfissao"];
        $telefone = $_GET["txtTel"];
        $celular = $_GET["txtCel"];
        $homepage = $_GET["txtHomePage"];
        $contaface = $_GET["txtLinkFace"];
        /*critica ou sugestão*/
        $critOuSug =  $_GET["txtSugCrit"];
        $infoProduto =  $_GET["txtInfoProduto"];
        
        $sql = "insert into tbl_fale_conosco(nomeContato, sexoContato, profissao, celular, telefone, homePage, infoProduto, critica_ou_sugestao, emailContato, contaFacebook) values('".$nome."', '".$sexo."', '".$profissao."', '".$celular."',  '".$telefone."', '".$homepage."', '".$infoProduto."', '".$critOuSug."', '".$email."', '".$contaface."')";
        mysqli_query($conexao, $sql);
        header('location:faleConosco.php');
    }
    
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Fale Conosco</title>
        <link href="css/reset.css" rel="stylesheet" type="text/css"> 
        <link href="css/style.css" rel="stylesheet" type="text/css">
        
   </head>
    
    <body>
        <!-- Cabeçalho do site-->
        <header>
            <div id="containerHeader">
                <a href="home.html"><div id="logo"> </div></a>
                <nav id="menu">
                    <ul id="menu-header">
                    <li class="item"><a class="link" href="autores.html">Autores</a></li>
                    <li class="item"><a class="link" href="sobre.html">Sobre</a></li>
                    <li class="item"><a class="link" href="promocoes.html">Promoções</a></li>
                    <li class="item"><a class="link" href="nossas-lojas.html">Lojas</a></li>
                    <li class="item"><a class="link" href="livro-do-mes.html">Livro do Mês</a></li>
                    
                    <li class="item"><a href="faleConosco.php">Contato</a></li>
                 </ul>
            </nav>
                <div id="login">
                    <div id="containerLogin">
                        <form action="#" name="FrmLogin">
                            <div class="txtLogin">
                                Usuário
                            </div>
                            <div class="txtLogin">
                                Senha
                            </div>
                            <div class="campo">
                                <input type="text" name="txtUser" class="login" maxlength="40">
                            </div>
                            <div class="campo">
                                <input type="password" name="txtSenha" class=" login" maxlength="40">
                            </div>
                        
                            <div id="containerBtn">
                                <input type="submit" name="btnLogar" id="btnLogar" value="Ok">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </header>
        <!-- FIM DO Cabeçalho-->
        
        <!-- Conteúdo da page-->
            <div id="containerGeral">
                <div class="divisorLateral"> 
                    <div class="containerLinks">
                        <a href="https://www.facebook.com/" target="_blank">
                            <div class="iconRedeSocial" id="faceIcon"></div>
                        </a>
                        <a href="https://twitter.com/" target="_blank">
                            <div class="iconRedeSocial" id="twitterIcon"></div>
                        </a>
                        <a href="https://instagram.com/" target="_blank">
                            <div class="iconRedeSocial" id="instaIcon"></div>
                         </a>   
                    </div>
                    </div>
                <div id="containerMain">
                    <div id="containerForm">
                        <form action="#" name="FrmContato" id="FrmContato">
                            <fieldset>
                                <legend>Entre em Contato conosco:</legend>
                                <label for="txtNome">Nome:</label> <input type="text" class="txtDados" name="txtNome" id="txtNome" onkeypress="return validar(event, 'num', this.id);" required>*<br><br>
                                <label for="txtEmail">E-mail:</label> <input type="email" class="txtDados" name="txtEmail" id="txtEmail" required>*<br><br>
                                Sexo:*<br>
                                
                                <input type="radio" name="rdoSexo" class="rdoSexo" value="M" required>Masculino
                                <input type="radio" name="rdoSexo"
                                value="F" required>Feminino
                                <br><br>
                                
                                <label for="txtProfissao">Profissão:</label> <input type="text" class="txtDados" name="txtProfissao" id="txtProfissao" required>*
                                <br><br>
                                <label for="txtTel">Telefone:<br></label> <input type="tel" class="txtDados shortxt" name="txtTel" id="txtTel" onkeypress="return validar(event, 'txt', this.id);" pattern="[0-9]{4}[0-9]{4}" placeholder="Ex: ########"><br><br>
                                <label for="txtCel">Celular:<br></label> <input type="text" class="txtDados shortxt" name="txtCel" id="txtCel" onkeypress="return validar(event, 'txt', this.id);" pattern="(9[0-9]{4}[0-9]{4})" placeholder="Ex: 9########" required>*
                                <br><br>
                                <label for="txtHomePage">Sua Home Page:</label> <input type="text" class="txtDados" name="txtHomePage" id="txtHomePage" >
                                <br><br>
                                <label for="txtLinkFace">Deixe seu link do face:</label> <input type="text" class="txtDados" name="txtLinkFace" id="txtLinkFace" >
                                <br><br>
                                <label for="txtSugCrit">Deixe sua Crítica/Sugestão:</label> <textarea name="txtSugCrit" id="txtSugCrit"> </textarea>
                                <br><br>
                                <label for="txtInfoProduto">Informações de Produto:</label> <textarea name="txtInfoProduto" id="txtInfoProduto"> </textarea>
                                <br>
                                <span id="txtObg">"*" significa obrigatório </span>
                                <br><br>
                                <input type="submit" value="Enviar" name="btnSubmit"
                                   id="btnSubmit">
                          </fieldset>
                        </form>
                    </div>
                    
                     <!-- FIM CONTEÚDO -->
                     <!-- INICIO RODAPÉ -->
                    <footer></footer>
                <!-- FIM RODAPÉ -->
                </div>
                
                </div>
             <script src="js/script.js"></script>
       </body>
</html>