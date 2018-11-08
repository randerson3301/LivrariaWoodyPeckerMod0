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
        <?php 
            require_once('header.site.php');
        ?>
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
                            <?php 
                                $sql = 'select tl.*, tp.*,  tl.preco - (tl.preco *  (tp.percentualDesconto/ 100))
                                from tbl_livro tl inner join tbl_promocao tp
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
                                        <h2><span class="textTitulo">Título:</span><?php echo($rsPromo['titulo'])?></h2>
                                    </div>
                                    <!-- descrição do livro -->
                                    <div class="descLivro">
                                        <span class="textTitulo">Descrição:</span> <?php echo($rsPromo['descricao'])?>

                                    </div>
                                    <!-- preço -->
                                    <div class="preco">
                                        <span class="precoVelho">De: R$&nbsp;<?php echo($rsPromo['preco'])?></span>
                                        
                                        <span class="precoNovo"><span class="textTitulo">Por:</span> R$&nbsp;<?php
                                        $valorfinal = number_format($rsPromo['tl.preco - (tl.preco *  (tp.percentualDesconto/ 100))'], 2, ".", ",");
                                        
                                        echo($valorfinal)?></span>
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
                            </div> 
                     <!-- FIM CONTEÚDO -->
                     <!-- INICIO RODAPÉ -->
                    <footer>

                    </footer>
                <!-- FIM RODAPÉ -->
                </div>
            
       </body>
</html>