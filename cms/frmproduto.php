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