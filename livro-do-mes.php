
<?php 
    require_once('cms/conexao.php');

    $con = conexaoBD();
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Livro do Mês</title>
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
                <?php 
                    $sql = "select * from tbl_livro where livroEmDestaque = 1";
                    $select = mysqli_query($con, $sql);
                    $rsLivroDestaque = mysqli_fetch_array($select);
                ?>
                        
                     <div id="containerMainMenor">
                        <section id="containerLivroMes">
                            <figure>
                                <img src="cms/<?php echo($rsLivroDestaque['imgLivro'])?>" id = "imgLivroMes" alt="1984" title="1984">
                            </figure>
                            
                            <!-- Titulo-->
                            <div class="tituloLaranja"><h2><?php echo($rsLivroDestaque['titulo'])?></h2></div>
                            
                            <p><?php echo($rsLivroDestaque['descricao'])?>
                            
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