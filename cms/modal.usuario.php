<?php
    require_once('conexao.php');
    require_once('function.php');
    
    //$_SESSION['valueBtn'] = "Cadastrar";
    
    $conexao = conexaoBD();
    
    $itemOption = "Selecione um item ...";
    $_SESSION['valueBtn'] = "Cadastrar";
    $valueOption = 0;
    
    $hidden = '';
    $disabled = '';
    $modo = '';
    //pegando o modo da url
    if(isset($_GET['modo'])) {
        $modo = $_GET['modo'];
    }
    echo($modo);
    if(isset($_POST['idRegistro'])) {
        
        if($modo == '') {
            $_SESSION['valueBtn'] = "Atualizar";
        }
        else if($modo == 'view'){
            echo("<script> alert('oi') </script>")
            $hidden = 'hidden';
            $disabled = 'disabled';
        }
        $_SESSION["cod"] = $_POST['idRegistro'];
        
        $sqlSelect = "select tu.*, tn.nomeNivel from tbl_usuarios tu inner join tbl_nivel tn where tu.idNivel = tn.idNivel and matricula=". $_SESSION["cod"];
        
        $select = mysqli_query($conexao, $sqlSelect);
        
        $rsUser = mysqli_fetch_array($select);
        
        $itemOption = $rsUser["nomeNivel"];
        $valueOption = $rsUser["idNivel"];
        
        
    }
?>
<!DOCTYPE>
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
                    Nome: <br><input name="txtNome" type="text" class=" txtDados spaceBetween" value="<?php echo(@$rsUser['nomeUsuario'])?>" <?php echo(@$disabled)?>><br>
                    E-mail: <br><input type="text"  name="txtEmail" class=" txtDados spaceBetween" value="<?php echo(@$rsUser['emailUsuario'])?>" <?php echo(@$disabled)?>><br>
                   Sexo: <br>
                    <!-- 
                        Os radios terão o operador ternário para selecionar de acordo com o sexo do usuário
                    --> 
                    <input type="radio" name="rdoSexo" class="rdoSexo" value="M" <?php echo(@$rsUser['sexoUsuario'] == "M") ? 'checked': null?> <?php echo(@$disabled)?>>Masculino
                   <input type="radio" class="rdoSexo" name="rdoSexo" value="F" <?php echo(@$rsUser['sexoUsuario'] == "F") ? 'checked': null?> <?php echo(@$disabled)?>>Feminino
                                <br><br>
                   Matrícula: <br><input type="number" class=" txtDados spaceBetween"  name="txtMatricula" value="<?php echo(@$rsUser['matricula'])?>" <?php echo(@$disabled)?>><br>
               
                    Login: <br><input type="text" class=" txtDados shortxt spaceBetween"  name="txtLogin"  value="<?php echo(@$rsUser['loginNome'])?>" <?php echo(@$disabled)?>><br>
               
                    Senha: <br><input type="password" class=" txtDados  shortxt spaceBetween"  name="txtSenha"  value="<?php echo(@$rsUser['senha'])?>" <?php echo(@$disabled)?>>
               </div>
               <div  class="divisorModal">
                   
                   Nivel de Usuário:<select class="txtDados spaceBetween" name="sltNivelUser" <?php echo(@$disabled)?>> 
                   
                   
                    <option value="<?php echo($valueOption)?>">
                        <?php echo($itemOption)?>
                    </option>
                        
                        <?php 
    /*
                            $sqlNivelJoin = "select tu.idNivel, tn.nomeNivel from tbl_usuarios tu inner join tbl_nivel tn on tu.idNivel = tn.idNivel";
      */                      
                            $sqlNivel = selecionar('tbl_nivel', 'idNivel', 'idNivel <> '. $valueOption);
                            $selectNivel = mysqli_query($conexao, $sqlNivel);
                            
                            //$selectNivelJoin =  mysqli_query($conexao, $sqlNivelJoin);
                            //$rsNivelUser = mysqli_fetch_array($selectNivelJoin);
                            
                           while($rsNivel=mysqli_fetch_array($selectNivel)) {
                        ?>
                            <option value="<?php echo($rsNivel['idNivel'])?>"><?php echo($rsNivel['nomeNivel'])?></option>
                        <?php
                            }
                        ?>
                   </select>
                        <br>
                
                    Ativação: <br>
                   <!-- switch Arredondado-->
                    <label class="switch">
                      <input type="checkbox" name="checkAtivacao" <?php echo(@$rsUser['isAtivado'] == 1) ? 'checked' : ''?> <?php echo(@$disabled)?>>
                      <span class="slider round"></span>
                        
                    </label> <br><br>
                   <!-- submit -->
                    <input type="submit" name="btnEnviar" value="<?php echo($_SESSION['valueBtn'])?>" class="btnEnviar" <?php echo(@$hidden)?>>
                   
                   
               </div>
                    
                </form>
           </div>
    </body>
</html>