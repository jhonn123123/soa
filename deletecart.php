<?php
    require_once("lib/nusoap.php");

    $serverURL = 'http://localhost/pwsdlpass/server2.php';
    $cliente = new nusoap_client("$serverURL?wsdl",'wsdl');

    if(isset($_GET['id'])){
        $id=$_GET['id'];

        $eliminar_carrito=$cliente->call(
        "eliminar_carrito",
        array('id' => $id),
        "uri:$serverURL"
        ); 
        
        header("Location: http://localhost/pwsdlpass/carrito.php");
    }
    
?>