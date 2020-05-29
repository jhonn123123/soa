<?php


require_once("lib/nusoap.php");

$serverURL = 'http://localhost/pwsdlpass/server2.php';
$cliente = new nusoap_client("$serverURL?wsdl",'wsdl');

if(isset($_POST['pass'])){
    $pass=$_POST['pass'];
    $email=$_POST['email'];
    $nombre=$_POST['nombre'];

    $result =$cliente->call(
        "valida_pass",
         array('pass' => $pass ),
        "uri:$serverURL"
    );
    $result2 =$cliente->call(
      "comprobar_email",
       array('email' => $email ),
      "uri:$serverURL"
  );

  $result3 =$cliente->call(
    "valida_nombre",
     array('nombre' => $nombre ),
    "uri:$serverURL"
);
}
echo'<br>'.$result;
if($result=="OK")
{
    
    
    $con=mysqli_connect('localhost','root','Benito9710','SOA_emarket') or die('Eror en la coneccion');
    $sql="INSERT INTO usuarios
    VALUES(null, '".$_POST["name"]."', '".$_POST["email"]."', '".$_POST["pass"]."',
    '".$_POST["address"]."','".$_POST["estados"]."', '".$_POST["phone"]."' )";
   $resultado=mysqli_query($con,$sql) or die ('Error en el query database');
    mysqli_close($con);

    echo 'REGISTRADO';    
    
    
    
    header("Location: http://localhost/pwsdlpass/prueba.html");


}



    

?>