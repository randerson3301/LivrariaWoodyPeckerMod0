<?php

    //require_once('conexao.php');
    require_once('function.php');
    
    $atv;
    
    @$conexao = conexaoBD();
    
    

    $sqlUser = "select tlu.*, tn.nomeNivel from tbl_usuarios tlu inner join tbl_nivel tn on tlu.idNivel = tn.idNivel";

    //enviando para o servidor
    $select = selecionar('tbl_nivel', 'idNivel') ;

    //var_dump($select);
    $selectUser = mysqli_query($conexao, $sqlUser);

  // echo($_SESSION['valueBtn']);

    //utilizando os parametros da modal
    if(isset($_POST['btnEnviar']) && isset($_SESSION['valueBtn'])) {
            if($_SESSION['valueBtn'] == 'Cadastrar') {
                                    //echo($sqlInsert);

                //echo('efefe');
                //verificando se o botão foi clicado
                if(isset($_POST['txtNivel'])) {
                    $nivel = $_POST['txtNivel'];
                    //comando de insert para popular no banco
                    $sqlInsert = "insert into tbl_nivel(nomeNivel) values('".$nivel."')";
                    
                    echo($sqlInsert);

                     mysqli_query($conexao, $sqlInsert);
                } else {
                   // echo("<script> alert('auo');</script>");
                    
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
                    
                    $sqlInsert = "insert into tbl_usuarios(matricula, nomeUsuario, senha, emailUsuario, loginNome, isAtivado, idNivel) values('".$matricula."', '".$nome."', '".$senha."','".$email."', '".$loginname."', '".$atv."', '".$nivelUser."')";

                    mysqli_query($conexao, $sqlInsert);
                    
                }
            

            
            header("location:adm.usuarios.php");
            }
        
    } else if(isset($_POST['btnEnviar']) && $_SESSION['valueBtn'] == "Atualizar") { 
        //verificando se o botão foi clicado
        $nivel = $_POST['txtNivel'];
        //comando de insert para popular no banco
        
        
        $sqlUpdate = "update tbl_nivel set nomeNivel='".$nivel."' where idNivel=".$_SESSION["cod"];
    
        mysqli_query($conexao, $sqlUpdate);
            
        /*
        var_dump(update("tbl_nivel",  "nomeNivel='".$nivel."'" ,$idNivel, $_SESSION["cod"]));
       */ header("location:adm.usuarios.php");

    }
        
    if(isset($_GET['modo'])) {
        $modo = $_GET['modo'];
        $codigo = $_GET['id'];

       if($modo == 'excluir') {
             //função de delete 
             delete('tbl_nivel', 'idNivel', $codigo);
             header('location:adm.usuarios.php');
        }  
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

<!DOCTYPE html>
<html lang="pt-br">
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
                $('#btnNivel').click(function(){
                  $("#containerModal").fadeIn(400);
                });
                
                $('.editModal').click(function(){
                  $("#containerModal").fadeIn(400);
                });
                
                $('#btnUser').click(function() {
                   $("#containerModal").fadeIn(400);
                   $("#addNivel").hide();
                })
                
            });
            //o usuário irá definir através de parametros qual a url e o elemento onde ele deseja carregar o html
            function openInsertModal(url, elet){
                $.ajax({
                    type:"post",
                    url: url,
                    processData: "false",
                    dataType:"text",
                    success: function(dados) {
                        $(elet).html(dados)
                    }
                })
            }
            
            function openEditNivel(idItem, url, container, hideEle){
                $.ajax ({
                    type:"post",
                    url:url,
                    data: {idRegistro: idItem},
                    success: function(dados){
                       $(container).html(dados);
                        $(hideEle).hide();
                    }
                })
            }
            
        </script>
         <!-- ESSAS SÃO AS DIVS DA MODAL-->
        <div id="containerModal">
            <div id="addNivel"></div>
             <div id="modalUsuario"></div>
        </div>
        <div id="containerCMS">
             <header id="headerCMS">
                  <div id="containerHeaderCMS">
                <h1 id="tituloCMS">
                    <span >
                        CMS - Sistema de Gerenciamento Do Site
                    </span>
                </h1> 
                
                <figure id="logoCMS">
                    <img src="../imagens/logocms.png" alt="LOGO" title="Woody Woodpecker" id= "logocms">
                    <figcaption>WOODY WOODPECKER S/A</figcaption>
                </figure>
            </div>
             
            <nav id="menuCMS">
                <div id="containerMenuCMS">
                <ul id="menu-header">
                    <li class="itemcms">
                         <a href="adm.usuarios.html"class = "linkmenu">
                        <figure>
                            <img src="../imagens/conadmin.png" class="imgItens">
                            <figcaption >Adm. Conteúdo</figcaption>
                        </figure>
                        </a>
                    </li>
                     <li class="itemcms">
                         <a href="adm.fale.conosco.php"class = "linkmenu">
                            <figure>
                                <img src="../imagens/faleadmin.png" class="imgItens">
                                <figcaption >Adm. Fale Conosco</figcaption>
                            </figure>
                        </a>
                     </li>
                     <li class="itemcms">
                         <a href="adm.produtos.html"class = "linkmenu">
                        <figure>
                            <img src="../imagens/prodadmin.png" class="imgItens">
                            <figcaption >Adm. Produtos</figcaption>
                        </figure>
                        </a>
                     </li>
                    <li class="itemcms">
                         <a href="adm.usuarios.html"class = "linkmenu">
                         <figure>
                            <img src="../imagens/useradmin.png" class="imgItens">
                            <figcaption >Adm. Usuários</figcaption>
                        </figure>
                        </a>
                    </li>
                </ul>
                </div>
                <!-- Aqui conterá a mensagem de bem vindo, e a opção de logout-->
                <div id="containerBemVindo">
                    Bem Vindo *************
                    
                    <span id="logout"><a href="#">Logout</a></span>
                </div>
              </nav>
            </header>  
            
            <div id="contentCMS">
                <div id="containerCentral">
                    <div class="tab">
                        <div class="tablink">Usuários</div>
                        <div class="tablink">Níveis</div>
                    </div>
                    
                    <div id="formNivel">
                        <button class="btnAdd" id="btnNivel" onclick="openInsertModal('modal.nivel.php', '#addNivel')">Adicionar Nível</button>
                        <div class="containerColunas">
                            <div class="coluna tituloColunas espacador">
                            Nível
                            </div>
                            <div class="coluna tituloColunas smallCol" >
                            Ações
                            </div>
                            <div class="coluna tituloColunas smallCol" >
                            Ativação
                            </div>
                    </div>
                        
                        <?php 
                            while($rsNiveis = mysqli_fetch_array($select)) {
                        ?>
                            <div class="containerColunas">
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
                                    <a href="#" onclick="openEditNivel(<?php echo($rsNiveis['idNivel'])?>, 'modal.nivel.php', '#addNivel', '#modalUsuario')" class="editModal">
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
                                            <img src="<?php echo($rsNiveis['isAtivado'] == 0) ? '../imagens/desativo.png' : '../imagens/active.png' ?>" title="Clique para ativar/desativar" alt="excluir" id="imgAtivo" >
                                    </figure>
                                    </a>
                                </div>
                            </div>
                            <?php
                                }
                            ?>
                       </div>
                    <div id="formUser">
                        <button class="btnAdd" id="btnUser" onclick="openInsertModal('modal.usuario.php', '#modalUsuario')">Adicionar Usuário</button>
                        <div class="containerColunas">
                            
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
                    </div>
                        
                        <?php 
                            while($rsUsuarios = mysqli_fetch_array($selectUser)) {
                        ?>
                            <div class="containerColunas">
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

                                     <a href="adm.usuarios.php?modo=excluir&id=<?php echo($rsNiveis['idNivel'])?>">
                                         <figure class="acao">
                                            <img src="../imagens/delete.png" title="Excluir Registro" alt="excluir">
                                        </figure>
                                     </a>
                                    <a href="adm.usuarios.php?modo=view&id=<?php echo($rsUsuarios['matricula'])?>">
                                         <figure class="acao">
                                            <img src="../imagens/view.png" title="Excluir Registro" alt="excluir">
                                        </figure>
                                     </a>
                                 </div>
                                <div class="colAcao smallCol">
                                   <a href="adm.usuarios.php?ativado=<?php echo($rsNiveis['isAtivado'])?>&id=<?php echo($rsNiveis['idNivel'])?>"> 
                                       <?php
                                       ?>
                                    <figure>
                                            <img src="<?php echo($rsUsuarios['isAtivado'] == 0) ? '../imagens/desativo.png' : '../imagens/active.png' ?>" 
                                                 
                                            title="Clique para ativar/desativar" alt="excluir" id="imgAtivo" >
                                    </figure>
                                    </a>
                                </div>
                            </div>
                            <?php
                                }
                            ?>
                       </div>
                     </div>
                </div>  
           
            <!-- rodapé do site-->
            <footer>
                <div id="textFooter">
                    Desenvolvido por Randerson Mendes
                </div>
            </footer>
        </div>
    </body>
</html>