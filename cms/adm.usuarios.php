<?php

    require_once('conexao.php');
    require_once('function.php');
    
    $atv;
    
    $conexao = conexaoBD();    

    $sqlUser = "select tlu.*, tn.nomeNivel from tbl_usuarios tlu inner join tbl_nivel tn on tlu.idNivel = tn.idNivel";

    //enviando para o servidor
    $select = mysqli_query($conexao, selecionar('tbl_nivel', 'idNivel')) ;

    //var_dump($select);
    $selectUser = mysqli_query($conexao, $sqlUser);

    
    //utilizando os parametros da modal
    if(isset($_POST['btnEnviar']) && isset($_SESSION['valueBtn'])) {
            //Verificando se o valor do botão é cadastrar
            if($_SESSION['valueBtn'] == 'Cadastrar') {
              
                //verificando se o botão foi clicado
                if(isset($_POST['txtNivel'])) {
                    $nivel = $_POST['txtNivel'];
                    //comando de insert para popular no banco
                    $sqlInsert = "insert into tbl_nivel(nomeNivel, isAtivado) values('".$nivel."','". 0 ."')";
                    
                    echo($sqlInsert);

                     mysqli_query($conexao, $sqlInsert);
                } else {
                    
                    $nome = $_POST['txtNome'];
                    $email = $_POST['txtEmail'];
                    $sexo = $_POST['rdoSexo'];
                    $matricula = $_POST['txtMatricula'];
                    $loginname = $_POST['txtLogin'];
                    $senha = $_POST['txtSenha'];
                    $nivelUser = $_POST['sltNivelUser'];
                    
                    if(isset($_POST['checkAtivacao'])) {
                        $atv = 1;
                    } else {
                         $atv = 0;
                    }
                    
                    $sqlInsert = "insert into tbl_usuarios(matricula, nomeUsuario, senha, emailUsuario, loginNome,
                     isAtivado, idNivel, sexoUsuario) values('".$matricula."', '".$nome."', '".$senha."','".$email."', '".$loginname."', '".$atv."', '".$nivelUser."', '".$sexo."')";

                    mysqli_query($conexao, $sqlInsert);
                    
                }
            

            
            header("location:adm.usuarios.php");
            } else if($_SESSION['valueBtn'] == "Atualizar") { 
                //verificando se o botão foi clicado
                if(isset($_POST['txtNivel'])) {
                $nivel = $_POST['txtNivel'];
                //comando de insert para popular no banco

                $sqlUpdate = update('tbl_nivel',"nomeNivel='".$nivel."'",
                'idNivel', $_SESSION["cod"]);

                mysqli_query($conexao, $sqlUpdate);
                
                header("location:adm.usuarios.php");
                } else {
                    $nome = $_POST['txtNome'];
                    $email = $_POST['txtEmail'];
                    $sexo = $_POST['rdoSexo'];
                    $matricula = $_POST['txtMatricula'];
                    $loginname = $_POST['txtLogin'];
                    $senha = $_POST['txtSenha'];
                    $nivelUser = $_POST['sltNivelUser'];
                    $atv = 0;
                    if(isset($_POST['checkAtivacao'])) {
                        $atv = 1;
                    }
                   
                    //update tabela de usuarios
                  /*
                    echo( update('tbl_usuarios',"nomeUsuario='".$nome."', emailUsuario ='".$email."', sexoUsuario='".$sexo."', loginNome ='".$loginname."', senha ='".$senha. "', idNivel =".$nivelUser.", isAtivado=".$atv,'matricula', $matricula));
                   */
                    
                    $sqlUpdate = update('tbl_usuarios',"nomeUsuario='".$nome."',
                     emailUsuario ='".$email."', sexoUsuario='".$sexo."', 
                     loginNome ='".$loginname."', senha ='".$senha. "', 
                     idNivel =".$nivelUser.", isAtivado=".$atv,'matricula', $matricula);
                    
                    mysqli_query($conexao, $sqlUpdate);
                    header("location:adm.usuarios.php");

                 }

            }
        
    } 
    
        
    if(isset($_GET['modo'])) {
        $modo = $_GET['modo'];
        $codigo = $_GET['id'];

       if($modo == 'excluir') {
             
             //função de delete 
             $delete = delete('tbl_nivel', 'idNivel', $codigo);
             mysqli_query($conexao, $delete);
              
        }
        
        //excluir usuario
        else if($modo == "excluiruser") {
             
             $delete = delete('tbl_usuarios', 'matricula', $codigo);
             mysqli_query($conexao, $delete);
        }
        
        header('location:adm.usuarios.php');
    }

    if(isset($_GET['ativado'])) {
        $atv = $_GET['ativado']; //guarda o status da ativação do registro
        $idNivel = $_GET['id'];
        
        if($atv == 0) {
            echo("tem que mudar isso!". $idNivel);
            
            $atv = 1;
            
        } else {
            $atv = 0; 
        }
        
        $sqlUpdateAtv = "update tbl_nivel set isAtivado=".$atv." where idNivel=".$idNivel;
            
        mysqli_query($conexao, $sqlUpdateAtv);
        header('location:adm.usuarios.php');
    }

