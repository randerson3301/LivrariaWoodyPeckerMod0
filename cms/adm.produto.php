<?php
    
    
    
    $sql = null;
   
    //default
    $valueOption = 0;
    $itemOption = "Selecione...";
    $valueBtn = "Salvar";
    
    // variaveis para o select de editora
    $valueOptEditora = 0;
    $itemOptEditora = "Selecione um item ...";

     // variaveis para o select de categoria
     $valueOptCat = 0;
     $itemOptCat= "Selecione um item ...";
            
     // variaveis para o select de sub-categoria
     $valueOptSub = 0;
     $itemOptSub= "Selecione um item ...";
     
     require_once('conexao.php');
     require_once('function.php');

            if(isset($_GET['tab'])){
                $tab = $_GET['tab'];

                if($tab == 'cat')
                    //echo("boa noite");
                    $opencateg = "id='openByDefault'";
                if($tab == 'subcat')
                    $opensubcateg = "id='openByDefault'";
                if($tab == 'livro')
                    $openlivro = "id='openByDefault'";
            }

            if($_SESSION['nivel'] != 28 && $_SESSION['nivel'] != 27 )
        header("location:cms.home.php");    

            $conexao = conexaoBD();
            if(isset($_POST['btnSalvarSobre'])) {
                //dados da tbl_livro
                //recolhendo dados
                @$isbn = $_POST["txtisbn"];
                @$title = $_POST["txttitle"];
                @$num_pag = $_POST["txtNumPage"];
                @$ano_pub = $_POST["txtAno"]; //ano de publicação do livro
                @$edicao =  $_POST["txtEdicao"];
                @$volume = $_POST["txtVol"];
                @$preco =  $_POST["txtPreco"];
                @$desc = $_POST["txtDesc"];
                @$editora =  $_POST["slteditora"];
                @$autor = $_POST["sltAutores"];
                @$default_tab = "tab=livro";
                @$subcateg = $_POST['sltSubCat'];


                $btn = $_POST['btnSalvarSobre'];
                @$categoria = $_POST["txtCategoria"];
                $default_tab = null;
                if($btn == "Editar") {
                //preparando comando update
                     $sql = update('tbl_categoria', " categoria='".$categoria."', 
                    ativacao=".getAtivacao(), "id_categoria", $_SESSION['codigo']);
                    $default_tab = "tab=cat";
                    
                    if(isset($_POST['txtSubCat'])) {
                        $subcat = $_POST["txtSubCat"];
                        $idcategoria = $_POST["sltCategorias"];
                        $default_tab = "tab=subcat";

                        $sql = update('tbl_sub_categoria', 
                                      " sub_categoria='".$subcat."', id_categoria=".$idcategoria.",
                    ativacao=".getAtivacao(), "id_sub_categoria", $_SESSION['codigo']);
                    }

                    if(isset($_POST['txtisbn'])) {
                        $default_tab = 'tab=livro';
                        require_once('uploadimg.php');  

                        if($filesize == 0) {
                           $sqlUpdateLivro =  update('tbl_livro', "isbn = '$isbn', titulo = '$title', 
                            numeroPaginas = $num_pag,
                            anoPublicacao = $ano_pub,
                            edicao = $edicao,
                            volume = $volume,
                            preco = $preco,
                            descricao = '$desc',
                            cnpjEditora = $editora,
                            id_sub_categoria = $subcateg,
                            isAtivado=".getAtivacao(), "isbn", $_SESSION['codigo']);
                        } else if(move_uploaded_file($arquivo_tmp, $img)) {
                            $sqlUpdateLivro =  update('tbl_livro', "isbn = '$isbn', titulo = '$title', 
                            imgLivro = '$img',
                            numeroPaginas = $num_pag,
                            anoPublicacao = $ano_pub,
                            edicao = $edicao,
                            volume = $volume,
                            preco = $preco,
                            descricao = '$desc',
                            cnpjEditora = $editora,
                            id_sub_categoria = $subcateg,
                            isAtivado=".getAtivacao(), "isbn", $_SESSION['codigo']);
                        }

                        mysqli_query($conexao, utf8_decode($sqlUpdateLivro));
                       
                    }

                    //echo($sql);
                } else {
                    //preparando comando insert
                    $sql = "insert into tbl_categoria(categoria, ativacao) 
                    values('".  $categoria."',".getAtivacao().")";
                    $default_tab = "tab=cat";  
                  
                    
                    //insert da subcategoria
                    if(isset($_POST["txtSubCat"])) {
                        $subcat = $_POST["txtSubCat"];
                        $default_tab = "tab=subcat";

                        $idcategoria = $_POST["sltCategorias"];
                         $sql = null;
                        if($idcategoria != 0) {
                            $sql = "insert into tbl_sub_categoria(sub_categoria, 
                            id_categoria, ativacao) 
                            values('".$subcat."',".$idcategoria.",".getAtivacao().")";
                        } else {
                            echo("<script>alert('Por favor, selecione um item!')</script>");
                            exit("Volte, e tente novamente");
                        }
                     } 
                    if(isset($_POST["txtisbn"])) {
                            $default_tab = 'tab=livro';
                            require_once('uploadimg.php');  
                          //se a imagem for carregada...
                            if($filesize <= 2000) {
                                if(move_uploaded_file($arquivo_tmp, $img)) {
                                    $sqlLivro = "insert into tbl_livro
                                    (isbn,
                                    titulo,
                                    imgLivro,
                                    numeroPaginas,
                                    anoPublicacao,
                                    edicao,
                                    volume,
                                    preco,
                                    descricao,
                                    cnpjEditora,
                                    id_sub_categoria,
                                    isAtivado,
                                    livroEmDestaque
                                    )
                                    values('$isbn', '$title', '$img', $num_pag, $ano_pub, 
                                    $edicao, $volume, $preco, 
                                    '$desc', '$editora', $subcateg, ".getAtivacao().", 0)";

                                    mysqli_query($conexao, $sqlLivro);
                                    //echo($sqlLivro);
                                   
                                    //var_dump($autor);
                                    
                                    //echo($sqlLivro);

                                   
                                   
                                }
                            }
                     } 
                            
                     
                    
                    /*
                        o comando utf8_decode converte uma string para o padrão 
                        utf-8(permite acentuações, cedilha e etc.) antes de enviar a 
                        string ao banco, dessa forma caracteres esquisitos não aparecem
                        no banco.

                        o comando utf8_encode realiza a mesma função, porém converte o 
                        que vem do banco para o sistema
                    */
                    
                }
                //querys do crud de livros
                 echo($sql);
                 
                if(!isset($_POST['txtisbn'])) {
                    mysqli_query($conexao, utf8_decode(@$sql));
                }
               header("location:adm.produto.php?$default_tab");
               
            }
            
            
            //trabalhando com modos na URL
            if(isset($_GET['modo'])) {
                $modo = $_GET['modo'];
                $_SESSION['codigo'] = $_GET['id'];
                
               // echo($modo." e ".$_SESSION['codigo']);
               if($modo == 'editar') {
                    $selectCatUp = mysqli_query($conexao, selecionar('tbl_categoria', 'id_categoria'
                     , 'id_categoria ='.$_SESSION['codigo']));
                   
                   $rsCategoriaUp = mysqli_fetch_array($selectCatUp);
               }
                if($modo == 'editarsub') {
                    //echo("<script>alert('oeee')</script>");
                    
                    $sqlSubCat = "select tsb.*, tc.categoria, tc.id_categoria from tbl_sub_categoria tsb inner join tbl_categoria tc where tsb.id_categoria = tc.id_categoria and tsb.id_sub_categoria=". $_SESSION['codigo'];
                    
                    $selectCatUp2 = mysqli_query($conexao, utf8_encode($sqlSubCat));
                    
                    $rsSubCatUp = mysqli_fetch_array($selectCatUp2);
                    
                    $itemOption = $rsSubCatUp["categoria"];
                    
                    $valueOption = $rsSubCatUp["id_categoria"];
                } 

                if($modo == 'editarlivro'){
                    $isbn_sessao = $_SESSION['codigo'];
                    //$sqlLivroUp = "call sp_consulta_livro('$isbn_sessao')";

                    //echo($sqlLivroUp);

                    

                    $retorno = callprocedure($conexao, 'sp_consulta_livro', $isbn_sessao);
                   
                    if($retorno) {
                       //para cada retorno como rslivro
                        foreach($retorno as $rslivro) {
                            //recolhendo dados...
                            $isbn = $rslivro['isbn'];
                            $title = $rslivro['titulo'];
                            $img = $rslivro['imgLivro'];
                            $num_pag = $rslivro['numeroPaginas'];
                            $ano_pub = $rslivro['anoPublicacao'];
                            $edicao =$rslivro['edicao'];
                            $volume=$rslivro['volume'];
                            $preco = $rslivro['preco'];
                            $desc = $rslivro['descricao'];
                            
                            //valores para o select de editora
                            $valueOptEditora = $rslivro['cnpjEditora'];
                            $itemOptEditora = $rslivro['nomeFantasia'];
                            
                            //valores para o select de categoria
                            $valueOptCat = $rslivro['id_categoria'];
                            $itemOptCat = $rslivro['categoria'];
                            
                            //valores para o select de categoria
                            $valueOptSub = $rslivro['id_sub_categoria'];
                            $itemOptSub = $rslivro['sub_categoria'];
                            
                            $ativacao = $rslivro['isAtivado'];

                        }                          
                    //}
                    /*
                    $sltlivro=mysqli_query($conexao, $sqlLivroUp);

                    $rslivro=mysqli_fetch_array($sltlivro);

                    $isbn = $rslivro['isbn'];
                    */
                }
            }
                $valueBtn = 'Editar';
                
                //**********tratando modos***********
              if($modo == 'excluir') {
                    $tab = $_GET['tab'];
        
                    //função de delete 
                    if($tab == 'cat') {
                        $delete = delete('tbl_categoria', 'id_categoria', $_SESSION['codigo']);
                        $default_tab = "tab=cat";
                    }
                    if($tab == 'subcat'){
                        $delete = delete('tbl_sub_categoria', 'id_sub_categoria', $_SESSION['codigo']);
                        $default_tab = "tab=subcat";
                    }
                    if($tab == 'livro'){
                        $delete = delete('tbl_livro', 'isbn', $_SESSION['codigo']);
                        $default_tab = "tab=livro";
                    }
                    mysqli_query($conexao, $delete);
                   
                    header("location:adm.produto.php?$default_tab");     
                }
                
            }

            require_once('head.html');
            require_once('header.php');
            require_once('containerCMS.php');
?>
    
    <div class="tab">
        <button class="tablink "  onclick="openForm(event, 'formCategoria');" <?php echo(@$opencateg)?>>
                Categoria</button>
        <button class="tablink"   onclick="openForm(event, 'formSubCat');" <?php echo(@$opensubcateg)?>>
            Sub-Categoria</button>

        <button class="tablink"  onclick="openForm(event, 'formProduto');" <?php echo(@$openlivro)?>>
           Produto</button>
        <button class="tablink"  onclick="openForm(event, 'formProduto');" <?php echo(@$openlivro)?>>
           Livro e Autor</button>
    </div>
           <!-- Form de Categorias -->
           <div id="formCategoria" class="tabcontent">
               <?php 
                    require_once("frmcategoria.php");
               ?>
           </div>

            <!-- Form de Sub-Categorias -->
            <div id="formSubCat" class="tabcontent">
                <?php 
                    require_once("frmsubcategoria.php");
                ?>
          </div>

          <!-- Form de Produtos -->
          <div id="formProduto" class="tabcontent">
                <form name="frmProduto" id="frmProduto" method="POST" action="adm.produto.php?tab=livro"
                class="formMaior frmConteudo" enctype="multipart/form-data"
                >
                <h2>Gerenciador de Produtos</h2> <br>
                
                <div class="divisorModal alignLeft">
                    ISBN: <input type="number" name="txtisbn" value="<?php echo(@$isbn)?>" id="txtisbn" 
                    class="txtDados spaceBetween">
                    Título: <input type="text" name="txttitle" id="txttitle" 
                    class="txtDados spaceBetween" value="<?php echo(@$title)?>">
                    Imagem:  <input type="file" name="fleFoto" id="foto" accept="image/*" 
                    onchange="readURL(this, '#imgBook')"> <br>
                    <div class="contImg contImgAutor spaceBetween">
                            <img src= "<?php echo(
                                    @$img)?>"
                                     class="img" id="imgBook" alt="selecione..." title="Imagem escolhida">
                    </div>
                    N° de páginas: <input type="number" name="txtNumPage" id="txtNumPage" 
                    class="spaceBetween txtMenor" value="<?php echo(@$num_pag)?>"> <br>
                    Ano de Publicação: <input type="number" name="txtAno" id="txtAno" 
                    class="spaceBetween txtMenor" value="<?php echo(@$ano_pub)?>"> <br>
                    Edição: <input type="number" name="txtEdicao" id="txtEdicao" 
                    class="spaceBetween txtMenor" value="<?php echo(@$edicao)?>"><br>
                    Volume: <input type="number" name="txtVol" id="txtVol" 
                    class="spaceBetween txtMenor" value="<?php echo(@$volume)?>">

                </div>
                <div class="divisorModal">
                    Preço(em R$): <input type="text" name="txtPreco" id="txtPreco" 
                    class="spaceBetween txtMenor" value="<?php echo(@$preco)?>"> <br>
                    Descrição: 
                    <textarea  onkeypress="return validar(event, 'num', this.id);" 
                    class="txtareaConteudo areaMenor" name="txtDesc" id="txtDesc" required><?php echo(utf8_encode(@$desc))?>
                    </textarea>
                    
                    Editora: &nbsp; <select class="txtDados spaceBetween sltmenor"  name="slteditora">
                           <option value="<?php echo($valueOptEditora)?>"> 
                                            <?php echo(utf8_encode($itemOptEditora))?>
                                        </option>                                                                            
                        <?php
                            $sqleditora = selecionar('tbl_editora', 'cnpjEditora',  'cnpjEditora <>'. $valueOption);
                              
                              
                             // echo($sqlCat);
                            $slteditora = mysqli_query($conexao, $sqleditora);
                                       
                            while($rseditora=mysqli_fetch_array($slteditora)) {     
                                       ?>
                                <option id="option" value="<?php echo($rseditora['cnpjEditora'])?>"> 
                                    <?php echo(utf8_encode($rseditora['nomeFantasia'])) ?>
                              </option>
                        <?php } ?></select><br>

                    Categoria: <select class="txtDados spaceBetween sltmenor" name="sltCategoria"  id="sltCategoria">
                    <option value="<?php echo(@$valueOptCat)?>"> 
                            <?php echo(@$itemOptCat)?>
                        </option>
                                                                        
                        <?php
                            $sqlcateg = selecionar('tbl_categoria', 'id_categoria',  "ativacao = 1 and id_categoria <>".$valueOption);
                              
                              
                             // echo($sqlCat);
                            $sltcateg = mysqli_query($conexao, $sqlcateg);
                            $id_categoria = null; 
                            $rscateg = null;
                            while($rscateg=mysqli_fetch_array($sltcateg)) { 
                                  
                                       ?>
                                
                                <option value="<?php echo($rscateg['id_categoria'])?>"> 
                                    <?php echo(utf8_encode($rscateg['categoria'])) ?>
                              </option>
                        <?php } ?></select><br>
                    Sub-Categoria: 
                    <select class="txtDados spaceBetween sltmenor" name="sltSubCat" id="sltSubCat">
                        <option value="<?php echo(@$valueOptSub)?>"> 
                            <?php echo(utf8_encode(@$itemOptSub))?>
                        </option>
                    </select><br>
                   Ativação: 
                    <label class="switch"> 
                        <input type="checkbox" class="sliderBox" name="checkAtivacao"
                        <?php echo(@$ativacao == 1)?'checked' : ''?>>
                        <span class="slider round"></span>
                     </label> 
                  
                      <input type="reset" name="btnSalvarSobre" value="Limpar" class="btnReset spaceBetween btnEnviar">

                      <input type="submit" name="btnSalvarSobre" value="<?php echo($valueBtn)?>" class="btnAdd spaceBetween btnEnviar">

                </div>
            </form>
          </div>
          <div class="containerQuery">
          <!--
           resultados da consulta aparecerão aqui -->
          <div class="containerColunas ">
            
                <div class="coluna tituloColunas " >
                Imagem
                </div>
                <div class="coluna tituloColunas colMaior">
                Titulo
                </div>
                <div class="coluna tituloColunas smallColPlus" >
                ISBN
                </div>
                <div class="coluna tituloColunas smallCol colunaSemFloat" >
                Ativação
                </div>
                <div class="coluna tituloColunas smallCol" >
                     Ações
                </div>
                            
            </div>
              
             
        
            <?php 
                $sqlquery = "select * from tbl_livro order by titulo asc";
                $selectLivro = mysqli_query($conexao, $sqlquery);
               while($rsLivro=mysqli_fetch_array($selectLivro)) {
            ?>
                    <div class="containerColunas  colunaComFoto">
                       <div class="coluna " >
                           <figure>
                                <img src="<?php echo($rsLivro['imgLivro'])?>" alt="Imagem Sobre" class="imgLivro"
                                title="Imagem de Fundo">
                           </figure>
                           
                        </div>
                        <div class="coluna  colMaior">
                            <?php echo(utf8_encode($rsLivro['titulo']))?>
                        </div>
                        <div class="coluna  smallColPlus" >
                             <?php echo($rsLivro['isbn'])?>
                        </div>
                        <div class="coluna  smallCol " >
                          
                            <a href="adm.conteudo.php?tab=destaque&ativado=<?php echo($rsLivro['livroEmDestaque'])?>&isbn=<?php echo($rsLivro['isbn'])?>"> 
                                   <?php
                                   ?>
                                <figure>
                                        <img src="<?php echo($rsLivro['isAtivado'] == 0) ? '../imagens/desativo.png' : '../imagens/active.png' ?>" 

                                        title="Clique para ativar/desativar" alt="excluir" class="imgAtivo" >
                                </figure>
                            </a>
                            
                         </div>
                         <div class="coluna  smallCol" >
                                <a href="adm.produto.php?tab=livro&modo=editarlivro&id=<?php echo($rsLivro['isbn'])?>">
                                        <figure class="acao">
                                                <img src="../imagens/edit.png" title="Editar Dados" alt="ViewData" class="linkModal"
                                                        >
                                          </figure>
                                          </a>
                                           <a href="adm.produto.php?modo=excluir&tab=livro&id=<?php echo($rsLivro['isbn'])?>">
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
          <script>
        $(document).ready(function(){
            $("#sltCategoria").on('change', function(){
                    var idcat = $(this).val();
                
                    
                   /*Se o value do objeto passado existir, ele fará uma requisição ajax
                   em busca das sub-categorias */
                    if(idcat){
                        $.ajax({
                            type:'POST',
                            url: 'getsubcategoria.php',
                            data: 'id_categoria='+idcat,
                           
                            success:function(html){
                                //o select de subcategorias será carregado com o html retornado
                                $('#sltSubCat').html(html);
                                //alert(html);
                            },
                            //tratando erros na requisição...
                            error:function(xmlHttpRequest, textStatus, errorThrown){
                                alert(errorThrown);
                            }
                        });
                    } else {
                        $('#sltSubCat').html("<option value= ''>Selecione uma categoria </option>")
                    }
                    
                   

                });
            
             
        });

        

        
    </script>
      
<?php 
        require_once('footer.php');
?>