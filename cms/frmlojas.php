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
                                    <span class="slider round"></span> </label>
                                
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
                            <div class="coluna tituloColunas smallCol" >
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
                                            <img src="<?php echo($rsSobre['imgSobre'])?>" alt="Imagem Sobre" class="imgRegistro"
                                            title="Imagem de Fundo">
                                       </figure>
                                       
                                    </div>
                                    <div class="coluna  colMaiorText">
                                        <?php echo($rsSobre['descricao'])?>
                                    </div>
                                    <div class="coluna  smallCol" >
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