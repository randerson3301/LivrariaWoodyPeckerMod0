<?php



    //function para selecionar itens sem inner join
    function selecionar($tablename, $primary_key, $criterio=null) {
        $sql = "select * from ".$tablename;
        if($criterio != null ) 
            $sql = $sql ." where ". $criterio;
        
        $sql = $sql ." order by ".$primary_key;
        
        return $sql;
    }

    function getAtivacao($httpverb=null) {
        if(isset($_POST['checkAtivacao'])) {
            $atv = 1;
        } else {
             $atv = 0;
        }
        //caso o method do form seja get, basta setar o parametro $httpverb para get
        if($httpverb == "get") {
            if(isset($_GET['checkAtivacao'])) {
                $atv = 1;
            } else {
                 $atv = 0;
            }   
        }
        
        return $atv;
    }


function delete($tablename, $primary_key, $idRegistro) {
     $sql = "delete from ".$tablename." where ".$primary_key. "=". $idRegistro;
     
     return $sql;
}

function update ($tablename, $setvalue, $primary_key, $idRegistro) {
    $sql = "update ".$tablename." set ". $setvalue." where ".$primary_key."=" .$idRegistro;
    return $sql;
}

//essa function irá retornar o sql para desativar registros instantaneamente
function setUnicoAtivado($tabname, $id, $idAtual=null) {
    $sqldesativa= "update ".$tabname." set isAtivado = 0 where ". 
    $id." <> ". $idAtual;

    return $sqldesativa;
}

//desabilita todos os registros quando o último for inserido
function desabilitarTodos($tabname, $id, $con) {
 //retorna o ultimo registro
  $sqlLastRegister = "select * from ".$tabname." order by ".$id." desc limit 1 ";
  $selectLast = mysqli_query($con, 
  $sqlLastRegister);
  $rsLast = mysqli_fetch_array($selectLast);

  $sqldesativa = setUnicoAtivado($tabname, $id, $rsLast[$id]);

  return mysqli_query($con, $sqldesativa);
}
?>