<?php

    require_once('conexao.php');
    require_once('function.php');

    $conexao = conexaoBD();
    $sqlUpdate = '';
//------------------------PREPARAÇÃO DOS RESULTSETS--------------------------------
    $sqlSelect = selecionar('tbl_sobre', 'idSobre');

    $selectSobre = mysqli_query($conexao, $sqlSelect);

    //select da loja
    $sqlLojas = selecionar('tbl_lojas', 'idLoja');

    $selectLoja = mysqli_query($conexao, $sqlLojas);

    //select da loja
    $sqlLivro = selecionar('tbl_livro', 'titulo');

    $selectLivro = mysqli_query($conexao, $sqlLivro);

    //select das promocoes
    $sqlPromo = selecionar('tbl_promocao', 'id');
                            
    $selectPromo = mysqli_query($conexao, $sqlPromo);

     //select dos autores
     $sqlAutor = selecionar('tbl_autor', 'idAutor');
                            
     $selectAutor = mysqli_query($conexao, $sqlAutor);

//------------------------FIM DOS RESULTSETS--------------------------------

    $valueBtn = 'Cadastrar';

    $btn = null;

    $isbn = "";
    $valPercent = "";

    if(isset($_POST['btnSalvarSobre'])) {
        @$btn = $_POST['btnSalvarSobre'];
       
        //echo("oi");
        @$isbn = $_POST['sltProdutos'];
           
        @$valPercent = $_POST['txtPercent'];
          
        //pegando a descrição
        
        @$descrip = $_POST['txtDesc'];

        //dados do autor
        @$nome = $_POST['txtNome'];
        @$dtNascimento =   $_POST['txtDtNasc'];
        @$dtFalecimento =  $_POST['txtDtFal'];
        @$cidadeNascimento =  $_POST['txtLocalNasc'];

        //convertendo data para o padrão americano
        @$data = explode("/", $dtNascimento);
        @$dtNascimento = $data[2]. "-" .$data[1]. "-" .$data[0];
        
        @$dataFal = explode("/", $dtFalecimento);
        @$dtFalecimento = $dataFal[2]. "-" .$dataFal[1]. "-" .$dataFal[0];
        //dados da loja
        if(isset($_POST['txtEmailLoja'])) {
            $email = $_POST['txtEmailLoja'];
            $logradouro =  $_POST['txtLogradouro'];
            $bairro =  $_POST['txtBairro'];
            $cidade =  $_POST['txtCidade'];
            $uf =  $_POST['cbEstado'];
            $cep =  $_POST['txtCep'];
            $telefone = $_POST['txtTelefone'];
        }
      
        //pegando o nome do arquivo de foto
        @$file = $_FILES['fleFoto']['name'];

        //nome do arquivo sem a extensão
        $filename = pathinfo($file, PATHINFO_FILENAME);

        //criptografando o nome do arquivo, sem permitir repetições nos padrões
        $filename = md5(uniqid(time()).$filename);

        //nome do diretório que armazenará os arquivos, já criptografados, inseridos pelo user
         $dir = "imgs_uploads/";

        //armazenando o nome temporário do file
        @$arquivo_tmp = $_FILES['fleFoto']['tmp_name'];
            
        //pegando a extensão do arquivo
        $extfile = strrchr($file, ".");
            
        //setando um padrão para armazenagem
        $img = $dir . $filename . $extfile;
         
        //pegando o tamanho do arquivo
        @$filesize = $_FILES['fleFoto']['size'];

        //tranforma de bytes para kbytes
        $filesize = round($filesize / 1024);


        if($btn == 'Cadastrar') {
           
            //condicional para verificar o tamanho do arquivo permitido pelo servidor
            if($filesize <= 2000) {
                
                if(move_uploaded_file($arquivo_tmp, $img) && $descrip != null 
                    ) {
                    $sql = "insert into tbl_sobre(descricao, imgSobre, isAtivado) 
                    values('".$descrip."','".$img."','".getAtivacao()."')";
                   
                        
                    //desativando todos caso no insert o user ative o registro
                    if(getAtivacao() == 1) {
                       desabilitarTodos('tbl_sobre', 'idSobre', $conexao);
                    }
                    
                    if(isset($_POST['txtEmailLoja'])) {
                        
                        //insert nos endereços
                         $sqlEndereco = "insert into tbl_endereco(logradouro, bairro, cidade, uf, cep, telefone) 
                    values('".$logradouro."','".$bairro."','".$cidade."','".$uf."','".$cep."','".$telefone."');";
                        
                        mysqli_query($conexao, $sqlEndereco); 
                        //pegando o id do endereco para relacionar com a tab de lojas
                        $sqlBuscarEndereco = "select * from tbl_endereco order by id desc limit 1 ";
                        
                        $selectEndereco = mysqli_query($conexao, $sqlBuscarEndereco);
                        
                        $rsEnd = mysqli_fetch_array($selectEndereco);
                        
                         
                        $sql = "insert into tbl_lojas(email, descricao, imgLoja, isAtivado, idEndereco) 
                    values('".$email."','".$descrip."','".$img."',".getAtivacao()."
                    ,".$rsEnd['id'].")";
                   
                   
                    
                    //echo($sql);
                        
                    }
                    if(isset($_POST['txtNome'])) {
                         $sql = "insert into tbl_autor(nome, dtNascimento, dtFalecimento,  
                         cidadeNascimento, breveBiografia, imgAutor, isAtivado) 
                         values('".$nome."','".$dtNascimento."','".$dtFalecimento."',
                         '".$cidadeNascimento."','".$descrip."','".$img."'
                         ,".getAtivacao().")";
                         
                         
                        
                         //desativando todos caso no insert o user ative o registro
                        if(getAtivacao() == 1) {
                            desabilitarTodos('tbl_autor', 'idAutor', $conexao);
                        }
                    }
                     // header('location:adm.conteudo.php');
                   
                } 
            
            //Já que o promoções não vai cadastrar imagens, deve ficar longe do procedimento para tratar files
            if(isset($_POST['sltProdutos'])) {
                @$sql = "insert into tbl_promocao(isbn, percentualDesconto, isAtivado) 
                values('".$isbn."',".(float)$valPercent .",".getAtivacao().")";
                $sqldesativa= "update tbl_promocao set isAtivado = 0 where 
                id<>". $_SESSION['codigo']. " and isbn=".$isbn;
                
               if(getAtivacao() == 1) {
                   desabilitarTodos('tbl_promocao', 'id', $conexao);
               }
            }
        }
            mysqli_query($conexao, $sqldesativa);

            mysqli_query($conexao, $sql);
            header("location:adm.conteudo.php");    
        } else if($btn == 'Editar') {
            //editar sem imagem, irá prevenir o upload repetido de imgs
            if($filesize == 0) {
                $atv = 0;
                if(isset($_POST['checkAtivacao'])) {
                    $atv = 1;
                }
                $sqlUpdate = update("tbl_sobre", "descricao='".$descrip."', isAtivado=".$atv, 'idSobre',  $_SESSION['codigo']);
                $sqldesativa = setUnicoAtivado('tbl_sobre', 'idSobre', $_SESSION['codigo']);
                //editando lojas
                if(isset($_POST['txtEmailLoja'])) {
                    $sqlUpdate = update("tbl_lojas", "email = '".$email."', descricao='".$descrip."', isAtivado=".$atv, 'idLoja',  $_SESSION['codigo']);
                    
                    $sqlUpdateEndereco = update("tbl_endereco", "logradouro = '".@$logradouro."', 
                    bairro='".@$bairro."', cidade='".@$cidade."', uf='".@$uf."', cep='".@$cep."', telefone='".@$telefone."'", 'id',   @$_SESSION['cod_endereco']);
                    mysqli_query($conexao, $sqlUpdateEndereco);
                }
                //editando autores
                if(isset($_POST['txtNome'])) {
                    $sqlUpdate = update("tbl_autor", "nome = '".$nome."', dtFalecimento='".$dtFalecimento."', 
                    dtNascimento='".$dtNascimento."', cidadeNascimento='".$cidadeNascimento."', 
                    breveBiografia='".$descrip."', isAtivado=".$atv, 'idAutor',  $_SESSION['codigo']);
                    $sqldesativa = setUnicoAtivado('tbl_autor', 'idAutor', $_SESSION['codigo']);

                }

                
            }
            if(move_uploaded_file($arquivo_tmp, $img)) {
                    $atv = 0;
                    if(isset($_POST['checkAtivacao'])) {
                        $atv = 1;
                    }
                    $sqlUpdate = update("tbl_sobre", "descricao='".$descrip."', imgSobre='"
                    .$img."', isAtivado=".$atv, 'idSobre',  $_SESSION['codigo']);
                    $sqldesativa = setUnicoAtivado('tbl_sobre', 'idSobre', $_SESSION['codigo']);

                
                    //editando lojas
                    if(isset($_POST['txtEmailLoja'])) 
                        $sqlUpdate = update("tbl_lojas", "email = '".$email."', descricao='".$descrip."', imgLoja='"
                        .$img."', isAtivado=".$atv, 'idLoja',  $_SESSION['codigo']);
                
                    //editando autores
                    if(isset($_POST['txtNome'])) {
                        $sqlUpdate = update("tbl_autor", "nome = '".$nome."', dtFalecimento='".$dtFalecimento."', 
                        dtNascimento='".$dtNascimento."', cidadeNascimento='".$cidadeNascimento."', 
                        breveBiografia='".$descrip."', imgAutor='" .$img."', isAtivado=".$atv, 'idAutor',  $_SESSION['codigo']);
                        $sqldesativa = setUnicoAtivado('tbl_autor', 'idAutor', $_SESSION['codigo']);

                    }
            }

            if(isset($_POST['sltProdutos'])) {
               
                $sqlUpdate = update('tbl_promocao', "isbn='".$isbn."', percentualDesconto='".
                $valPercent."', isAtivado=".getAtivacao(), 'id',$_SESSION['codigo']);
                

                $sqldesativa= "update tbl_promocao set isAtivado = 0 where 
                id<>". $_SESSION['codigo']. " and isbn=".$isbn;

            }
            mysqli_query($conexao, $sqldesativa);

            mysqli_query($conexao, $sqlUpdate);
            header("location:adm.conteudo.php");    
               
        }
    }

    //condição pra deletar e mostrar dados em editar
    if(isset($_GET['modo'])) {
        $modo = $_GET['modo'];
        $_SESSION['codigo'] = $_GET['id'];
      
        if($modo == 'excluir') {
            $tab = $_GET['tab'];

            //função de delete 
            if($tab == 'promo')
                $delete = delete('tbl_promocao', 'id', $_SESSION['codigo']);
            
            if($tab == 'autor')
                $delete = delete('tbl_autor', 'idAutor', $_SESSION['codigo']);
            
            if($tab == 'loja')
                $delete = delete('tbl_lojas', 'idLoja', $_SESSION['codigo']);
            
            if($tab == 'sobre')
                $delete = delete('tbl_sobre', 'idSobre', $_SESSION['codigo']);
            
            mysqli_query($conexao, $delete);
            header("location:adm.conteudo.php");
            
        } 
      
        else if($modo == 'editar') {
            $selectSobreUp = mysqli_query($conexao, selecionar('tbl_sobre', 'idSobre'
            , 'idSobre ='.$_SESSION['codigo']));

            $valueBtn = 'Editar';

            $rsSobreUp = mysqli_fetch_array($selectSobreUp);
        } else if($modo == 'editarloja') {
            $_SESSION['cod_endereco'] = $_GET['idend'];
            
             $selectLojaUp = mysqli_query($conexao, selecionar('tbl_lojas_enderecos', 'idLoja'
            , 'idLoja ='.$_SESSION['codigo']));

            $valueBtn = 'Editar';

            $rsLojaUp = mysqli_fetch_array($selectLojaUp);
            
        } else if($modo == 'editarpromo') {
             //echo("<script>alert('oi')</script>");
             $sql = selecionar('tbl_promocao', 'isbn'
             , 'id ='.$_SESSION['codigo']);
              $selectPromoUp = mysqli_query($conexao, $sql);
             
             $valueBtn = 'Editar';
 
             $rsPromoUp = mysqli_fetch_array($selectPromoUp);

             $valorOption = $rsPromoUp['isbn'];
             
         } else if($modo == 'editarautor') {
           
             $selectAutorUp = mysqli_query($conexao, selecionar('tbl_autor', 'idAutor'
            , 'idAutor ='.$_SESSION['codigo']));

            $valueBtn = 'Editar';

            $rsAutorUp = mysqli_fetch_array($selectAutorUp);
            
        }
        
    
        }
   // header("location:adm.conteudo.php");

        //Consulta do botão
        if(isset($_GET['ativado'])) {
            $atv = $_GET['ativado']; //guarda o status da ativação do registro
            $isbn = $_GET['isbn'];

            if($atv == 0) {

                $atv = 1;

            } else {
                $atv = 0; 
            }

            $sqlUpdateAtv = "update tbl_livro set livroEmDestaque=".$atv." where isbn=".$isbn;
            
            echo($sqlUpdateAtv);
            mysqli_query($conexao, $sqlUpdateAtv);
            header('location:adm.conteudo.php');
        }

        
   
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
                       
                        <button class="tablink"  onclick=" openForm(event, 'formAutores')" id="openByDefault" >
                                Autores</button>
                       
                        <a id="lojas">
                            <button class="tablink" onclick=" openForm(event, 'formLojas')"  id="tabLoja">Lojas</button>
                        </a>
                       
                        <button class="tablink" onclick=" openForm(event, 'formProduto')"  id="tabProdDestaque">Produto do Mês</button>
                       
                       
                        <button class="tablink" onclick=" openForm(event, 'formPromo')"  id="tabPromo" >Promoções</button>
                        
                        
                        <button class="tablink" onclick=" openForm(event, 'formSobre')"  id="tabSobre">Sobre </button>
                        
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
                        <?php 
                            require_once('frmlivrodestaque.php');
                        ?> 
                 </div>

                   <!-- Form de Promoções -->
                   <div id="formPromo" class="tabcontent">
                        <?php 
                            require_once('frmpromocao.php');
                        ?> 
                  </div>

                    <!-- Form de Autores -->
                    <div id="formAutores" class="tabcontent">
                        <?php 
                            require_once('frmautor.php');
                        ?> 
                  </div>

        
                                  
<?php 
    require_once('footer.php');
?>           