<form name="frmLojas" class="frmConteudo" action="adm.conteudo.php" method="POST" enctype="multipart/form-data">  
                            <h2>Cadastro Lojas</h2>
                            <div class="divisorModal alignLeft">
                                Imagem:  <input type="file" name="fleFoto" id="foto" accept="image/*" 
                                onchange="readURL(this, '#imgLoja')"> <br>
                                <div class="contImg">
                                    <img src= "<?php echo(
                                    @$rsLojaUp['imgLoja'])?>"
                                     class="img" id="imgLoja" alt="selecione..." title="Imagem escolhida">
                                </div>
                              Ativação:<br>
                                <label class="switch"> 
                                            <input type="checkbox" class="sliderBox" name="checkAtivacao"
                                                <?php echo(@$rsLojaUp['isAtivado'] == 1) ? 'checked':''?>>
                                <span class="slider round"></span> </label>
                                
                            </div>
                            <div class="divisorModal">
                                Descrição: <textarea class="txtareaConteudo areaMenor" name="txtDesc"> <?php echo(
                                    @$rsLojaUp['descricao'])?></textarea>
                                
                                E-mail:<br> <input type="text" name="txtEmailLoja" class=" txtDados spaceBetween" value="<?php echo(@$rsLojaUp['email'])?>">
                                <input type="submit" value="<?php echo($valueBtn)?>" name="btnSalvarSobre" class="btnAdd fontsize">
                            </div>
                           
                        </form>
                        <div class="containerColunas centerManual">
                        
                            <div class="coluna tituloColunas  colMaior" >
                            Imagem
                            </div>
                            <div class="coluna tituloColunas colMaiorText">
                            E-mail
                            </div>
                            <div class="coluna tituloColunas smallCol" >
                            Ações
                            </div>
                            <div class="coluna tituloColunas smallCol" >
                            Ativação
                            </div>
                        </div>
                    
                        <?php 
                           while($rsLoja=mysqli_fetch_array($selectLoja)) {
                        ?>
                                <div class="containerColunas centerManual colunaComFoto">
                                   <div class="coluna  colMaior" >
                                       <figure>
                                            <img src="<?php echo($rsLoja['imgLoja'])?>" alt="Imagem Sobre" class="imgRegistro"
                                            title="Imagem de Fundo">
                                       </figure>
                                       
                                    </div>
                                    <div class="coluna  colMaiorText">
                                        <?php echo($rsLoja['email'])?>
                                    </div>
                                    <div class="coluna  smallCol" >
                                        <a href="adm.conteudo.php?modo=editarloja&id=<?php echo($rsLoja['idLoja'])?>">
                                            <figure class="acao">
                                                <img src="../imagens/edit.png" title="Editar Dados" alt="ViewData" class="linkModal"
                                                >
                                            </figure>
                                        </a>
                                        <a href="adm.conteudo.php?modo=excluirloja&id=<?php echo($rsLoja['idLoja'])?>">
                                            <figure class="acao">
                                                <img src="../imagens/delete.png" title="Excluir Registro" alt="excluir">
                                            </figure>
                                        </a>
                                    </div>
                                    <div class="coluna  smallCol" >
                                        <figure>
                                            <img src="<?php echo($rsLoja['isAtivado'] == 0) ? '../imagens/desativo.png' : '../imagens/active.png' ?>" 
                                            title="ativar/desativar" alt="excluir" class="imgAtivo" >
                                        </figure>
                                    
                                    </div>
                                </div>  
                       
                         
                        <?php 
                            }
                        ?>