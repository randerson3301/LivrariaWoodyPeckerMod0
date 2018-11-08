<?php
 session_start(); //iniciando variaveis de sessão
function conexaoBD() {
   

    /* Essas variaveis armazenam os dados necessários para a conexão com o banco*/
    $host = "localhost";
    $database = "db_woody_woodpecker";
    $user = "randerson";
    $password = "r@nd3rs0n";

    //Fazendo error aparecerem na tela
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    
    if(!$conexao = mysqli_connect($host, $user, $password, $database)) {
        echo("<script>
                alert('Não foi possível realizar a conexão');
        </script>");
    }
    
    return $conexao;
}
    

?>