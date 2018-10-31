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
            
        
        //pegando o nome do atrquivo de foto
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
            echo('ta aqui');
            
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
                         <button class="tablink" onclick=" openForm(event, 'formNivel')">Produto do Mês</button>
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
                         <form name="frmSobre" class="frmConteudo" action="adm.conteudo.php" method="POST" enctype="multipart/form-data">  
                            <h2>Cadastro Lojas</h2>
                            <div class="divisorModal alignLeft">
                                Imagem:  <input type="file" name="fleFoto" id="foto" accept="image/*" 
                                onchange="readURL(this, '#imgLoja')"> <br>
                                <div class="contImg">
                                    <img src= "<?php echo(
                                    @$rsLojaUp['imgLoja'])?>"
                                     class="img" id="imgLoja" alt="selecione..." title="Imagem escolhida">
                                </div>
                              Ativação:<br>
                                <label class="switch"> 
                                            <input type="checkbox" class="sliderBox" name="checkAtivacao"
                                                <?php echo(@$rsLojaUp['isAtivado'] == 1) ? 'checked':''?>>
                                <span class="slider round"></span> </label>
                                
                            </div>
                            <div class="divisorModal">
                                Descrição: <textarea class="txtareaConteudo areaMenor" name="txtDesc"> <?php echo(
                                    @$rsLojaUp['descricao'])?></textarea>
                                
                                E-mail:<br> <input type="text" name="txtEmailLoja" class=" txtDados spaceBetween" value="<?php echo(@$rsLojaUp['email'])?>">
                                <input type="submit" value="<?php echo($valueBtn)?>" name="btnSalvarSobre" class="btnAdd fontsize">
                            </div>
                           
                        </form>
                        <div class="containerColunas centerManual">
                        
                            <div class="coluna tituloColunas  colMaior" >
                            Imagem
                            </div>
                            <div class="coluna tituloColunas colMaiorText">
                            E-mail
                            </div>
                            <div class="coluna tituloColunas smallCol" >
                            Ações
                            </div>
                            <div class="coluna tituloColunas smallCol" >
                            Ativação
                            </div>
                        </div>
                    
                        <?php 
                           while($rsLoja=mysqli_fetch_array($selectLoja)) {
                        ?>
                                <div class="containerColunas centerManual colunaComFoto">
                                   <div class="coluna  colMaior" >
                                       <figure>
                                            <img src="<?php echo($rsLoja['imgLoja'])?>" alt="Imagem Sobre" class="imgRegistro"
                                            title="Imagem de Fundo">
                                       </figure>
                                       
                                    </div>
                                    <div class="coluna  colMaiorText">
                                        <?php echo($rsLoja['email'])?>
                                    </div>
                                    <div class="coluna  smallCol" >
                                        <a href="adm.conteudo.php?modo=editarloja&id=<?php echo($rsLoja['idLoja'])?>">
                                            <figure class="acao">
                                                <img src="../imagens/edit.png" title="Editar Dados" alt="ViewData" class="linkModal"
                                                >
                                            </figure>
                                        </a>
                                        <a href="adm.conteudo.php?modo=excluirloja&id=<?php echo($rsLoja['idLoja'])?>">
                                            <figure class="acao">
                                                <img src="../imagens/delete.png" title="Excluir Registro" alt="excluir">
                                            </figure>
                                        </a>
                                    </div>
                                    <div class="coluna  smallCol" >
                                        <figure>
                                            <img src="<?php echo($rsLoja['isAtivado'] == 0) ? '../imagens/desativo.png' : '../imagens/active.png' ?>" 
                                            title="ativar/desativar" alt="excluir" class="imgAtivo" >
                                        </figure>
                                    
                                    </div>
                                </div>  
                       
                         
                        <?php 
                            }
                        ?>
                    </div>
                                  
<?php 
    require_once('footer.php');
?>           