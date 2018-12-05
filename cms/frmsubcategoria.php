<form action="adm.produto.php?tab=subcat" method="POST" name="frmCategoria" class="frmConteudo frmMenor"> 
                  <h2>Gerenciador de  Sub-categorias </h2><br>
                           
                      Digite uma Sub-Categoria <br>
                       <input type="text" name="txtSubCat"  id="txtSubCat" onkeypress="return validar(event, 'num', this.id);" 
                       class="txtDados "
                         value="<?php echo(utf8_encode(@$rsSubCatUp['sub_categoria']))?>"><br>
                       
                         <span class="spaceBeetween">Selecione uma categoria: </span><br>
                         <select class="txtDados spaceBetween sltmenor" name="sltCategorias">
                                        <option value="<?php echo($valueOption)?>"> 
                                            <?php echo(utf8_encode($itemOption))?>
                                        </option>
                                       
                                       <?php 
                                        $sqlCat = selecionar('tbl_categoria', 'id_categoria',  'id_categoria <>'. $valueOption);
                                       
                                        $selectCategoria = mysqli_query($conexao, $sqlCat);
                                       
                                       while( $rscateg=mysqli_fetch_array($selectCategoria)) { ?>
                                            <option id="option" value="<?php echo($rscateg['id_categoria'])?> "> 
                                                 <?php echo(utf8_encode($rscateg['categoria'])) ?>
                                            </option>
                                       <?php } ?>
                                    </select><br>
                          Ativação: <br> 
                          <label class="switch">
                            <input type="checkbox"  <?php echo(@$rsSubCatUp['ativacao'] == 1) ? 'checked' : ''?> name="checkAtivacao" 
                                       > 
                             <span class="slider round"></span>
                            </label> <br>
                           <input type="submit" name="btnSalvarSobre" value="<?php echo($valueBtn)?>" class="spaceBeetween btnEnviar">
                           <input type="reset" name="btnSalvarSobre" value="Limpar" class="spaceBeetween btnEnviar btnReset">

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
                        <div class="coluna  colMaior">
                             <?php echo(utf8_encode($rsSubCategoria["categoria"])) ?>
                        </div>
                        <div class="coluna  smallCol" >
                        <a href="adm.produto.php?tab=subcat&modo=editarsub&id=<?php echo($rsSubCategoria['id_sub_categoria'])?>">
                                <figure class="acao">
                                        <img src="../imagens/edit.png" title="Editar Dados" alt="ViewData" class="linkModal"
                                                >
                                  </figure>
                                  </a>
                                   <a id="delete"  href="adm.produto.php?modo=excluir&tab=subcat&id=<?php echo($rsSubCategoria['id_sub_categoria'])?>">
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