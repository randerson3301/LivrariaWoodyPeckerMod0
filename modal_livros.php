<?php 
require_once('cms/conexao.php');
require_once('cms/function.php');

$conexao = conexaoBD();

$codigo = $_POST['idRegistro'];

$sqlUpCliques ="UPDATE tbl_livro SET n_qtdeclique = n_qtdeclique + 1 WHERE isbn = '$codigo'";
;
mysqli_query($conexao, $sqlUpCliques);

$sql = "SELECT tl.*, te.nomeFantasia, tsc.sub_categoria 
            FROM tbl_livro tl 
            INNER JOIN tbl_editora te, tbl_sub_categoria tsc 
            WHERE isbn = '$codigo' AND tl.id_sub_categoria = tsc.id_sub_categoria 
            AND tl.cnpjEditora = te.cnpjEditora";

$select = mysqli_query($conexao, $sql);

if($rsConsulta=mysqli_fetch_array($select)) {
    $isbn = $rsConsulta['isbn'];
    $title = $rsConsulta['titulo'];
    $img = $rsConsulta['imgLivro'];
    $preco =  $rsConsulta['preco'];
    $anopub = $rsConsulta['anoPublicacao'];
    $numpages = $rsConsulta['numeroPaginas'];
    $edicao = $rsConsulta['edicao'];
    $vol = $rsConsulta['volume'];
    $desc = $rsConsulta['descricao'];
    $editora = $rsConsulta['nomeFantasia'];
    $genre = $rsConsulta['sub_categoria'];

    $autor = callprocedure($conexao, 'sp_autor', "$codigo");

    if($autor) {
        foreach($autor as $rsautor){
            $nomeautor = $rsautor['nome'];
        }
    }

    }
?>
<!-- header da modal, q vai conter o logotipo da empresa e um icone para fechamento da modal-->
<div id="header_modal">
<a href="#" class="closeModal" >
            <figure>
                <img src="imagens/delete.png"  alt="fechar" title="Fechar Janela">      
            </figure>
        </a> 
</div>
<!-- coluna esquerda da modal, irá conter uma parte dos dados da tbl_livro-->
<div class="divisorModal ">
    ISBN <br>
    <div class="viewDetail shadow3D">
        <?php echo($isbn) ?>
    </div><br>
    <!-- imagem do livro selecionado -->
    <img class="imgLivroModal shadow3D" src=" <?php echo("cms/$img") ?>"><br>
     Titulo<br>
    <div class="viewDetail shadow3D">
        <?php echo($title) ?>
    </div><br>
    Autor<br>
    <div class="viewDetail shadow3D">
        <?php echo(@$nomeautor) ?>   
    </div><br>
   Preço(em R$) <br>
    <div class="viewDetailSmall shadow3D">
    <?php echo($preco) ?>
    </div><br>
    Nº de páginas <br>
    <div class="viewDetailSmall shadow3D">
    <?php echo($numpages) ?>
    </div><br>
   
</div>
<!-- coluna direita de conteúdo -->
<div class="divisorModal">
    Ano de publicação <br>
    <div class="viewDetailSmall shadow3D">
        <?php echo($anopub) ?>
    </div>
       Edição: <br>
        <div class="viewDetailSmall shadow3D">
            <?php echo($edicao) ?>
        </div><br>
       Volume: <br>
        <div class="viewDetailSmall shadow3D">
             <?php echo($vol) ?>
        </div><br>
        Descrição/Sinopse 
        <textarea class="desc shadow3D"><?php echo(utf8_encode($desc)) ?></textarea><br>
        Editora <br>
        <div class="viewDetail shadow3D">
            <?php echo($editora) ?>
        </div><br>
        Gênero <br>
        <div class="viewDetail shadow3D">
             <?php echo(utf8_encode($genre)) ?>
        </div><br>
</div>