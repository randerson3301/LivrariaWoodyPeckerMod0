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

    function getDestaque(){
        //verificando o livro em destaque do form de livros
        if(isset($_POST['checkAtivacaoDestaque'])) {
            $atv = 1;
        } else {
             $atv = 0;
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




function callprocedure(mysqli $con, $procedure, $params="")
{
    if(!$con) {
        throw new Exception("Conexão inválida");
    }
    else
    {
       
        $sql = "CALL {$procedure}({$params});"; //chama o procedure
        $sqlSuccess = $con->multi_query($sql); //prepara para retorna mais de um registro
        
        //se a a conexão for bem sucedida...
        if($sqlSuccess)
        {
            //se tiver mais de um resultado..
            if($con->more_results())
            {
                //pega o primeiro registro retornado
                $result = $con->use_result();
                
                $retorno = array(); //array para armazenar os registros retornados
                
                // insere os registros no array
                while($registro = $result->fetch_assoc())
                {
                    $retorno[] = $registro;
                }
                
                // libera a primeira linha retornada
                
                $result->free();
                
                // libera outros registros
                while($con->more_results() && $con->next_result())
                {
                    $extraResult = $con->use_result();
                    if($extraResult instanceof mysqli_result){
                        $extraResult->free();
                    }
                }
                return $retorno;
            }
            else
            {
                return false;
            }
        }
        //caso a chamada não ocorra como esperado...
        else
        {
            throw new Exception("The call failed: " . $con->error);
        }
    }
}
?>