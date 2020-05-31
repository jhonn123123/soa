<!DOCTYPE html>
<html lang="es">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://kit.fontawesome.com/493a09995c.js" crossorigin="anonymous"></script>
<link rel="stylesheet"  href="css/nav.css">
<link rel="stylesheet"  href="css/form.css">
<link rel="stylesheet" type="text/css" href="css/utilidad.css">
<link rel="stylesheet" type="text/css" href="css/ingresar.css">
<script
    src="https://www.paypal.com/sdk/js?client-id=AePSnQfQC_z6m6GOsHP1uJ4uHVIgrbliPXHegzZbR1w8seXTgnCA8FHJhd-xbrz9qjEUykevkM9srMPZ"> // Required. Replace SB_CLIENT_ID with your sandbox client ID.
  </script>
<head>
    <meta charset="UTF-8">
    <title>Carrito</title>

    <nav class="navbar navbar-light" style="background-color: papayawhip;">  
    <ul>
      <li><a href="index.php">Home</a></li>
      <li><a>Telefonia</a>
          <ul>
              <li><a>Samsung</a></li>
              <li><a>Apple</a></li>
              <li><a>Huawei</a></li>
              <li><a>Motorola</a></li>
              <li><a>Xiaomi</a></li>
              <li><a>ZTE</a></li>
              <li><a>LG</a></li>
          </ul>
      </li>    
      <li><a>Almacenamiento</a>
          <ul>
            <li><a>KINGSTON</a></li>
            <li><a>ADATA</a></li>
            <li><a>SANDISK</a></li>
            <li><a>BLACKPCS</a></li>
          </ul>
        </li>    
      <li><a>Energia</a></li>
      <li><a>Manos Libres</a></li>
      <li><a>Soporte</a></li>
    </ul>
    <form class="form-inline" action="" method="POST">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="buscar">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
    </form>
    <i class="fas fa-shopping-cart fa-2x"></i>
    <a href="login.php"><i class="far fa-user-circle fa-2x"></i></a>
    
      

    </nav>

</head>
<body>
  
<!-- Title Page -->
	<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-color: gainsboro;">
		<h1 class="l-text2 t-center container-sm" style="color: black">
			Carrito
		</h1>
  </section>
    
    

  
  <?php
    require_once("lib/nusoap.php");
    include("db.php");

    $serverURL = 'http://localhost/pwsdlpass/server2.php';
    $cliente = new nusoap_client("$serverURL?wsdl",'wsdl');

    session_start();
    $user=$_SESSION['usuario'];

    
    if(isset($_GET['id'])){
        
        $id=(int)$_GET['id'];
        $tabla="tproductos";
        $query="SELECT * FROM $tabla where id=$id";
    
        $resultado=mysqli_query($enlace,$query);
        if($resultado)
        {
            if(mysqli_num_rows($resultado)==1){
            $row=mysqli_fetch_array($resultado);
          
            $namep=$row['nombrep'];
            $descripcionp=$row['descripcionp'];
            $preciop=$row['precioc'];
            $fotop=$row['foto'];
            $cantidad=1;
            $cantidadS=(string)$cantidad;
            $total=$cantidad*(int)$preciop;
            $totalS=(string)$total;

            $carrito=$cliente->call(
            "carrito",
            array('id' => $id,'usuario' => $user,'cantidad' => $cantidad,'nombrep' => $namep,
            'descripcionp' => $descripcionp,'precioc' => $preciop,'foto' => $fotop,'total' => $total),
            "uri:$serverURL"
            );
          //  echo'<br><font color="black">'.$carrito.'</font>';
            }
        }
      }

      if(isset($user)){
      
        //echo $user;
        $mostrarcarrito=$cliente->call(
          "mostrarcarrito",
          array('usuario' => $user),
          "uri:$serverURL"
          ); 

        $mostrarsubtotal=$cliente->call(
           "mostrarsubtotal",
           array('usuario' => $user),
           "uri:$serverURL"
           );  

        $mostrarcheckout=$cliente->call(
          "mostrarcheckout",
          array('usuario' => $user),
          "uri:$serverURL"
          );  
        
        $mostrartotal=$cliente->call(
          "mostrartotal",
          array('usuario' => $user),
          "uri:$serverURL"
          );    
          
      }


    
    echo'<br><font color="black">'.$carrito.'</font>';
    echo'<br><font color="black">'.$mostrarcarrito.'</font>';
    echo'<br><font color="black">'.$mostrarsubtotal.'</font>';
    echo'<br><font color="black">'.$mostrarcheckout.'</font>';
    echo'<br><font color="black">'.$mostrartotal.'</font>';
  ?>

    
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>