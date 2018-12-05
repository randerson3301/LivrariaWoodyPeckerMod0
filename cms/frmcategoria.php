
           <form action="adm.produto.php?tab=cat" method="POST" name="frmCategoria" class="frmConteudo frmMenor"> 
                  <h2>Gerenciador de  Categorias </h2><br>
                           
                      Digite uma Categoria <br>
                       <input type="text" name="txtCategoria"  id="txtCategoria" onkeypress="return validar(event, 'num', this.id);" 
                       class="txtDados first_letter_up"
                         value="<?php echo(utf8_encode(@$rsCategoriaUp['categoria']))?>"><br>
                          Ativação: <br> 
                          <label class="switch">
                            <input type="checkbox"  <?php echo(@$rsCategoriaUp['ativacao'] == 1) ? 'checked' : ''?> name="checkAtivacao" 
                                       > 
                             <span class="slider round"></span>
                            </label> <br>
                           <input type="submit" name="btnSalvarSobre" value="<?php echo($valueBtn)?>" class="spaceBeetween btnEnviar">
                           <input type="reset" name="btnSalvarSobre" value="Limpar" class="  spaceBeetween btnReset btnEnviar">
                             
            </form>

            <div  class="containerColunas centerManual">
                        <div class="containerColunasAlt">
                            <div class="coluna tituloColunas espacador colMaior">
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
                $sqlcategorias = selecionar('tbl_categoria', 'id_categoria');
                $selectcat = mysqli_query($conexao, $sqlcategorias);

                //config no resultset do banco
                while($rsCategoria = mysqli_fetch_array($selectcat)) { 
                     // echo(utf8_encode($rsCategoria["categoria"])."<br>");
                    ?>
                     <div class="containerColunasAlt centerManual">
                        <div class="coluna  espacador colMaior">
                            <?php echo(utf8_encode($rsCategoria["categoria"])) ?>
                        </div>
                        <div class="coluna  smallCol" >
                        <a href="adm.produto.php?tab=cat&modo=editar&id=<?php echo($rsCategoria['id_categoria'])?>">
                                <figure class="acao">
                                        <img src="../imagens/edit.png" title="Editar Dados" alt="ViewData" class="linkModal"
                                                >
                                  </figure>
                                  </a>
                                   <a href="adm.produto.php?modo=excluir&tab=cat&id=<?php echo($rsCategoria['id_categoria'])?>">
                                      <figure class="acao">
                                            <img src="../imagens/delete.png" title="Excluir Registro" alt="excluir">
                                       </figure>
                                    </a>
                        </div>
                        <div class="coluna  smallCol" >
                            <figure>
                                <img src="<?php echo($rsCategoria['ativacao'] == 0) ? '../imagens/desativo.png' : '../imagens/active.png' ?>" title=" ativar/desativar" alt="excluir" class="imgAtivo" >
                             </figure>
                                    
                        </div>
                     </div>
                
                <?php
                    }
                ?>