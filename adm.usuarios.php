<?php

    require_once('conexao.php');

    echo('oi');

    $conexao = conexaoBD();
    
    $sql = "select * from tbl_nivel order by idNivel";

    //enviando para o servidor
    $select = mysqli_query($conexao, $sql);

    //utilizando os parametros da modal
    if(isset($_POST['btnEnviarNivel']) && $valueBtn=="Cadastrar") { 
        //verificando se o botão foi clicado
        $nivel = $_POST['txtNivel'];
        //comando de insert para popular no banco
        $sqlInsert = "insert into tbl_nivel(nomeNivel) values('".$nivel."')";
         
        mysqli_query($conexao, $sqlInsert);

        header("location:adm.usuarios.php");
        
    } else if(isset($_POST['btnEnviarNivel']) && $valueBtn=="Atualizar") { 
        //verificando se o botão foi clicado
        $nivel = $_POST['txtNivel'];
        //comando de insert para popular no banco
        $sqlUpdate = "update tbl_nivel set nomeNivel=".$nivel;
         
        mysqli_query($conexao, $sqlInsert);

        header("location:adm.usuarios.php");
        
    }

    if(isset($_GET['modo'])) {
        $modo = $_GET['modo'];
        $codigo = $_GET['id'];

       if($modo == 'excluir') {
           
             $sqlDelete="delete from tbl_nivel where idNivel =".$codigo;
            
             mysqli_query($conexao, $sqlDelete);
             header('location:adm.usuarios.php');
        } 
    } 

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title> CMS WW</title>
        <meta charset="utf-8">
        <link href="css/cms.style.css" rel="stylesheet" type="text/css">
        <link href="../css/reset.css" rel="stylesheet" type="text/css">
        <script src="../js/script.js"></script>
        <script src="../js/jquery.js"></script>

    </head>
    <body>
        <script>
            alert('oi');
            
            $(document).ready(function() {
                $('.btnAdd').click(function(){
                  $("#containerModal").fadeIn(400);
                });
                
                $('.editModal').click(function() {
                  $("#containerModal").fadeIn(400);
                });
            });
            
            function openAddNivel(){
                $.ajax({
                    type:"post",
                    url: "modal.nivel.php",
                    processData: "false",
                    dataType:"text",
                    success: function(dados) {
                        $("#addNivel").html(dados)
                    }
                })
                
            function openEditNivel(id){
                $.ajax({
                    type:"post",
                    url: "modal.nivel.php",
                    data: {idRegistro: id},
                    success: function(dados) {
                        $("#addNivel").html(dados)
                    }
                })
            }
        </script>
         <!-- ESSAS SÃO AS DIVS DA MODAL-->
        <div id="containerModal">
            <div id="addNivel"></div>
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
                        <button class="btnAdd" onclick="openAddNivel()">Adicionar Nível</button>
                        <div class="containerColunas">
                            <div class="coluna tituloColunas colunaNivel">
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
                            <div class="colAcao smallCol">
                             <!-- LINK MODAL-->
                             <a href="adm.usuarios.php?modo=editar&id=<?php echo($rsNiveis['idNivel'])?>" class="editModal" onclick="openEditNivel(<?php echo($rsNiveis['idNivel'])?>)">
                                <figure class="acao">
                                    <img src="../imagens/edit.png" title="Editar Dados" alt="ViewData">
                                </figure>
                            </a> 
                             <a href="adm.usuarios.php?modo=excluir&id=<?php echo($rsNiveis['idNivel'])?>">
                                 <figure class="acao">
                                    <img src="../imagens/delete.png" title="Excluir Registro" alt="excluir">
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