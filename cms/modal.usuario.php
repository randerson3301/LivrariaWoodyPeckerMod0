<?php
    require_once('conexao.php');
    
    $_SESSION['valueBtn'] = "Cadastrar";
?>
<html>
    <head>
        <meta charset="utf-8">
        <script src="js/script.cms.js"> </script>
    </head>
    <body>
        
            <header id="smallHeader" class="smallHeaderUser">
                  <div id="containerHeaderCMS">
                <h1 id="tituloCMSFooter">
                    <span>
                       Cadastro de Usuário
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
                <form name="frmUsuario" action="adm.usuarios.php" method="post">
               <div class="divisorModal">
                    Nome: <br><input type="text" class=" txtDados spaceBetween" ><br>
                    E-mail: <br><input type="text" class=" txtDados spaceBetween"><br>
                   Sexo: <br>
                    <!-- 
                        Os radios terão o operador ternário para selecionar de acordo com o sexo do usuário
                    --> 
                    <input type="radio" name="rdoSexo" class="rdoSexo">Masculino
                   <input type="radio" name="rdoSexo"
                                value="F" <?php echo(@$sexo == "F") ? 'checked': null?>>Feminino
                                <br><br>
                   Matrícula: <br><input type="text" class=" txtDados spaceBetween"><br>
               
                    Login: <br><input type="text" class=" txtDados shortxt spaceBetween"><br>
               
                    Senha: <br><input type="password" class=" txtDados  shortxt spaceBetween">
               </div>
               <div  class="divisorModal">
                   Nivel de Usuário:<select class="txtDados spaceBetween" name="txtHomePage" id="txtHomePage" > </select>
                        <br>
                
                    Ativação: <br>
                   <!-- switch Arredondado-->
                    <label class="switch">
                      <input type="checkbox">
                      <span class="slider round"></span>
                    </label> <br><br>
                    <input type="submit" name="btnEnviar" value="<?php echo($_SESSION['valueBtn'])?>" class="btnEnviar">
               </div>
                    
                </form>
           </div>
        
        
    </body>
</html>