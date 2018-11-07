<?php 
    require_once('cms/conexao.php');

    $con = conexaoBD();
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Promoções</title>
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
                
                     <div id="containerMain">
                        <section class="containerLivraria promos superior" >
                            <?php 
                                $sql = 'select tl.*, tp.percentualDesconto 
                                from tbl_livros tl inner join tbl_promocao tp
                                on tl.isbn = tp.isbn and tp.isAtivado=1';

                                $select = mysqli_query($con, $sql);
                                while($rsPromo = mysqli_fetch_array($select)){
                            ?>
                            <div class="containerLivro">
                                <!-- Container da foto -->
                                <div class="containerLivroFoto">
                                    <figure>
                                         <img class="imgLivro" alt="Livro"
                                         src = "cms/<?php echo($rsPromo['imgLivro'])?>" title = "O Código Da Vinci "> 
                                    </figure>
                                </div>
                                <!-- Dados do livro-->
                                <div class="containerLivroDados">
                                    <!-- titulo-->
                                    <div class="tituloLivro">
                                        <h2><span class="textTitulo">Título:</span> O Código Da Vinci</h2>
                                    </div>
                                    <!-- descrição do livro -->
                                    <div class="descLivro">
                                        <span class="textTitulo">Descrição:</span> Um assassinato dentro do Museu do Louvre, em Paris, traz à tona uma sinistra conspiração para revelar um segredo que foi protegido por uma sociedade secreta desde os tempos de Jesus Cristo.

                                    </div>
                                    <!-- preço -->
                                    <div class="preco">
                                        <span class="precoVelho">De: R$&nbsp;39,90</span>
                                        
                                        <span class="precoNovo"><span class="textTitulo">Por:</span> R$&nbsp;25,90</span>
                                    </div>
                                    <!-- detalhes -->
                                    <div class="containerDetalhes">
                                        <div class = "divisorDetalhes"></div>
                                        <div class="detalhes">
                                           +Detalhes
                                        </div>
                                    </div>
                                </div>
                            </div> 
                                <?php } ?>
                        </section>  
                            </div> 
                            
                        
                         
                     </div>
                     <!-- FIM CONTEÚDO -->
                     <!-- INICIO RODAPÉ -->
                    <footer>

                    </footer>
                <!-- FIM RODAPÉ -->
                </div>
            
       </body>
</html>