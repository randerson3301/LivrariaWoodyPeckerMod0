<?php
    require_once("cms/function.php");
    require_once("cms/conexao.php");

    $con = conexaoBD();

    $sqlLivro = 'select * from tbl_livro order by RAND()';

    if(isset($_GET['sc'])) {
        //echo("epaa");
        
        $subcat = $_GET['sc'];
        $sqlLivro = "select tl.* from tbl_livro tl inner join tbl_sub_categoria tsc 
        where tl.isAtivado = 1 and tl.id_sub_categoria = $subcat 
        and tl.id_sub_categoria = tsc.id_sub_categoria order by RAND()";

        
        }
    if(isset($_GET['cat'])) {
            //echo("epaa");
            
            $cat = $_GET['cat'];
            $sqlLivro = "select tsc.sub_categoria, tc.categoria, tl.* from tbl_sub_categoria tsc inner join tbl_categoria tc, tbl_livro tl
            where tsc.id_categoria = tc.id_categoria and tl.isAtivado = 1 and
            tsc.id_categoria = $cat and tl.id_sub_categoria = tsc.id_sub_categoria order by RAND()";
    
            
          
    }
    $sltlivro = mysqli_query($con, $sqlLivro);

   
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
                                    <a href="?cat=<?php echo($rscateg['id_categoria'])?>">
                                        <li class="itemRolagem "> <?php echo(utf8_encode($rscateg['categoria']))?> 
                                    </a>
                                        <ul class="list_dd">
                                            <?php 
                                                $sqlsubcat = "select tsb.sub_categoria, tsb.id_sub_categoria from  
                                                tbl_sub_categoria tsb inner join 
                                                tbl_categoria tc where tsb.ativacao = 1 and tsb.id_categoria  = ".$rscateg["id_categoria"]."
                                                and tc.id_categoria =".$rscateg["id_categoria"];

                                                $sltsubcat =  mysqli_query($con, $sqlsubcat);

                                                while($rssubcat = mysqli_fetch_array($sltsubcat)) {
                                            ?>
                                           
                                             <li class="itemdd" >  <a href="?sc=<?php echo($rssubcat['id_sub_categoria'])?>">
                                             <?php echo(utf8_encode($rssubcat['sub_categoria']))?> </a> </li>
                                           
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
                         <?php 
                            while($rslivro=mysqli_fetch_array($sltlivro)) {
                         ?>
                         <div class="containerLivro">
                                <!-- Container da foto -->
                                <div class="containerLivroFoto">
                                    <figure>
                                         <img class="imgLivro" alt="Livro"
                                         src = "<?php echo('cms/'.$rslivro['imgLivro'])?>" title = "<?php echo($rslivro['titulo'])?>"> 
                                    </figure>
                                </div>
                                <!-- Dados do livro-->
                                <div class="containerLivroDados">
                                     <!-- titulo-->
                                    <div class="tituloLivro">
                                        <h2><span class="textTitulo">Título:</span>&nbsp;<?php echo($rslivro['titulo'])?></h2>
                                    </div>
                                    <!-- descrição do livro -->
                                    <div class="descLivro">
                                       <span class="textTitulo">Descrição:</span>&nbsp; <?php echo(utf8_encode($rslivro['descricao']))?>
                                    </div>
                                    <!-- preço -->
                                    <div class="preco">
                                        <span class="textTitulo">Preço:</span> R$&nbsp;<?php echo($rslivro['preco'])?>
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
                            <?php }?>
                        
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