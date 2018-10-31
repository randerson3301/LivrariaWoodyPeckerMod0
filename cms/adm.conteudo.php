<?php

    require_once('conexao.php');
    require_once('function.php');

    $conexao = conexaoBD();

    $sqlSelect = selecionar('tbl_sobre', 'idSobre');

    $selectSobre = mysqli_query($conexao, $sqlSelect);

    $valueBtn = 'Cadastrar';

    $btn = null;

   // $_SESSION['id'] = $_GET['id'];

    if(isset($_POST['btnSalvarSobre'])) {
        $btn = $_POST['btnSalvarSobre'];
        
        //pegando a descrição
        $descrip = $_POST['txtDesc'];
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

                    mysqli_query($conexao, $sql);

                    header("location:adm.conteudo.php");
                }

            }
        } else if($btn == 'Editar') {
            if(move_uploaded_file($arquivo_tmp, $img)) {

            $sqlUpdate = update("tbl_sobre", "descricao='".$descrip."', imgSobre='"
            .$img."', isAtivado=".getAtivacao(), 'idSobre',  $_SESSION['codigo']);
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
            header("location:adm.conteudo.php");
        }

        if($modo == 'editar') {
            $selectSobreUp = mysqli_query($conexao, selecionar('tbl_sobre', 'idSobre'
            , 'idSobre ='.$_SESSION['codigo']));

            $valueBtn = 'Editar';

            $rsSobreUp = mysqli_fetch_array($selectSobreUp);

            

        }
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
                        <button class="tablink" onclick=" openForm(event, 'formNivel')">Lojas</button>
                         <button class="tablink" onclick=" openForm(event, 'formNivel')">Produto do Mês</button>
                        <button class="tablink" onclick=" openForm(event, 'formNivel')">Promoções</button>
                         <button class="tablink" id="openByDefault" onclick=" openForm(event, 'formSobre')">Sobre </button>
                    </div>
                    
                    
                    <div id="formSobre" class="tabcontent">
                        <!--<button class="btnAdd" id="btnNivel" onclick="openInsertModal('modal.sobre.php', '#modalSobre')">Adicionar Sobre</button>-->
                        
                        <form name="frmSobre" class="frmConteudo" action="adm.conteudo.php" method="POST" enctype="multipart/form-data">  
                            <h2>Cadastro Sobre</h2>
                            <div class="divisorModal alignLeft">
                                Imagem:  <input type="file" name="fleFoto" id="foto" accept="image/*" 
                                onchange="readURL(this)"> <br>
                                <div class="contImg">
                                    <img src= "<?php echo(@$rsSobreUp['imgSobre'])?>"
                                     class="img" id="img" alt="selecione..." title="Imagem escolhida">
                                </div>
                              Ativação:<br>
                                      <label class="switch"> 
                                            <input type="checkbox" class="sliderBox" name="checkAtivacao"
                                                <?php echo(@$rsSobreUp['isAtivado'] == 1) ? 'checked':''?>>
                                            <span class="slider round"></span> 
                                
                            </div>
                            <div class="divisorModal">
                                Descrição: <textarea class="txtareaConteudo" name="txtDesc"> <?php echo(
                                    @$rsSobreUp['descricao'])?></textarea>
                                <input type="submit" value="<?php echo($valueBtn)?>" name="btnSalvarSobre" class="btnAdd fontsize">
                            </div>
                           
                        </form>
                        <div class="containerColunas centerManual">
                        
                            <div class="coluna tituloColunas  colMaior" >
                            Imagem
                            </div>
                            <div class="coluna tituloColunas colMaiorText">
                            Descrição
                            </div>
                            <div class="coluna tituloColunas smallColPlus" >
                            Ações
                            </div>
                            <div class="coluna tituloColunas smallCol" >
                            Ativação
                            </div>
                        </div>
                    
                        <?php 
                           while($rsSobre=mysqli_fetch_array($selectSobre)) {
                        ?>
                                <div class="containerColunas centerManual colunaComFoto">
                                   <div class="coluna  colMaior" >
                                       <figure>
                                            <img src="<?php echo($rsSobre['imgSobre'])?>" alt="Imagem Sobre"
                                            title="Imagem de Fundo">
                                       </figure>
                                       
                                    </div>
                                    <div class="coluna  colMaiorText">
                                        <?php echo($rsSobre['descricao'])?>
                                    </div>
                                    <div class="coluna  smallColPlus" >
                                        <a href="adm.conteudo.php?modo=editar&id=<?php echo($rsSobre['idSobre'])?>">
                                            <figure class="acao">
                                                <img src="../imagens/edit.png" title="Editar Dados" alt="ViewData" class="linkModal"
                                                >
                                            </figure>
                                        </a>
                                        <a href="adm.conteudo.php?modo=excluir&id=<?php echo($rsSobre['idSobre'])?>">
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
                                    <div class="coluna  smallCol" >
                                        <figure>
                                            <img src="<?php echo($rsSobre['isAtivado'] == 0) ? '../imagens/desativo.png' : '../imagens/active.png' ?>" 
                                            title="ativar/desativar" alt="excluir" class="imgAtivo" >
                                        </figure>
                                    
                                    </div>
                                </div>  
                            
                        <?php 
                            }
                        ?>
                        
<?php 
    require_once('footer.php');
?>           