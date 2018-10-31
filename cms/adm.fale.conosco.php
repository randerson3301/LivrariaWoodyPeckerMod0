<?php
    require_once('conexao.php');
    require_once('function.php');
    
    $conexao = conexaoBD();

    
    if(isset($_GET['modo'])) {
        $modo = $_GET['modo'];
        $codigo = $_GET['id'];
       
        
        if($modo == 'excluir') {
             $sql="delete from tbl_fale_conosco where id =".$codigo;
            
             mysqli_query($conexao, $sql);
             header('location:adm.fale.conosco.php');
        } 
    }
?>


        <?php 
            require_once('head.html');
        ?>
        <!-- ESSAS SÃO AS DIVS DA MODAL-->
        <div id="containerModal">
            <div id="viewDados"></div>
        </div>
        <?php
            require_once('header.php');
            require_once('containerCMS.php');
        ?>
         <!-- FIM DAS DIVS DA MODAL-->
        
                    <div class="containerColunas">
                        <div class="coluna tituloColunas primeiraColuna">
                            Nome
                        </div>
                         <div class="coluna colEmail tituloColunas" >
                            E-mail
                        </div>
                         <div class="coluna tituloColunas" >
                            Profissão
                        </div>
                         <div class="coluna tituloColunas" >
                            Celular
                        </div>
                        <div class="coluna tituloColunas smallCol" >
                            Ações
                        </div>
                        
                    </div>
                    
                    <!-- esses elementos farão parte do looping 
                        Aqui aparecerão as consultas 
                    -->
                    <?php
                       
                        //enviando para o banco
                        $sql = selecionar('tbl_fale_conosco', 'id');
                        $select = mysqli_query($conexao, $sql);
                        $index = 0;
                    
                   //convertendo os registros em vetores
                    while($rsContatos=mysqli_fetch_array($select)) {
                        $index++;
                    ?>
                    <div class="containerColunas espacadorReg">
                        <div class="indexRegistro smallCol ">
                            <?php echo($index)?>
                        </div>
                        <div class="coluna">
                            <?php echo($rsContatos['nomeContato'])?>
                        </div>
                         <div class="coluna colEmail">
                             <?php echo($rsContatos['emailContato'])?>
                        </div>
                        <div class="coluna">
                             <?php echo($rsContatos['profissao'])?>
                        </div>
                        <div class="coluna">
                             <?php echo($rsContatos['celular'])?>
                        </div>
                         <div class="colAcao smallCol" >
                             <!-- LINK MODAL-->
                             <a class="viewModal" href="#" onclick="modal(<?php echo($rsContatos['id'])?>, 
                             'modal.faleconosc.php', '#viewDados')">
                                <figure class="acao">
                                    <img src="../imagens/view.png" title="Visualizar Dados" alt="ViewData">
                                </figure>
                                </a>
                             <a href="adm.fale.conosco.php?modo=excluir&id=<?php echo($rsContatos['id'])?>">
                                 <figure class="acao">
                                    <img src="../imagens/delete.png" title="Excluir Registro" alt="excluir">
                                </figure>
                             </a>
                        </div>
                    </div>
                    <?php 
                        } 
                    ?>
                
            
    <?php 
        require_once('footer.php');
    ?>