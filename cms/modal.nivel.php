<?php
    require_once('conexao.php');

    $conexao = conexaoBD();


    if(isset($_GET['btnEnviarNivel'])) { //verificando se o botão foi clicado
        $nivel = $_GET['txtNivel'];
        //comando de insert para popular no banco
        $sql = "insert into tbl_nivel(nomeNivel) values('".$nivel."')";
        
        mysqli_query($conexao, $sql);
        
    }
    
    /*
    $codigo = $_POST['idRegistro'];

    $sql = "select * from tbl_fale_conosco where id=".$codigo;

    $select = mysqli_query($conexao, $sql);

    if($rsConsulta=mysqli_fetch_array($select)) {
        $nome = $rsConsulta['nomeContato'];
        $email = $rsConsulta['emailContato'];
        $profissao = $rsConsulta['profissao'];
        $tel = $rsConsulta['telefone'];
        $cel = $rsConsulta['celular'];
        $sexo = $rsConsulta['sexoContato'];
        $homepage = $rsConsulta['homePage'];
        $linkface = $rsConsulta['contaFacebook'];
        $critica = $rsConsulta['critica_e_sugestao'];
        $infoProduto = $rsConsulta['infoProduto'];
    }
      */  
?>

<!DOCTYPE html>
<html>
    <head>
        <title> CMS WW</title>
        <meta charset="utf-8">
        <link href="css/cms.style.css" rel="stylesheet" type="text/css">
        <link href="../css/reset.css" rel="stylesheet" type="text/css">
        <script src="../js/jquery.js"></script>
    </head>
    
    <body>
        <script>
            $(document).ready(function() {
                $('.fecharModal').click(function() {
                    $('#containerModal').fadeOut(400);
                });
            });
           
        </script>
        
             <header id="smallHeader">
                  <div id="containerHeaderCMS">
                <h1 id="tituloCMSFooter">
                    <span>
                       Cadastrar Nível
                    </span>
                </h1> 
                
                <figure id="logoCMS">
                     <img src="../imagens/logocms.png" alt="LOGO" title="Woody Woodpecker" id= "logocms">
                </figure>
                <a href="#"  class="fecharModal">
                    <figure>
                        <img src="../imagens/delete.png"alt="fechar" title="Fechar Janela">      
                    </figure>
                </a>
            </div>
            </header>  
           <div id="containerConteudoModal">
               <div class="divisorModal">
                   <form action="#" method="get" name="FrmNiveis">
                        Nome do Nível: <br><input type="text" class=" txtDados spaceBetween" name="txtNivel">
                       
                        <input type="submit" value="Cadastrar" name="btnEnviarNivel"> 
                   </form>
               </div>
          </div>
    </body>
</html>