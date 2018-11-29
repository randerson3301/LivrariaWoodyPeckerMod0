<?php
require_once('cms/conexao.php');
$con = conexaoBD();
if(isset($_POST["btnLogar"])) {
       
       @$loginame = $_POST["txtUser"];
       $senha = $_POST["txtSenha"];

       //consulta a existência do usuário
       $sql = "select * from tbl_usuarios where loginNome='".$loginame."' 
       and senha='".$senha."' and isAtivado=1";
       //resultset
       $selectUser = mysqli_query($con, $sql);
       
       if($rsUsuario=mysqli_fetch_array($selectUser)) {
           
           $_SESSION['username'] = $rsUsuario['nomeUsuario'];

           $_SESSION['matricula'] = $rsUsuario['matricula'];
           

           $sqlNivel = "select * from tbl_nivel where idNivel=".$rsUsuario['idNivel'];

           $sltNivel = mysqli_query($con, $sqlNivel);

           //pegando informações sobre o nível do usuário a ser logado
            $rsnivel = mysqli_fetch_array($sltNivel);

           //o usuário não poderá se logar com o nível desativado
           if($rsnivel["isAtivado"] == 1) {
                $_SESSION['nivel'] = $rsUsuario['idNivel'];
                header("location:cms/cms.home.php");
           } else if($rsnivel["isAtivado"] == 0) {
                echo("<script>alert('Login não realizado. Por favor, certifique-se da permissão do seu nivel, entrando em contato com o Administrador')</script>");
            }
        } else {
           echo("<script>alert('Login não realizado. Por favor, certifique-se de sua autorização')</script>");
       }
       
}
?>