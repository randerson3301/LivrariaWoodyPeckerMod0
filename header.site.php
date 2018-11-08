<?php 
    require_once('cms/conexao.php');
    require_once('login.php');
?>
<header>
           <div id="containerHeader">
                <a href="index.php"><div id="logo"> </div></a>
                <nav id="menu">
                    <ul id="menu-header">
                    <li class="item"><a class="link" href="autores.php">Autores</a></li>
                    <li class="item"><a class="link" href="sobre.php">Sobre</a></li>
                    <li class="item"><a class="link" href="promocoes.php">Promoções</a></li>
                    <li class="item"><a class="link" href="nossas-lojas.php">Lojas</a></li>
                    <li class="item"><a class="link" href="livro-do-mes.php">Livro do Mês</a></li>
                    
                    <li class="item"><a href="faleConosco.php">Contato</a></li>
                     </ul>
                </nav>
                <div id="login">
                    <div id="containerLogin">
                    <form action="#" name="FrmLogin" method="POST">
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