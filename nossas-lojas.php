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
                
                     <div id="containerMainMenor">
                       <?php 
                            $sql=  "select tl.*, te.* from tbl_lojas tl inner join tbl_endereco te where te.id = tl.idEndereco and isAtivado=1
                            ";
                            $select = mysqli_query($con, $sql);

                            while($rsLoja=mysqli_fetch_array($select)) {
                       ?>
                         <section class="containerLoja superior">
                            <figure>
                                <img src="cms/<?php echo($rsLoja['imgLoja'])?>" class="bookStore" alt="bookStore" title="Loja física">
                            </figure>
                            
                            <!-- Conteudo das sessões-->
                            <div class="tituloLaranja">
                               <h2>Woody Woodpecker em <?php echo($rsLoja['cidade'].", ".$rsLoja['uf'] )?></h2> 
                            </div>
                             <?php echo($rsLoja['descricao'])?><br><br>
                                Endereço: <?php echo($rsLoja['logradouro'])?>,  <?php echo($rsLoja['bairro'])?>, 
                                <?php echo($rsLoja['cidade'])?> - <?php echo($rsLoja['uf'])?>, <?php echo($rsLoja['cep'])?>
                        </section>
                        
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