<?php
    require_once('conexao.php');

    $conexao = conexaoBD();


    if(isset($_POST['idRegistro'])) {
        $_SESSION["cod"] = $_POST['idRegistro'];
        
        $sqlSelect = "select * from tbl_nivel where idNivel=". $_SESSION["cod"];
        
        $select = mysqli_query($conexao, $sqlSelect);
        
        $_SESSION['valueBtn'] = "Atualizar";
        
        $rsNivel = mysqli_fetch_array($select);
        
        
    } else {
            $_SESSION['valueBtn'] = "Cadastrar";
    }

    
    
?>

<!DOCTYPE html>
<html>
    <head>
        <title> CMS WW</title>
        <meta charset="utf-8">
        <link href="css/cms.style.css" rel="stylesheet" type="text/css">
        <link href="../css/reset.css" rel="stylesheet" type="text/css">
        <script src="../js/jquery.js"></script>
        <script>
            
            $(document).ready(function() {
                $('.fecharModal').click(function() {$('#containerModal').fadeOut(400);
                });
            });
         </script>
    </head>
    
    <body>
        <a href="#"  class="fecharModal">
            <figure>
                <img src="../imagens/delete.png"alt="fechar" title="Fechar Janela" class="imgClose">      
            </figure>
         </a>
       
        <div class="divisorModal formatModal ">
             <form action="adm.usuarios.php" method="post" name="FrmNiveis" id="FrmNiveis">
                 Nome do Nível: <br><input type="text" class=" txtDados spaceBetween" name="txtNivel" value="<?php echo(@$rsNivel["nomeNivel"])?>">
                    <br>
                       
                   <input type="submit" value="<?php echo($_SESSION['valueBtn'])?>" name="btnEnviar" class="btnEnviar"> 
              </form>
        </div>
          
    </body>
</html>