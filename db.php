<?php

$servidor="localhost";
$usuario="root";
$clave="";
$BD="SOA_emarket";
$tabla="tproductos";


$enlace=mysqli_connect($servidor,$usuario,$clave,$BD);
if(!$enlace)
{
    $msg="Error al conectarse";
}
?>
