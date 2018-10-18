<?php
require_once('conexao.php');



    //function para selecionar itens sem inner join
    function selecionar($tablename, $primary_key) {
        $sql = "select * from ".$tablename." order by ".$primary_key;
        $conexao = conexaoBD();
        $select = mysqli_query($conexao, $sql);
        if(!$select) {
            printf(mysqli_error($conexao));
        }
        
        return $select;
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
        $conexao = conexaoBD();
        $delete = mysqli_query($conexao, $sql);
        if(!$delete) {
            printf(mysqli_error($conexao));
        }
        
        return $delete;
}

function update ($tablename, $setvalue, $primary_key, $idRegistro) {
    $sql = "update ".$tablename." set   ".$setvalue." where ". $primary_key. "=". $idRegistro;
        
        $conexao = conexaoBD();
        $update = mysqli_query($conexao, $sql);
        if(!$update) {
            printf(mysqli_error($conexao));
        }
        
        return $update;
}
?>