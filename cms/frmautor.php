
<form name="frmAutores" action="adm.conteudo.php" 
                      method="POST" enctype="multipart/form-data" class="formMaior frmConteudo "> 
                        <div class="divisorModal alignLeft">
                            Imagem:  <input type="file" name="fleFoto" id="foto" accept="image/*" 
                            onchange="readURL(this, '#imgAutor')"> <br>
                            <div class="contImg contImgAutor">
                                <img src= "<?php echo($rsAutorUp['imgAutor'])?>"
                                 class="img" id="imgAutor" alt="selecione..." title="Imagem escolhida">
                                 
                            </div>
                            Nome: <br><input name="txtNome"  id="txtNome" type="text" class=" txtDados" 
                            value="<?php echo(@$rsAutorUp['nome'])?>" onkeypress="return validar(event, 'num', this.id);" required><br>
                            Local de Nascimento:  <br> <input name="txtLocalNasc" id="txtLocalNasc" type="text" 
                            class="txtDados "  value="<?php echo(@$rsAutorUp['cidadeNascimento'])?>" onkeypress="return validar(event, 'num', this.id);" required><br>
                            Data de Nascimento:  <br> <input name="txtDtNasc"  id="txtDtNasc" type="text" placeholder="dd/MM/yyyy"
                            class="txtMenor" value="<?php echo(@$rsAutorUp['dtNascimento'])?>" onkeypress="return validar(event, 'txt', this.id);" required><br>
                            Data de Falecimento: * <br> <input name="txtDtFal" type="text" id="txtDtFal" placeholder="dd/MM/yyyy"
                            class="txtMenor" value="<?php echo(@$rsAutorUp['dtFalecimento'])?>" onkeypress="return validar(event, 'txt', this.id);"><br>

                        </div>
                        <div class="divisorModal alignLeft">
                            Mini-Biografia:<textarea class="txtareaConteudo" name="txtDesc" required
                         ><?php echo(@$rsAutorUp['breveBiografia'])?></textarea>
                            Ativação:<br>
                            <label class="switch"> 
                                <input type="checkbox" class="sliderBox" name="checkAtivacao"
                                            <?php echo(@$rsAutorUp['isAtivado'] == 1) ? 'checked':''?>>
                                <span class="slider round"></span>
                             </label> <br>
                            
                             <input type="submit" value="<?php echo($valueBtn)?>" name="btnSalvarSobre" class="btnAdd fontsize">

                        </div>
                    </form>
                    <!-- Saída do banco -->
                    <div class="center">
                    <div class="containerColunas centerManual"> 
                        <div class="coluna tituloColunas  smallColImg" >
                                Imagem
                        </div>
                        <div class="coluna tituloColunas ">
                                Nome
                         </div>
                        <div class="coluna tituloColunas colMaiorText">
                                Mini-Biografia
                         </div>
                         <div class="coluna tituloColunas ">
                               Origem
                         </div>
                         <div class="coluna tituloColunas smallCol" >
                                Ações
                        </div>
                            
                        <div class="coluna tituloColunas smallCol" >
                                Ativação
                        </div>
                    </div>
                    <?php 
                        while($rsAutor=mysqli_fetch_array($selectAutor)) {
                    ?>
                    <!-- Registros retornados-->
                    <div class="containerColunas colunaComFoto centerManual"> 
                        <div class="coluna   smallColImg" >
                       
                            <img src="<?php echo($rsAutor['imgAutor'])?>" 
                            alt="imgAutor" title="Imagem" class='img'>
                        </div>
                        <div class="coluna  ">
                            <?php echo($rsAutor['nome'])?>
                         </div>
                        <div class="coluna  colMaiorText">
                            <?php echo($rsAutor['breveBiografia'])?>
                         </div>
                         <div class="coluna  ">
                            <?php echo($rsAutor['cidadeNascimento'])?>
                         </div>
                         <div class="coluna  smallCol" >
                         <a href="adm.conteudo.php?modo=editarautor&id=<?php echo($rsAutor['idAutor'])?>#autor">
                            <figure class="acao">
                                <img src="../imagens/edit.png" title="Editar Dados" alt="ViewData" class="linkModal"
                                              >
                            </figure>
                        </a>
                         <a href="adm.conteudo.php?modo=excluir&tab=autor&id=<?php echo($rsAutor['idAutor'])?>">
                                <figure class="acao">
                                       <img src="../imagens/delete.png" title="Excluir Registro" alt="excluir">
                                </figure>
                         </a>
                        </div>
                            
                        <div class="coluna  smallCol" >
                        <figure>
                             <img src="<?php echo($rsAutor['isAtivado'] == 0) ? '../imagens/desativo.png' : '../imagens/active.png' ?>" 
                                     title="ativar/desativar" alt="excluir" class="imgAtivo" >
                           </figure>
                        </div>
                    </div>
                        <?php } ?>
                    </div>
