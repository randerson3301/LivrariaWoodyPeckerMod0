<?php
    $valueBtn = "Salvar";
    $itemOption = "Selecione um item ...";
    $valueOption = 0;
            require_once('conexao.php');
            require_once('function.php');

            $conexao = conexaoBD();
            if(isset($_GET['btnSalvarSobre'])) {
                $btn = $_GET['btnSalvarSobre'];
                @$categoria = $_GET["txtCategoria"];

                if($btn == "Editar") {
                     //preparando comando update
                     $sql = update('tbl_categoria', " categoria='".$categoria."', 
                    ativacao=".getAtivacao("get"), "id_categoria", $_SESSION['codigo']);

                    //echo($sql);
                } else {
                    //preparando comando insert
                    $sql = "insert into tbl_categoria(categoria, ativacao) 
                    values('".  $categoria."',".getAtivacao("get").")";

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
                        echo($sql);
                       
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
                mysqli_query($conexao, utf8_decode($sql));
                header("location:adm.produto.php");
            }
            
            
            //trabalhando com modos na URL
            if(isset($_GET['modo'])) {
                $modo = $_GET['modo'];
                $_SESSION['codigo'] = $_GET['id'];
                
               // echo($modo." e ".$_SESSION['codigo']);
               if($modo == 'editar') 
                    $selectCatUp = mysqli_query($conexao, selecionar('tbl_categoria', 'id_categoria'
                     , 'id_categoria ='.$_SESSION['codigo']));
               
                if($modo == "editarsub") {
                    $sqlCatUp = "SELECT tsb.*, tc.categoria FROM tbl_sub_categoria tsb inner join tbl_categoria tc WHERE tc.id_categoria =". $_SESSION["codigo"];
                    $selectCatUp = mysqli_query($conexao, $sqlCatUp);
                    $rsSubCatUp = mysqli_fetch_array($selectCatUp);
                    $itemOption = $rsSubCatUp['categoria'];
                }
                $valueBtn = 'Editar';
                
                $rsCategoriaUp = mysqli_fetch_array($selectCatUp);

              if($modo == 'excluir') {
                    $tab = $_GET['tab'];
        
                    //função de delete 
                    if($tab == 'cat')
                        $delete = delete('tbl_categoria', 'id_categoria', $_SESSION['codigo']);
                    
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
        <button class="tablink"  id="openByDefault" onclick="openForm(event, 'formSubCat'); openByDefault(this.id)">
            Sub-Categoria</button>

        <button class="tablink"  id="openByDefaultNivel" onclick="openForm(event, 'formNivel'); openByDefault(this.id)">
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
               
           <form action="adm.produto.php" method="GET" name="frmCategoria" class="frmConteudo frmMenor"> 
                  <h2>Gerenciador de  Sub-categorias </h2><br>
                           
                      Digite uma Sub-Categoria <br>
                       <input type="text" name="txtSubCat"  id="txtSubCat" onkeypress="return validar(event, 'num', this.id);" 
                       class="txtDados "
                         value="<?php echo(utf8_encode(@$rsSubCatUp['sub_categoria']))?>"><br>
                         <span class="spaceBeetween">Selecione uma categoria: </span><br>
                         <select class="txtDados spaceBetween sltmenor" name="sltCategorias">
                                        <option value="<?php echo($valueOption)?>"> 
                                            <?php echo($itemOption)?>
                                        </option>
                                       
                                       <?php 
                                       $sqlCat = selecionar('tbl_categoria', 'id_categoria',  'id_categoria <> '. $valueOption
                                       );
                                        $selectCategoria = mysqli_query($conexao, $sqlCat);
                                       
                                       while( $rscateg=mysqli_fetch_array($selectCategoria)) { ?>
                                            <option id="option" value="<?php echo($rscateg['id_categoria'])?> "> 
                                                 <?php echo(utf8_encode($rscateg['categoria'])) ?>
                                            </option>
                                       <?php } ?>
                                    </select><br>
                          Ativação: <br> 
                          <label class="switch">
                            <input type="checkbox"  <?php echo(@$rsCategoriaUp['ativacao'] == 1) ? 'checked' : ''?> name="checkAtivacao" 
                                       > 
                             <span class="slider round"></span>
                            </label> <br>
                           <input type="submit" name="btnSalvarSobre" value="<?php echo($valueBtn)?>" class="spaceBeetween btnEnviar">
                             
            </form>

            <div  class="containerColunas centerManual">
                        <div class="containerColunasAlt">
                            <div class="coluna tituloColunas espacador colMaior">
                            Sub-Categoria
                            </div>
                            <div class="coluna tituloColunas  colMaior">
                            Categoria
                            </div>
                            <div class="coluna tituloColunas smallCol" >
                            Ações
                            </div>
                            <div class="coluna tituloColunas smallCol" >
                            Ativação
                            </div>
                        </div>
                     </div>
            <!-- retornando as linhas da tabela -->
            <?php 
                $sqlcategorias = "SELECT tsb.*, tc.categoria FROM tbl_sub_categoria tsb inner join tbl_categoria tc WHERE tsb.id_categoria =tc.id_categoria";
                $selectsub = mysqli_query($conexao, $sqlcategorias);

                //config no resultset do banco
                while($rsSubCategoria = mysqli_fetch_array($selectsub)) { 
                     // echo(utf8_encode($rsCategoria["categoria"])."<br>");
                    ?>
                     <div class="containerColunasAlt centerManual">
                        <div class="coluna  espacador colMaior">
                            <?php echo(utf8_encode($rsSubCategoria["sub_categoria"])) ?>
                        </div>
                        <div class="coluna   colMaior">
                             <?php echo(utf8_encode($rsSubCategoria["categoria"])) ?>
                        </div>
                        <div class="coluna  smallCol" >
                        <a href="adm.produto.php?modo=editarsub&id=<?php echo($rsSubCategoria['id_sub_categoria'])?>">
                                <figure class="acao">
                                        <img src="../imagens/edit.png" title="Editar Dados" alt="ViewData" class="linkModal"
                                                >
                                  </figure>
                                  </a>
                                   <a href="adm.produto.php?modo=excluir&tab=subcat&id=<?php echo($rsSubCategoria['id_sub_categoria'])?>">
                                      <figure class="acao">
                                            <img src="../imagens/delete.png" title="Excluir Registro" alt="excluir">
                                       </figure>
                                    </a>
                        </div>
                        <div class="coluna  smallCol" >
                            <figure>
                                <img src="<?php echo($rsSubCategoria['ativacao'] == 0) ? '../imagens/desativo.png' : '../imagens/active.png' ?>" title=" ativar/desativar" alt="excluir" class="imgAtivo" >
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