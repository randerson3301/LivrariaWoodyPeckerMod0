<?php 
    require_once("conexao.php");
    $con = conexaoBD();
    //dando um get no id da categoria
    if(isset($_POST['id_categoria']) && !empty($_POST["id_categoria"])) {
        
        
        $id_cat = $_POST['id_categoria'];
        //echo($id_cat);
        //selecionando todos os registros da table de subcats onde o id for igual ao id requisitado
        $sqlsubcat = "select * from tbl_sub_categoria tsb where tsb.id_categoria=".$id_cat." and ativacao=1 order by tsb.sub_categoria asc";
        
        //echo($sqlsubcat);
        $sltsubcat = mysqli_query($con, $sqlsubcat); //objeto resultado da consulta
        $row_count = mysqli_num_rows($sltsubcat);  //contador dos registros retornados
        
        /*se a contagem for maior q 0, o callback vai ser carregado
        e assim o retorno das options de subcategoria aparecerão em seu devido lugar
        */
        if($row_count > 0) {
            echo ("<option value=''>Selecione uma sub-categoria</option>");
            while($rssubcat=mysqli_fetch_assoc($sltsubcat)) {
                // call back das options
                echo('<option value="'.$rssubcat['id_sub_categoria'].'">'
                    .$rssubcat["sub_categoria"].'
                    </option>');
            
            }
        }
        
    }else {
        echo("<script>alert('oe n deu certo')</script>");
    }
        
?>
