<?php
    /* Essas variaveis armazenam os dados necessários para a conexão com o banco*/
    $host = "localhost";
    $database = "db_woody_woodpecker";
    $user = "randerson";
    $password = "r@nd3rs0n";
    
    if(!$conexao = mysqli_connect($host, $user, $password, $database)) {
        echo("<script>
                alert('Não foi possível realizar a conexão');
        </script>");
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
    <script>
        //Usando JQuery
        $(document).ready(function() {
           $(".viewModal").click(function() {
              $("#containerModal").fadeIn(600); 
           }); 
            
            
        });
            /*
                O elemento AJAX será utilizado para fazer a page modal.php aparecer dentro da div modal onde o usuário possa analisar os dados de cada registro do fale conosco.
            */
        function modal() {
            $.ajax({
               type: "get", //tipo de envio
               url: "modal.php", //page requisitada
               //caso o elemento obtenha sucesso ele irá carregar o html dentro da div modal
               
               success: function(dados){
                   $("#modal").html(dados);
               } 
            })
        }
    </script>
    <body>
        <div id="containerModal">
            <div id="viewDados"></div>
        </div>
        <div id="containerCMS">
             <header id="headerCMS">
                  <div id="containerHeaderCMS">
                <h1 id="tituloCMS">
                    <span >
                        CMS - Sistema de Gerenciamento Do Site
                    </span>
                </h1> 
                
                <figure id="logo">
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
                         <a href="adm.fale.conosco.html"class = "linkmenu">
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
                    <div class="containerColunas">
                        <div class="coluna tituloColunas" id="primeiraColuna">
                            Nome
                        </div>
                         <div class="coluna colEmail tituloColunas" >
                            E-mail
                        </div>
                         <div class="coluna tituloColunas" >
                            Profissão
                        </div>
                         <div class="coluna tituloColunas" >
                            Celular
                        </div>
                        <div class="coluna tituloColunas smallCol" >
                            Ações
                        </div>
                        
                    </div>
                    
                    <!-- esses elementos farão parte do looping 
                        Aqui aparecerão as consultas 
                    -->
                    <?php
                        $sql = "select * from tbl_fale_conosco order by id";
                        //enviando para o banco
                        $select = mysqli_query($conexao, $sql );
                    
                   //convertendo os registros em vetores
                    while($rsContatos=mysqli_fetch_array($select)) {
                    
                    ?>
                    <div class="containerColunas">
                        <div class="indexRegistro smallCol">
                            <?php echo($rsContatos['id'])?>
                        </div>
                        <div class="coluna">
                            <?php echo($rsContatos['nomeContato'])?>
                        </div>
                         <div class="coluna colEmail">
                             <?php echo($rsContatos['emailContato'])?>
                        </div>
                        <div class="coluna">
                             <?php echo($rsContatos['profissao'])?>
                        </div>
                        <div class="coluna">
                             <?php echo($rsContatos['celular'])?>
                        </div>
                         <div class="colAcao smallCol" >
                             <!-- LINK MODAL-->
                             <a class="viewModal" href="#" onclick="modal()">
                                <figure class="acao">
                                    <img src="../imagens/view.png" title="Visualizar Dados" alt="ViewData">
                                </figure>
                                 </a>
                             
                                 <figure class="acao">
                                    <img src="../imagens/delete.png" title="Excluir Registro" alt="excluir">
                                </figure>
                            
                        </div>
                    </div>
                    <?php 
                        } 
                    ?>
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