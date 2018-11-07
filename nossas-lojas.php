<?php 
    require_once('cms/conexao.php');

    $con = conexaoBD();
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Nossas Lojas</title>
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
                                <input type="password" name="txtSenha" class="login" maxlength="40">
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
                
                     <div id="containerMainMenor">
                       <?php 
                            $sql=
                       ?>
                         <section class="containerLoja superior">
                            <figure>
                                <img src="imagens/bookstore1.jpg" class="bookStore" alt="bookStore" title="Loja física">
                            </figure>
                            
                            <!-- Conteudo das sessões-->
                            <div class="tituloLaranja">
                               <h2>Woody Woodpecker na capital de SP</h2> 
                            </div>
                            Para quem reside no sul do Brasil, temos uma loja localizada na capital gaúcha, venha nos visitar o mais breve possível 😉 .<br><br>
                                Endereço: Praça da Alfândega, 1100 - Centro Histórico, Porto Alegre - RS, 90010-150
                        </section>
                        
                         
                         
                     </div>
                     <!-- FIM CONTEÚDO -->
                     <!-- INICIO RODAPÉ -->
                    <footer>

                    </footer>
                <!-- FIM RODAPÉ -->
                </div>
            
       </body>
</html>