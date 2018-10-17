<?php
    require_once('conexao.php');

    $conexao = conexaoBD();

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
        $critica = $rsConsulta['critica_ou_sugestao'];
        $infoProduto = $rsConsulta['infoProduto'];
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
    </head>
    
    <body>
        <script src="js/script.cms.js"> </script>
        
             <header id="smallHeader">
                  <div id="containerHeaderCMS">
                <h1 id="tituloCMSFooter">
                    <span>
                       Tela de Visualização
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
                    Nome: <br><input type="text" class=" txtDados spaceBetween" value="<?php echo(@$nome)?>" disabled><br>
                    E-mail: <br><input type="text" class=" txtDados spaceBetween" disabled value="<?php echo(@$email)?>"><br>
                   Sexo: <br>
                    <!-- 
                        Os radios terão o operador ternário para selecionar de acordo com o sexo do usuário
                    --> 
                    <input type="radio" name="rdoSexo" class="rdoSexo" value="M" <?php echo(@$sexo == "M") ? 'checked': null?>>Masculino
                   <input type="radio" name="rdoSexo"
                                value="F" <?php echo(@$sexo == "F") ? 'checked': null?>>Feminino
                                <br><br>
                   Profissão: <br><input type="text" class=" txtDados spaceBetween" disabled value="<?php echo(@$profissao)?>"><br>
               
                    Telefone: <br><input type="text" class=" txtDados shortxt spaceBetween" disabled value="<?php echo(@$tel)?>"><br>
               
                    Celular: <br><input type="text" class=" txtDados  shortxt spaceBetween" disabled value="<?php echo(@$cel)?>">
               </div>
               <div  class="divisorModal">
                    Home Page:<input type="text" class="txtDados spaceBetween" name="txtHomePage" id="txtHomePage" disabled value="<?php echo(@$homepage)?>">
                        <br>
                Facebook: <input type="text" class="txtDados spaceBetween" name="txtLinkFace" id="txtLinkFace" disabled value="<?php echo(@$linkface)?>">
                        <br>
                         Crítica/Sugestão: <textarea name="txtSugCrit" id="txtSugCrit" disabled class="spaceBetween"> <?php echo(@$critica)?> </textarea>
                         <br>
                         Informações de Produto:<textarea name="txtInfoProduto" id="txtInfoProduto" disabled class="spaceBetween"> <?php echo(@$infoProduto)?></textarea>
                                
               </div>
               
                
           </div>
    </body>
</html>