<?php
    require_once('conexao.php');
    require_once('head.html');
    require_once('header.php');
    require_once('containerCMS.php');
    
?>
Você está acessando o CMS da Woody Woodpecker
    <figure>
            <img src="../imagens/gears.png" alt="Gears" title="Operacional" id="imgGear">
    </figure>
    <script src="js/noback.js"></script>
    <script> 
         //inicializando a biblioteca noback para prevenir o usuário de retornar a page
         noback.init();
    </script>
<?php 
    require_once('footer.php');
?>