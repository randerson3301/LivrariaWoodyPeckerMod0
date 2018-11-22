
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Home</title>
        <link href="css/reset.css" rel="stylesheet" type="text/css"> 
        <link href="css/style.css" rel="stylesheet" type="text/css">
        
       
    </head>
    
    <body>
        <?php 
            require_once('header.site.php');
        ?>
        <!-- FIM DO Cabeçalho-->
        
        <!-- Conteúdo da page-->
            <div id="containerGeral">
               
                    <div class="divisorLateral"> 
                    <div class="containerLinks">
                        <a href="https://www.facebook.com/" target="_blank">
                            <div class="iconRedeSocial" id="faceIcon"></div>
                        </a>
                        <a href="https://twitter.com/" target="_blank">
                            <div class="iconRedeSocial" id="twitterIcon"></div>
                        </a>
                        <a href="https://instagram.com/" target="_blank">
                            <div class="iconRedeSocial" id="instaIcon"></div>
                         </a>   
                    </div>
                </div>
                   
                    <!--      SLIDER            -->
                    <div class="slider" id="slider">
                        <div class="divisor">
                            <button class="btnSlider" onclick="mudarImg(prevImg())" id="setaEsquerda"></button>
                            
                            <div id="indexslider">
                               
                            </div>
                        </div>
                        <div class="painelCentral"></div>
                        <div class="divisor">
                            <button      class="btnSlider" onclick="mudarImg(proxImg())" id="setaDireita"></button>
                        </div>
                    </div> 
                    <div id="containerContent">
                        <div id="painelRolagem">
                            <nav > 
                                <ul>
                                    <li class="itemRolagem "> Categoria 
                                       
                                    </li>
                                </ul>
                            </nav>
                           
                        </div>
                        
                        <section class="containerLivraria" id="maisNovos">
                                <nav class="navdd"> 
                                    <ul >
                                        <li class="itemRolagem" hidden> Item 1 </li>
                                        <li class="itemRolagem" hidden> Item 2 </li>
                                    </ul>
                                </nav>
                            <div class="containerLivro">
                                <!-- Container da foto -->
                                <div class="containerLivroFoto">
                                    <figure>
                                         <img class="imgLivro" alt="Livro"
                                         src = "imagens/imgLivro1.jpg" title = "A Queda de Gondolin "> 
                                    </figure>
                                </div>
                                <!-- Dados do livro-->
                                <div class="containerLivroDados">
                                     <!-- titulo-->
                                    <div class="tituloLivro">
                                        <h2><span class="textTitulo">Título:</span>&nbsp;The Fall Of Gondolin</h2>
                                    </div>
                                    <!-- descrição do livro -->
                                    <div class="descLivro">
                                       <span class="textTitulo">Descrição:</span>&nbsp; No conto da queda de Gondolin são duas das maiores potências do mundo.
                                    </div>
                                    <!-- preço -->
                                    <div class="preco">
                                        <span class="textTitulo">Preço:</span> R$&nbsp;39,90
                                    </div>
                                    <!-- detalhes -->
                                    <div class="containerDetalhes">
                                        <div class = "divisorDetalhes"></div>
                                        <div class="detalhes">
                                           +Detalhes
                                        </div>
                                    </div>
                                   
                                </div>
                            </div> 
                            <!-- Livro 2-->
                            <div class="containerLivro">
                                <!-- Container da foto -->
                                <div class="containerLivroFoto">
                                    <figure>
                                         <img class="imgLivro" alt="Livro"
                                         src = "imagens/imgLivro2.jpg" title = "Do átomo ao buraco negro "> 
                                    </figure>
                                </div>
                                <!-- Dados do livro-->
                                <div class="containerLivroDados">
                                    <!-- titulo-->
                                    <div class="tituloLivro">
                                        <h2> <span class="textTitulo">Título:</span> Do Átomo ao Buraco Negro</h2>
                                    </div>
                                    <!-- descrição do livro -->
                                    <div class="descLivro">
                                       <span class="textTitulo">Descrição:</span> Criador do Poligonautas, canal de ciência no YouTube, com mais de 700 mil seguidores.
                                    </div>
                                    <!-- preço -->
                                    <div class="preco">
                                       <span class="textTitulo">Preço:</span> R$;39,90
                                    </div>
                                    <!-- detalhes -->
                                    <div class="containerDetalhes">
                                        <div class = "divisorDetalhes"></div>
                                        <div class="detalhes">
                                           +Detalhes
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            <div class="containerLivro">
                                <!-- Container da foto -->
                                <div class="containerLivroFoto">
                                    <figure>
                                         <img class="imgLivro" alt="Livro"
                                         src = "imagens/imgLivro3.jpg" title = "1984 "> 
                                    </figure>
                                </div>
                                <!-- Dados do livro-->
                                <div class="containerLivroDados">
                                    <!-- titulo-->
                                    <div class="tituloLivro">
                                        <h2><span class="textTitulo">Título:</span> 1984</h2>
                                    </div>
                                    <!-- descrição do livro -->
                                    <div class="descLivro">
                                        <span class="textTitulo">Descrição:</span> O livro é considerado um clássico moderno. Ele questiona, de diversas formas e em vários momentos, os excessos delirantes do poder. 
                                    </div>
                                    <!-- preço -->
                                    <div class="preco">
                                        <span class="textTitulo">Preço:</span> R$&nbsp;39,90
                                    </div>
                                    <!-- detalhes -->
                                    <div class="containerDetalhes">
                                        <div class = "divisorDetalhes"></div>
                                        <div class="detalhes">
                                           +Detalhes
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </section>
                        <section class="containerLivraria" id="maisVisualizados">
                            <div class="containerLivro">
                                <!-- Container da foto -->
                                <div class="containerLivroFoto">
                                    <figure>
                                         <img class="imgLivro" alt="Livro"
                                         src = "imagens/imgLivro4.jpg" title = "O Alquimista "> 
                                    </figure>
                                </div>
                                <!-- Dados do livro-->
                                <div class="containerLivroDados">
                                    <!-- titulo-->
                                    <div class="tituloLivro">
                                        <h2><span class="textTitulo">Título:</span> O Alquimista</h2>
                                    </div>
                                    <!-- descrição do livro -->
                                    <div class="descLivro">
                                       <span class="textTitulo">Descrição:</span> Paulo Coelho já inspirou mais de 200 milhões de leitores por todo o mundo com este romance encantador. 
                                        Esta história, brilhante em sua simplicidade e com uma sabedoria que nos estimula.
                                    </div>
                                    <!-- preço -->
                                    <div class="preco">
                                        <span class="textTitulo">Preço:</span> R$&nbsp;39,90
                                    </div>
                                    <!-- detalhes -->
                                    <div class="containerDetalhes">
                                        <div class = "divisorDetalhes"></div>
                                        <div class="detalhes">
                                           +Detalhes
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            <div class="containerLivro">
                                <!-- Container da foto -->
                                <div class="containerLivroFoto">
                                    <figure>
                                         <img class="imgLivro" alt="Livro"
                                         src = "imagens/imgLivro5.jpg" title = "Laranja Mecânica "> 
                                    </figure>
                                </div>
                                <!-- Dados do livro-->
                                <div class="containerLivroDados">
                                    <!-- titulo-->
                                    <div class="tituloLivro">
                                        <h2> <span class="textTitulo">Título:</span> Laranja Mecânica</h2>
                                    </div>
                                    <!-- descrição do livro -->
                                    <div class="descLivro">
                                         <span class="textTitulo">Descrição:</span> Narrada pelo protagonista, o adolescente Alex,<br> esta brilhante e perturbadora história cria uma sociedade futurista em que <br>a violência atinge proporções gigantescas.
                                    </div>
                                    <!-- preço -->
                                    <div class="preco">
                                        <span class="textTitulo">Preço:</span> R$&nbsp;39,90
                                    </div>
                                    <!-- detalhes -->
                                    <div class="containerDetalhes">
                                        <div class = "divisorDetalhes"></div>
                                        <div class="detalhes">
                                           +Detalhes
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            <div class="containerLivro">
                                <!-- Container da foto -->
                                <div class="containerLivroFoto">
                                    <figure>
                                         <img class="imgLivro" alt="Livro"
                                         src = "imagens/imgLivro6.png" title = "O Alienista "> 
                                    </figure>
                                </div>
                                <!-- Dados do livro-->
                                <div class="containerLivroDados">
                                    <!-- titulo-->
                                    <div class="tituloLivro">
                                        <h2><span class="textTitulo">Título:</span> O Alienista</h2>
                                    </div>
                                    <!-- descrição do livro -->
                                    <div class="descLivro">
                                       <span class="textTitulo">Descrição:</span>  Escrito dos mais aclamados, Machados de Assis representa um dos pontos culminantes da literatura brasileira. Dentro de sua obra, O alienista é central.

                                    </div>
                                    <!-- preço -->
                                    <div class="preco">
                                        <span class="textTitulo">Preço:</span> R$&nbsp;39,90
                                    </div>
                                    <!-- detalhes -->
                                    <div class="containerDetalhes">
                                        <div class = "divisorDetalhes"></div>
                                        <div class="detalhes">
                                           +Detalhes
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </section>
                     </div>
                     <!-- FIM CONTEÚDO -->
                     <!-- INICIO RODAPÉ -->
                    <footer></footer>
                <!-- FIM RODAPÉ -->
            </div>
         <!-- usando a biblioteca jquery-->
        <script src="js/jquery.js"></script>
        <script src="js/script.js"></script>
     </body>
</html>