?>

        <?php 
            require_once('head.html');
        ?>
        
   
         <!-- ESSAS SÃO AS DIVS DA MODAL-->
        <div id="containerModal">
                <div id="addNivel"></div>
                <div id="modalUsuario"></div>
            </div>
        <?php 
            require_once('header.php');
            require_once('containerCMS.php');
        ?>
                <div class="tab">
                        <button class="tablink" id="openByDefault" onclick="openForm(event, 'formUser'); openByDefault(this.id)">
                        Usuários</button>
                        <button class="tablink"  id="openByDefaultNivel" onclick="openForm(event, 'formNivel'); openByDefault(this.id)">Níveis</button>
                    </div>
                    
                    <div id="formNivel" class="tabcontent">
                        <div class="containerColunasAlt">
                            <div class="coluna tituloColunas espacador">
                            Nível
                            </div>
                            <div class="coluna tituloColunas smallCol" >
                            Ações
                            </div>
                            <div class="coluna tituloColunas smallCol" >
                            Ativação
                            </div>
                            <button class="btnAdd" id="btnNivel" onclick="openInsertModal('modal.nivel.php', '#addNivel', '#modalUsuario')">Adicionar Nível</button>

                    </div>
                        
                        <?php 
                            while($rsNiveis = mysqli_fetch_array($select)) {
                        ?>
                            <div class="containerColunasAlt ">
                                <div class="indexRegistro smallCol indexNivel">
                                    <?php
                                    echo($rsNiveis['idNivel'])
                                    ?>
                                </div>
                                 <div class="coluna colNivel">
                                    <?php echo($rsNiveis['nomeNivel'])?>
                                 </div>
                                <div class="colAcao smallCol" >
                                    <!-- LINK MODAL-->
                                    <a href="#" onclick="openEditNivel(<?php echo( $rsNiveis['idNivel'])?>, 'modal.nivel.php', '#addNivel', '#modalUsuario')" class="editModal">
                                        <figure class="acao">
                                            <img src="../imagens/edit.png" title="Editar Dados" alt="ViewData" class="linkModal">
                                        </figure>
                                    </a>

                                     <a href="adm.usuarios.php?modo=excluir&id=<?php echo($rsNiveis['idNivel'])?>">
                                         <figure class="acao">
                                            <img src="../imagens/delete.png" title="Excluir Registro" alt="excluir">
                                        </figure>
                                     </a>
                                 </div>
                                <div class="colAcao smallCol">
                                   <a href="adm.usuarios.php?ativado=<?php echo($rsNiveis['isAtivado'])?>&id=<?php echo($rsNiveis['idNivel'])?>"> 
                                       <?php
                                       ?>
                                    <figure>
                                            <img src="<?php echo($rsNiveis['isAtivado'] == 0) ? '../imagens/desativo.png' : '../imagens/active.png' ?>" title="Clique para ativar/desativar" alt="excluir" class="imgAtivo" >
                                    </figure>
                                    </a>
                                </div>
                            </div>
                            <?php
                                }
                            ?>
                       </div>
                    <div id="formUser" class="tabcontent">
                        <div class="containerColunasAlt">
                            
                            <div class="coluna tituloColunas colMaior espacador">
                            Nome Completo
                            </div>
                            <div class="coluna tituloColunas ">
                            Nível
                            </div>
                            
                            <div class="coluna tituloColunas smallColPlus" >
                            Ações
                            </div>
                            <div class="coluna tituloColunas smallCol" >
                            Ativação
                            </div>
                            <button class="btnAdd" id="btnUser" onclick="openInsertModal('modal.usuario.php', '#modalUsuario', '#addNivel')">Adicionar Usuário</button>

                    </div>
                        
                        <?php 
                            while($rsUsuarios = mysqli_fetch_array($selectUser)) {
                        ?>
                            <div class="containerColunasAlt">
                                <div class="indexRegistro smallCol indexNivel">
                                    <?php
                                    echo($rsUsuarios['matricula'])
                                    ?>
                                </div>
                                 <div class="coluna colMaior colNivel">
                                    <?php echo($rsUsuarios['nomeUsuario'])?>
                                 </div>
                                <div class="coluna  ">
                                    <?php echo($rsUsuarios['nomeNivel'])?>
                                </div>
                                <div class="colAcao smallColPlus" >
                                    <!-- LINK MODAL-->
                                    <a href="#" onclick="openEditNivel(<?php echo($rsUsuarios['matricula'])?>, 'modal.usuario.php', '#modalUsuario', '#addNivel')" class="editModal">
                                        <figure class="acao">
                                            <img src="../imagens/edit.png" title="Editar Dados" alt="ViewData" class="linkModal">
                                        </figure>
                                    </a>

                                     <a href="adm.usuarios.php?modo=excluiruser&id=<?php echo($rsUsuarios['matricula'])?>">
                                         <figure class="acao">
                                            <img src="../imagens/delete.png" title="Excluir Registro" alt="excluir">
                                        </figure>
                                     </a>
                                    <a href="#"  class="viewModal" onclick="openViewUser(<?php echo($rsUsuarios['matricula'])?>, 'view', 'modal.usuario.php', '#modalUsuario', '#addNivel')">
                                         <figure class="acao">
                                            <img src="../imagens/view.png" title="Visualizar Dados" alt="excluir"
                                           >
                                        </figure>
                                     </a>
                                 </div>
                                <div class="colAcao smallCol">
                                  
                                    <figure>
                                            <img src="<?php echo($rsUsuarios['isAtivado'] == 0) ? '../imagens/desativo.png' : '../imagens/active.png' ?>" 
                                                 
                                            title="Clique para ativar/desativar" alt="excluir" class="imgAtivo" >
                                    </figure>
                                    
                                </div>
                            </div>
                        <?php
                                }
                        ?>
    <?php 
        require_once('footer.php');
    ?>

 