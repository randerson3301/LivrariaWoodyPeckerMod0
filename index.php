<?php
    require_once("cms/function.php");
    require_once("cms/conexao.php");

    $con = conexaoBD();
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Home</title>
        <link href="css/reset.css" rel="stylesheet" type="text/css"> 
        <link href="css/style.css" rel="stylesheet" type="text/css">
        
       
    </head>
    
    <body>
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
                   
                    <!--      SLIDER            -->
                    <div class="slider" id="slider">
                        <div class="divisor">
                            <button class="btnSlider" onclick="mudarImg(prevImg())" id="setaEsquerda"></button>
                            
                            <div id="indexslider">
                               
                            </div>
                        </div>
                        <div class="painelCentral"></div>
                        <div class="divisor">
                            <button  class="btnSlider" onclick="mudarImg(proxImg())" id="setaDireita"></button>
                        </div>
                    </div> 
                    <div id="containerContent">
                        <div id="painelRolagem">
                            <nav > 
                                <ul>
                                  <?php
                                    $sqlcateg = selecionar('tbl_categoria', 'id_categoria', 'ativacao = 1');
                                    $sltcateg = mysqli_query($con, $sqlcateg);

                                    //setando o resultset
                                    while($rscateg = mysqli_fetch_array($sltcateg)) {

                                  ?>
                                    
                                    <li class="itemRolagem "> <?php echo(utf8_encode($rscateg['categoria']))?> 
                                       
                                        <ul class="list_dd">
                                            <?php 
                                                $sqlsubcat = "select tsb.sub_categoria from  
                                                tbl_sub_categoria tsb inner join 
                                                tbl_categoria tc where tsb.ativacao = 1 and tsb.id_categoria  = ".$rscateg["id_categoria"]."
                                                and tc.id_categoria =".$rscateg["id_categoria"];

                                                $sltsubcat =  mysqli_query($con, $sqlsubcat);

                                                while($rssubcat = mysqli_fetch_array($sltsubcat)) {
                                            ?>
                                             <li class="itemdd" > <?php echo(utf8_encode($rssubcat['sub_categoria']))?> </li>
                                             <?php 
                                                }
                                             ?>
                                        </ul>
                                        
                                    </li>
                                  <?php 
                                    }
                                  ?>
                                </ul>
                            </nav>
                            
                           
                        </div>
                        
                        
                     </div>
                     <!-- FIM CONTEÚDO -->
                     <!-- INICIO RODAPÉ -->
                    <footer></footer>
                <!-- FIM RODAPÉ -->
            </div>
         <!-- usando a biblioteca jquery-->
        <script src="js/jquery.js"></script>
        <script src="js/script.js"></script>
     </body>
</html>