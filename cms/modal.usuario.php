<?php
    require_once('conexao.php');
    
    $_SESSION['valueBtn'] = "Cadastrar";
    
    $conexao = conexaoBD();
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
                <form name="frmUsuario" action="adm.usuarios.php" method="POST">
               <div class="divisorModal">
                    Nome: <br><input name="txtNome" type="text" class=" txtDados spaceBetween" ><br>
                    E-mail: <br><input type="text"  name="txtEmail" class=" txtDados spaceBetween"><br>
                   Sexo: <br>
                    <!-- 
                        Os radios terão o operador ternário para selecionar de acordo com o sexo do usuário
                    --> 
                    <input type="radio" name="rdoSexo" class="rdoSexo">Masculino
                   <input type="radio" class="rdoSexo" name="rdoSexo" value="F">Feminino
                                <br><br>
                   Matrícula: <br><input type="text" class=" txtDados spaceBetween"  name="txtMatricula"><br>
               
                    Login: <br><input type="text" class=" txtDados shortxt spaceBetween"  name="txtLogin"><br>
               
                    Senha: <br><input type="password" class=" txtDados  shortxt spaceBetween"  name="txtSenha">
               </div>
               <div  class="divisorModal">
                   <?php
                        $sqlSelect = "select * from tbl_nivel";
                   
                        $select = mysqli_query($conexao, $sqlSelect);
                   ?>
                   Nivel de Usuário:<select class="txtDados spaceBetween" name="sltNivelUser"> 
                        <?php 
                            while($rsNiveis=mysqli_fetch_array($select)) {
                        ?>
                            <option value="<?php echo($rsNiveis['idNivel'])?>"><?php echo($rsNiveis['nomeNivel'])?></option>
                        <?php
                            }
                        ?>
                   </select>
                        <br>
                
                    Ativação: <br>
                   <!-- switch Arredondado-->
                    <label class="switch">
                      <input type="checkbox" name="checkAtivacao">
                      <span class="slider round"></span>
                        
                    </label> <br><br>
                   <!-- submit -->
                    <input type="submit" name="btnEnviar" value="<?php echo($_SESSION['valueBtn'])?>" class="btnEnviar" >
                   
                   
               </div>
                    
                </form>
           </div>
        
        <script>
            /*
            var toggle = document.getElementById('dataAtivado');
          //  console.log(document.getElementById('data1').value);
            if(toggle.value == 'off') {
                toggle.onclick = toggle.value = 'off'
            }
            */
            

        </script>
    </body>
</html>