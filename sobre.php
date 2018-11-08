<?php 
    require_once('cms/conexao.php');
    require_once('login.php');
    $con = conexaoBD();
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Sobre Nós</title>
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
                        <!-- foto da livraria-->
                    <?php 
                        $sql = 'select * from tbl_sobre where isAtivado=1';
                        $select = mysqli_query($con, $sql);
                        $rsSobre = mysqli_fetch_array($select);
                    ?>
                         <div id="imgLivraria">
                             <img src="cms/<?php echo($rsSobre['imgSobre'])?>"
                             id="imgSobre">
                         </div>
                         <div class="tituloLaranja">
                             Sobre a nossa equipe...
                         </div>
                         <div id="descSobre">
                         <?php echo($rsSobre['descricao'])?>
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