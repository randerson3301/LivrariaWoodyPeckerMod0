
    <?php 
        if($_SESSION['username'] == '') {
            header("location:../index.php");
        }
    ?>
            <div id="containerCMS">
            <header id="headerCMS">
                <div id="containerHeaderCMS">
                  <h1 id="tituloCMS">
                      <span >
                          CMS - Sistema de Gerenciamento Do Site
                      </span>
                  </h1> 
                  
                  <figure id="logoCMS">
                      <img src="../imagens/logocms.png" alt="LOGO" title="Woody Woodpecker" id= "logocms">
                      <figcaption>WOODY WOODPECKER S/A</figcaption>
                  </figure>
              </div>
               
              <nav id="menuCMS">
                  <div id="containerMenuCMS">
                  <ul id="menu-header">
                      <li class="itemcms">
                           <a href="adm.conteudo.php" class = "linkmenu">
                          <figure>
                              <img src="../imagens/conadmin.png" class="imgItens">
                              <figcaption >Adm. Conteúdo</figcaption>
                          </figure>
                          </a>
                      </li>
                       <li class="itemcms">
                           <a href="adm.fale.conosco.php" class = "linkmenu">
                              <figure>
                                  <img src="../imagens/faleadmin.png" class="imgItens">
                                  <figcaption >Adm. Fale Conosco</figcaption>
                              </figure>
                          </a>
                       </li>
                       <li class="itemcms">
                       <a href="adm.produto.php" class = "linkmenu">
                          <figure>
                            <img src="../imagens/prodadmin.png" class="imgItens">
                              <figcaption >Adm. Produtos</figcaption>
                          </figure>
                      </a>
                       </li>
                      <li class="itemcms">
                           <a href="adm.usuarios.php" class = "linkmenu" onclick="oi('adm.usuarios.php')">
                           <figure>
                              <img src="../imagens/useradmin.png" class="imgItens">
                              <figcaption >Adm. Usuários</figcaption>
                          </figure>
                          </a>
                      </li>
                  </ul>
                  </div>
                  <!-- Aqui conterá a mensagem de bem vindo, e a opção de logout-->
                  <div id="containerBemVindo">
                      Bem Vindo, <?php echo($_SESSION['username'])?>
                      
                      <a href="#" id="logout" onclick="logout()">Logout</a>
                  </div>
                </nav>
         </header>  
         

