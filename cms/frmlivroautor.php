                    Autor: &nbsp;  &nbsp; 
                    <select class="txtDados spaceBetween sltmenor"  name="sltAutores[]"  id="sltAutores"> 
                        <option value="<?php echo($valueOption)?>"> 
                        <?php echo(utf8_encode($itemOption))?>
                           </option>                                                                            
                        <?php
                            $sqlautor = selecionar('tbl_autor', 'idAutor',  'idAutor <>'. $valueOption);
                              
                              
                             // echo($sqlCat);
                            $sltautor = mysqli_query($conexao, $sqlautor);
                                       
                            while($rsautor=mysqli_fetch_array($sltautor)) { 
                                 
                                       ?>
                                <option id="option" value="<?php echo($rsautor['idAutor'])?>" 
                                <?php echo(@$checked)?>> 
                                    <?php echo(utf8_encode($rsautor['nome'])) ?>
                              </option>
                        <?php } ?></select>
                        <br>