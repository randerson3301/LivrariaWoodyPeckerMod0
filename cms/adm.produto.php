<?php
    
    
    $valueBtn = "Salvar";
    $itemOption = "Selecione um item ...";
    $valueOption = 0;
            require_once('conexao.php');
            require_once('function.php');

            if($_SESSION['nivel'] != 28 && $_SESSION['nivel'] != 27 )
        header("location:cms.home.php");    

            $conexao = conexaoBD();
            if(isset($_GET['btnSalvarSobre'])) {
                $btn = $_GET['btnSalvarSobre'];
                @$categoria = $_GET["txtCategoria"];

                if($btn == "Editar") {
                     //preparando comando update
                     $sql = update('tbl_categoria', " categoria='".$categoria."', 
                    ativacao=".getAtivacao("get"), "id_categoria", $_SESSION['codigo']);
                    
                    if(isset($_GET['txtSubCat'])) {
                        $subcat = $_GET["txtSubCat"];
                        $idcategoria = $_GET["sltCategorias"];

                        $sql = update('tbl_sub_categoria', 
                                      " sub_categoria='".$subcat."', id_categoria=".$idcategoria.",
                    ativacao=".getAtivacao("get"), "id_sub_categoria", $_SESSION['codigo']);
                    }

                    //echo($sql);
                } else {
                    //preparando comando insert
                    $sql = "insert into tbl_categoria(categoria, ativacao) 
                    values('".  $categoria."',".getAtivacao("get").")";
                    
                    echo($sql);

                    if(isset($_GET["txtSubCat"])) {
                        $subcat = $_GET["txtSubCat"];
                        $idcategoria = $_GET["sltCategorias"];
                         $sql = null;
                        if($idcategoria != 0) {
                            $sql = "insert into tbl_sub_categoria(sub_categoria, 
                            id_categoria, ativacao) 
                            values('".$subcat."',".$idcategoria.",".getAtivacao("get").")";
                        } else {
                            echo("<script>alert('Por favor, selecione um item!')</script>");
                            exit("Volte, e tente novamente");
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
                echo($sql);
                mysqli_query($conexao, utf8_decode($sql));
                header("location:adm.produto.php");
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
                $valueBtn = 'Editar';
                
                

              if($modo == 'excluir') {
                    $tab = $_GET['tab'];
        
                    //função de delete 
                    if($tab == 'cat')
                        $delete = delete('tbl_categoria', 'id_categoria', $_SESSION['codigo']);
                    
                    if($tab == 'subcat')
                        $delete = delete('tbl_sub_categoria', 'id_sub_categoria', $_SESSION['codigo']);
                    
                    mysqli_query($conexao, $delete);
                    header("location:adm.produto.php");
                    
                } 
            }

            require_once('head.html');
            require_once('header.php');
            require_once('containerCMS.php');
?>
    <div class="tab">
        <button class="tablink"  onclick="openForm(event, 'formCategoria'); openByDefault(this.id)">
                Categoria</button>
        <button class="tablink"   onclick="openForm(event, 'formSubCat'); openByDefault(this.id)">
            Sub-Categoria</button>

        <button class="tablink"  id="openByDefault"" onclick="openForm(event, 'formProduto'); openByDefault(this.id)">
           Produto</button>
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
                <form name="frmProduto" id="frmProduto" action="POST"
                class="formMaior frmConteudo" enctype="multipart/form-data"
                >
                <h2>Gerenciador de Produtos</h2> <br>
                <div class="divisorModal alignLeft">
                    ISBN: <input type="number" name="txtisbn" id="txtisbn" 
                    class="txtDados spaceBetween">
                    Título: <input type="text" name="txttitle" id="txttitle" 
                    class="txtDados spaceBetween">
                    Imagem:  <input type="file" name="fleFoto" id="foto" accept="image/*" 
                    onchange="readURL(this, '#imgLoja')"> <br>
                    <div class="contImg contImgAutor spaceBetween"></div>
                    N° de páginas: <input type="number" name="txtNumPage" id="txtNumPage" 
                    class="spaceBetween txtMenor"> <br>
                    Ano de Publicação: <input type="number" name="txtAno" id="txtAno" 
                    class="spaceBetween txtMenor"> <br>
                    Edição: <input type="number" name="txtEdicao" id="txtEdicao" 
                    class="spaceBetween txtMenor"><br>
                    Volume: <input type="number" name="txtVol" id="txtVol" 
                    class="spaceBetween txtMenor">

                </div>
                <div class="divisorModal">
                    Preço(em R$): <input type="number" name="txtPreco" id="txtPreco" 
                    class="spaceBetween txtMenor"> <br>
                    Descrição: <textarea  onkeypress="return validar(event, 'num', this.id);" class="txtareaConteudo areaMenor" name="txtDesc"  id="txtDesc" required></textarea>
                    
                    Editora: &nbsp; <select class="txtDados spaceBetween sltmenor" name="sltCategorias">
                           <option value="<?php echo($valueOption)?>"> 
                                            <?php echo(utf8_encode($itemOption))?>
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
                    Autor: &nbsp;  &nbsp; <select class="txtDados spaceBetween sltmenor" name="sltAutores"> <option value="<?php echo($valueOption)?>"> 
                                            <?php echo(utf8_encode($itemOption))?>
                                        </option>                                                                            
                        <?php
                            $sqlautor = selecionar('tbl_autor', 'idAutor',  'idAutor <>'. $valueOption);
                              
                              
                             // echo($sqlCat);
                            $sltautor = mysqli_query($conexao, $sqlautor);
                                       
                            while($rsautor=mysqli_fetch_array($sltautor)) {     
                                       ?>
                                <option id="option" value="<?php echo($rsautor['idAutor'])?>"> 
                                    <?php echo(utf8_encode($rsautor['nome'])) ?>
                              </option>
                        <?php } ?></select><br>
                    Categoria: <select class="txtDados spaceBetween sltmenor" name="sltCategoria"> <option value="<?php echo($valueOption)?>"> 
                                            <?php echo(utf8_encode($itemOption))?>
                                        </option>                                                                            
                        <?php
                            $sqlcateg = selecionar('tbl_categoria', 'id_categoria',  'id_categoria <>'. $valueOption);
                              
                              
                             // echo($sqlCat);
                            $sltcateg = mysqli_query($conexao, $sqlcateg);
                                       
                            while($rscateg=mysqli_fetch_array($sltcateg)) {     
                                       ?>
                                <option id="option" value="<?php echo($rscateg['id_categoria'])?>"> 
                                    <?php echo(utf8_encode($rscateg['categoria'])) ?>
                              </option>
                        <?php } ?></select><br>
                    Sub-Categoria: <select class="txtDados spaceBetween sltmenor" name="sltSubCat"></select><br>
                   Ativação: 
                    <label class="switch"> 
                        <input type="checkbox" class="sliderBox" name="checkAtivacao">
                        <span class="slider round"></span>
                     </label> 
                     Destaque:
                     <label class="switch"> 
                         <input type="checkbox" class="sliderBox" name="checkAtivacao">
                         <span class="slider round"></span>
                      </label>
                      <input type="submit" name="btnSalvar" value="Salvar" class="btnAdd spaceBetween btnEnviar">
 
                </div>
            </form>
          </div>
       
<?php 
        require_once('footer.php');
?>