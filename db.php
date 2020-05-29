<?php

$servidor="localhost";
$usuario="root";
$clave="Benito9710";
$BD="SOA_emarket";
$tabla="tproductos";


$enlace=mysqli_connect($servidor,$usuario,$clave,$BD);
if(!$enlace)
{
    $msg="Error al conectarse";
}
?>