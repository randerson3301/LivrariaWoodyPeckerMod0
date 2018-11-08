
<?php 
    require_once('cms/conexao.php');

    $con = conexaoBD();
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Autor em Destaque</title>
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
                    $sql = "select * from tbl_autor where isAtivado = 1";
                    $select = mysqli_query($con, $sql);
                    $rsAutorDestaque = mysqli_fetch_array($select);
                ?>
                        
                     <div id="containerMainMenor">
                        <section id="containerLivroMes">
                            <figure>
                                <img src="cms/<?php echo($rsAutorDestaque['imgAutor'])?>" id = "imgLivroMes" alt="1984" title="1984">
                            </figure>
                            
                            <!-- Titulo-->
                            <div class="tituloLaranja"><h2><?php echo($rsAutorDestaque['nome'])?></h2></div>
                            
                            <p><?php echo($rsAutorDestaque['breveBiografia'])?>
                            
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