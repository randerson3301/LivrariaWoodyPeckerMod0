<?php

    require_once('conexao.php');
    require_once('function.php');

    $conexao = conexaoBD();
    
//------------------------PREPARAÇÃO DOS RESULTSETS--------------------------------
    $sqlSelect = selecionar('tbl_sobre', 'idSobre');

    $selectSobre = mysqli_query($conexao, $sqlSelect);

    //select da loja
    $sqlLojas = selecionar('tbl_lojas', 'idLoja');

    $selectLoja = mysqli_query($conexao, $sqlLojas);

//------------------------FIM DOS RESULTSETS--------------------------------

    $valueBtn = 'Cadastrar';

    $btn = null;

   // $_SESSION['id'] = $_GET['id'];

    if(isset($_POST['btnSalvarSobre'])) {
        $btn = $_POST['btnSalvarSobre'];
        
        //pegando a descrição
        
        $descrip = $_POST['txtDesc'];
        
        if(isset($_POST['txtEmailLoja'])) 
            $email = $_POST['txtEmailLoja'];
            
        
        //pegando o nome do arquivo de foto
        $file = $_FILES['fleFoto']['name'];

        //nome do arquivo sem a extensão
        $filename = pathinfo($file, PATHINFO_FILENAME);

        //criptografando o nome do arquivo, sem permitir repetições nos padrões
        $filename = md5(uniqid(time()).$filename);

        //nome do diretório que armazenará os arquivos, já criptografados, inseridos pelo user
        $dir = "imgs_uploads/";

        //armazenando o nome temporário do file
        $arquivo_tmp = $_FILES['fleFoto']['tmp_name'];
        
        //pegando a extensão do arquivo
        $extfile = strrchr($file, ".");
        
        //setando um padrão para armazenagem
        $img = $dir . $filename . $extfile;

        if($btn == 'Cadastrar') {
            //pegando o tamanho do arquivo
            $filesize = $_FILES['fleFoto']['size'];

            //tranforma de bytes para kbytes
            $filesize = round($filesize / 1024);

            //condicional para verificar o tamanho do arquivo permitido pelo servidor
            if($filesize <= 2000) {
                if(move_uploaded_file($arquivo_tmp, $img)) {
                    $sql = "insert into tbl_sobre(descricao, imgSobre, isAtivado) 
                    values('".$descrip."','".$img."','".getAtivacao()."')";
                    
                    if(isset($_POST['txtEmailLoja']))
                         $sql = "insert into tbl_lojas(email, descricao, imgLoja, isAtivado) 
                    values('".$email."','".$descrip."','".$img."','".getAtivacao()."')";
                        
                            
                    mysqli_query($conexao, $sql);

                    header("location:adm.conteudo.php");
                }

            }
        } else if($btn == 'Editar') {
            if(move_uploaded_file($arquivo_tmp, $img)) {
                $atv = 0;
                    if(isset($_POST['checkAtivacao'])) {
                        $atv = 1;
                    }

            $sqlUpdate = update("tbl_sobre", "descricao='".$descrip."', imgSobre='"
            .$img."', isAtivado=".$atv, 'idSobre',  $_SESSION['codigo']);
            
                if(isset($_POST['txtEmailLoja'])) 
                    $sqlUpdate = update("tbl_lojas", "email = '".$email."', descricao='".$descrip."', imgLoja='"
                    .$img."', isAtivado=".$atv, 'idLoja',  $_SESSION['codigo']);
             

             echo($sqlUpdate);
             mysqli_query($conexao, $sqlUpdate);
             header("location:adm.conteudo.php");
            }
         }  
    }

    //condição pra deletar
    if(isset($_GET['modo'])) {
        $modo = $_GET['modo'];
        $_SESSION['codigo'] = $_GET['id'];

        if($modo == 'excluir') {
            //função de delete 
            $delete = delete('tbl_sobre', 'idSobre', $_SESSION['codigo']);
            mysqli_query($conexao, $delete);
            
        } else if ($modo == 'excluirloja') {
            $delete = delete('tbl_lojas', 'idLoja', $_SESSION['codigo']);
            mysqli_query($conexao, $delete);
        }
        
       

        if($modo == 'editar') {
            $selectSobreUp = mysqli_query($conexao, selecionar('tbl_sobre', 'idSobre'
            , 'idSobre ='.$_SESSION['codigo']));

            $valueBtn = 'Editar';

            $rsSobreUp = mysqli_fetch_array($selectSobreUp);
        } else if($modo == 'editarloja') {
           // echo('ta bem aqui mano');
            
             $selectLojaUp = mysqli_query($conexao, selecionar('tbl_lojas', 'idLoja'
            , 'idLoja ='.$_SESSION['codigo']));

            $valueBtn = 'Editar';

            $rsLojaUp = mysqli_fetch_array($selectLojaUp);
            
        }
         //header("location:adm.conteudo.php");
    }

   // header("location:adm.conteudo.php");
?>

    <?php
        require_once('head.html');
    ?>
        
         <!-- ESSAS SÃO AS DIVS DA MODAL-->
        <div id="containerModal">
            <div id="modalSobre"></div>
          
        </div>
            <?php 
                require_once('header.php');
                require_once('containerCMS.php');

            ?>
                   <div class="tab">
                        <button class="tablink"  onclick=" openForm(event, 'PRECISA MUDAR')">Autores</button>
                        <button class="tablink" onclick=" openForm(event, 'formLojas')">Lojas</button>
                         <button class="tablink" onclick=" openForm(event, 'formProduto')">Produto do Mês</button>
                        <button class="tablink" onclick=" openForm(event, 'formNivel')">Promoções</button>
                         <button class="tablink" id="openByDefault" onclick=" openForm(event, 'formSobre')">Sobre </button>
                    </div>
                    
                  <!-- Form de Sobre -->    
                    <div id="formSobre" class="tabcontent">
                        <?php 
                            require_once('frmsobre.php');
                        ?>
                    </div>

                <!-- Form de Lojas -->
                <div id="formLojas" class="tabcontent">
                        <?php 
                            require_once('frmlojas.php');
                        ?>  
                </div>

                 <!-- Form de Produto do mês -->
                 <div id="formProduto" class="tabcontent">
                 </div>

        
                                  
<?php 
    require_once('footer.php');
?>           