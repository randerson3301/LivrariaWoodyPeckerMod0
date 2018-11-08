<?php
require_once('cms/conexao.php');
$con = conexaoBD();
if(isset($_POST["btnLogar"])) {
       
       @$loginame = $_POST["txtUser"];
       $senha = $_POST["txtSenha"];
       //echo("<script>alert('to funcionando".$loginame. $senha."')</script>");

       //consulta a existência do usuário
       $sql = "select * from tbl_usuarios where loginNome='".$loginame."' 
       and senha='".$senha."' and isAtivado=1";
       //echo("<script>alert(".$sql.")</script>");
       //resultset
       $selectUser = mysqli_query($con, $sql);
       
       if($rsUsuario=mysqli_fetch_array($selectUser)) {
           echo("<script>alert('VocÊ está logadoo')</script>");
           
           $_SESSION['username'] = $rsUsuario['nomeUsuario'];

           header("location:cms/cms.home.php");
       } else {
           echo("<script>alert('Login não realizado. Por favor, certifique-se de sua autorização')</script>");
       }
       
}
?>