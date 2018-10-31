<?php 
    require_once('head.html');
    require_once('header.modal.html');
?>
        <div id="containerConteudoModal">
            <form name="frmSobre" action="adm.conteudo.php" method="POST" enctype="multipart/form-data">
            <!-- imagem e ativação-->
            <div class="divisorModal"> 
                Imagem:
                <input type="file" name="fleFoto" id="foto">

            </div>
             <!-- descrição -->
            <div class="divisorModal"></div>
        </form>
        </div>
    </body>
    
</html>