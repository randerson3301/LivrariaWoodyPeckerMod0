<?php



    //function para selecionar itens sem inner join
    function selecionar($tablename, $primary_key, $criterio=null) {
        $sql = "select * from ".$tablename;
        if($criterio != null ) 
            $sql = $sql ." where ". $criterio;
        
        $sql = $sql ." order by ".$primary_key;
        
        return $sql;
    }
/*
    //function para inserir itens
    function insert($tablename, $field, $value) {
        $sql = "insert into ".$tablename." order by ".$value;
        $conexao = conexaoBD();
        $select = mysqli_query($conexao, $sql);
        
        //caso a conexão venha a falhar uma mensagem de erro será mostrada.
        if(!$select) {
            printf(mysqli_error($conexao));
        }
        
        return $select;
    }


    function getfieldsfrom($tablename) {
        switch($tablename) {
            case 'tbl_nivel':
                return 'nomeNivel';
                break;
            case 'tbl_usuarios':
                return 'nomeNivel';
                break;
            
                    
        }
    }
*/

function delete($tablename, $primary_key, $idRegistro) {
     $sql = "delete from ".$tablename." where ".$primary_key. "=". $idRegistro;
     
     return $sql;
}

function update ($tablename, $setvalue, $primary_key, $idRegistro) {
    $sql = "update ".$tablename." set ". $setvalue." where ".$primary_key."=" .$idRegistro;
    return $sql;
}
?>