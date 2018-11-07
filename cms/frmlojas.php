<form name="frmLojas" class="frmConteudo formMaior" action="adm.conteudo.php" method="POST" enctype="multipart/form-data">  
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
                                <span class="slider round"></span> </label> <br>
                                Logradouro:<br> <input type="text" name="txtLogradouro" id="txtLogradouro" class=" txtDados spaceBetween" value="<?php echo(@$rsLojaUp['logradouro'])?>" required><br>
                                Bairro:<br> <input type="text" name="txtBairro"   id="txtBairro" class=" txtDados spaceBetween" value="<?php echo(@$rsLojaUp['bairro'])?>"  onkeypress="return validar(event, 'num', this.id);" required><br>
                                Cidade:<br> <input type="text" name="txtCidade" id="txtCidade" class=" txtDados spaceBetween" value="<?php echo(@$rsLojaUp['cidade'])?>"  onkeypress="return validar(event, 'num', this.id);" required><br>

                                
                            </div>
                            <div class="divisorModal">
                                    Estado:<br> 
                                 <select name="cbEstado"
									class="txtDados">
									<option value="AC">Acre</option>
									<option value="AL">Alagoas</option>
									<option value="AM">Amazonas</option>

									<option value="BA">Bahia</option>
									<option value="CE">Ceará</option>
									<option value="DF">Distrito Federal</option>
									<option value="ES">Espírito Santo</option>
									<option value="GO">Goiás</option>
									<option value="MA">Maranhão</option>
									<option value="MT">Mato Grosso</option>
									<option value="MS">Mato Grosso do Sul</option>
									<option value="MG">Minas Gerais</option>
									<option value="PA">Pará</option>
									<option value="PB">Paraíba</option>
									<option value="PR">Paraná</option>

									<option value="PE">Pernambuco</option>
									<option value="PI">Piauí</option>
									<option value="RJ">Rio de Janeiro</option>
									<option value="RN">Rio Grande do Norte</option>
									<option value="RS">Rio Grande do Sul</option>
									<option value="RO">Rondônia</option>
									<option value="RR">Roraima</option>
									<option value="SC">Santa Catarina</option>
									<option value="SP">São Paulo</option>
									<option value="SE">Sergipe</option>
									<option value="TO">Tocantins</option>
								</select>
                                    <br>
                               CEP:<br> <input pattern="[0-9]{8}" type="text" maxlength="8" name="txtCep" id="txtCep" class=" txtDados spaceBetween" value="<?php echo(@$rsLojaUp['cep'])?>"  onkeypress="return validar(event, 'txt', this.id);" required>
                               Telefone:<br> <input pattern="[0-9]{4}[0-9]{4}" type="text" placeholder="########" maxlength="15" name="txtTelefone" id="txtTelefone" class=" txtDados spaceBetween" value="<?php echo(@$rsLojaUp['telefone'])?>"  onkeypress="return validar(event, 'txt', this.id);" required><br>
                                
                               E-mail:<br> <input type="email" name="txtEmailLoja" class=" txtDados spaceBetween" value="<?php echo(@$rsLojaUp['email'])?>" required>

                                Descrição: <textarea  onkeypress="return validar(event, 'num', this.id);" class="txtareaConteudo areaMenor" name="txtDesc"  id="txtDesc" required> <?php echo(
                                    @$rsLojaUp['descricao'])?></textarea>
                                
                                <input type="submit" value="<?php echo($valueBtn)?>" name="btnSalvarSobre" class="btnAdd fontsize">
                            </div>
                           
                        </form>
                        <div class="containerColunasAlt centerManual">
                        
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
                                <div class="containerColunasAlt centerManual colunaComFoto">
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
                                        <a href="adm.conteudo.php?modo=editarloja&id=<?php echo($rsLoja['idLoja'])?>&idend=<?php echo($rsLoja['idEndereco'])?>">
                                            <figure class="acao">
                                                <img src="../imagens/edit.png" title="Editar Dados" alt="ViewData" class="linkModal"
                                                >
                                            </figure>
                                        </a>
                                        <a href="adm.conteudo.php?modo=excluir&tab=loja&id=<?php echo($rsLoja['idLoja'])?>">
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