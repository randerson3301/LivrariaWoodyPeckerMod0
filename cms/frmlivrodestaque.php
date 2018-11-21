                <div class="contDica"> 
                            <h2>Selecione o produto para destaca-lo </h2>
                        </div>
                     
                        <div class="containerColunas centerManualPlus">
                        
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
                        </div>
                          
                         
                    
                        <?php 
                           while($rsLivro=mysqli_fetch_array($selectLivro)) {
                        ?>
                                <div class="containerColunas centerManualPlus colunaComFoto">
                                   <div class="coluna " >
                                       <figure>
                                            <img src="<?php echo($rsLivro['imgLivro'])?>" alt="Imagem Sobre" class="imgLivro"
                                            title="Imagem de Fundo">
                                       </figure>
                                       
                                    </div>
                                    <div class="coluna  colMaior">
                                        <?php echo($rsLivro['titulo'])?>
                                    </div>
                                    <div class="coluna  smallColPlus" >
                                         <?php echo($rsLivro['isbn'])?>
                                    </div>
                                    <div class="coluna  smallCol " >
                                      
                                        <a href="adm.conteudo.php?ativado=<?php echo($rsLivro['livroEmDestaque'])?>&isbn=<?php echo($rsLivro['isbn'])?>&pag=2"> 
                                               <?php
                                               ?>
                                            <figure>
                                                    <img src="<?php echo($rsLivro['livroEmDestaque'] == 0) ? '../imagens/desativo.png' : '../imagens/active.png' ?>" 

                                                    title="Clique para ativar/desativar" alt="excluir" class="imgAtivo" >
                                            </figure>
                                        </a>
                                        
                                     </div>
                                </div>  
                       
                         
                        <?php 
                            }
                        ?>