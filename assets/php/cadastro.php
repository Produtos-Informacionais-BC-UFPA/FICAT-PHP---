<?php 


include "conexao.php";
//Capturando valores do servidor
$unidade = $_POST['unidades'];
$titulo = $_POST['nome'];

echo $unidade;
echo $titulo;

if($unidade == "" || $unidade == null){
  echo"<script language='javascript' type='text/javascript'>alert('O campo unidade deve ser preenchido');window.location.href='index.php';</script>";

}else{

    $query = "INSERT INTO registros (unidade,titulo) VALUES ('$unidade','$titulo')";
    $insert = mysql_query($query,$conexao);

    if($insert){
      echo"<script language='javascript' type='text/javascript'>alert('Registrado com sucesso!');window.location.href='../../'</script>";

    }else{
      echo"<script language='javascript' type='text/javascript'>alert('Não registrado com sucesso.');window.location.href='../../'</script>";
    }
  
}
?>