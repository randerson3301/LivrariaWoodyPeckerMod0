<form action="adm.conteudo.php" name="frmPromo" class="frmConteudo frmMenor"> 
                            <h2>Gerenciador de  Promoções </h2><br>
                           
                                   <span class='spaceBeetween'> Selecione um produto </span> <br>
                                   <select class="txtDados spaceBetween sltmenor" name="sltProdutos">
                                        <option value="<?php echo(@$valorOption)?>"> 
                                               <?php echo(@$rsPromoUp != null) ? @$rsPromoUp['isbn'] : 
                                                'Selecione um item...';  
                                              ?>
                                        </option>
                                       
                                       <?php 
                                       $sqlLivros = selecionar('tbl_livro', 'isbn', 'isbn <> '. $valorOption);
                                        $selectLivrosPromo = mysqli_query($conexao, $sqlLivro);
                                       
                                       while( $rslivros=mysqli_fetch_array($selectLivrosPromo)) { ?>
                                            <option id="option" value="<?php echo($rslivros['isbn'])?> "> 
                                                <?php echo($rslivros['titulo']) ?> - <?php echo($rslivros['isbn']) ?>
                                            </option>
                                       <?php } ?>
                                    </select><br>
                                    
                                    Desconto em % <br>
                                    <input type="text" name="txtPercent"  id="txtPercent" onkeypress="return validar(event, 'txt', this.id);" class="txtDados"
                                    value="<?php echo(@$rsPromoUp['percentualDesconto'])?>"><br>
                                    Ativação: <br> 
                                    <label class="switch">
                                        <input type="checkbox"  <?php echo(@$rsPromoUp['isAtivado'] == 1) ? 'checked' : ''?> name="checkAtivacao" 
                                       > 
                                        <span class="slider round"></span>
                                    </label> <br>
                                    <input type="submit" name="btnSalvarSobre" value="<?php echo($valueBtn)?>" class="spaceBeetween btnEnviar">
                             
                        </form>

                        <!-- Registros retornados -->
                        <div class="containerColunas"> 
                                <div class="coluna tituloColunas centerManual smallColImg" >
                                        Imagem
                                </div>
                                <div class="coluna tituloColunas smallColPlus">
                                        ISBN
                                 </div>
                                <div class="coluna tituloColunas smallColPlus">
                                        (%)Desconto
                                 </div>
                                 <div class="coluna tituloColunas smallColPlus">
                                        Valor Final(R$)
                                 </div>
                                 <div class="coluna tituloColunas smallCol" >
                                        Ações
                                </div>
                                    
                                <div class="coluna tituloColunas smallCol" >
                                        Ativação
                                </div>
                        </div>
                        <!-- Registros do bANCO -->
                       <!-- Registros retornados -->
                       <?php
                            while($rsPromos = mysqli_fetch_array($selectPromo)) {
                       ?>
                       <div class="containerColunas  centerManual colunaComFoto"> 
                                <div class="coluna   smallColImg" >
                                       <img src="<?php echo($rsPromos['imgLivro'])?>" 
                                       alt="imgLivro" title="Imagem" class='img'>
                                </div>
                                <div class="coluna  smallColPlus">
                                        <?php echo($rsPromos['isbn'])?>
                                 </div>
                                <div class="coluna  smallColPlus">
                                        <?php echo($rsPromos['percentualDesconto'])?>
                                 </div>
                                 <div class="coluna  smallColPlus">
                                        <?php echo($rsPromos['tl.preco - (tl.preco *  (tp.percentualDesconto/ 100))'])?>
                                 </div>
                                 <div class="coluna  smallCol" >
                                 <a href="adm.conteudo.php?modo=editarpromo&id=<?php echo($rsPromos['id'])?>&isbn=<?php echo($rsPromos['isbn'])?>">
                                            <figure class="acao">
                                                <img src="../imagens/edit.png" title="Editar Dados" alt="ViewData" class="linkModal"
                                              >
                                            </figure>
                                        </a>
                                        <a href="adm.conteudo.php?modo=excluir&tab=promo&id=<?php echo($rsPromos['id'])?>">
                                            <figure class="acao">
                                                <img src="../imagens/delete.png" title="Excluir Registro" alt="excluir">
                                            </figure>
                                        </a>
                                </div>
                                    
                                <div class="coluna  smallCol" >
                                <figure>
                                        <img src="<?php echo($rsPromos['isAtivado'] == 0) ? '../imagens/desativo.png' : '../imagens/active.png' ?>" 
                                            title="ativar/desativar" alt="excluir" class="imgAtivo" >
                                        </figure>
                                </div>
                        </div>
                <?php
                         }
                ?>
                            