<!DOCTYPE html>
<html lang="es">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://kit.fontawesome.com/493a09995c.js" crossorigin="anonymous"></script>
<link rel="stylesheet"  href="css/nav.css">
<link rel="stylesheet"  href="css/form.css">
<head>
    <meta charset="UTF-8">
    <title>Mostrar</title>

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
    <form class="form-inline">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="buscar">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
    </form>
    <i class="fas fa-shopping-cart fa-2x"></i>
    <a href="login.php"><i class="far fa-user-circle fa-2x"></i></a>
    
      

    </nav>

</head>
<body>
<br><br>

    
<h1>Admin</h1>




    <form action="" method="POST">    
      <div class="form-1-2">
          <label for="caja_busqueda">Buscar:</label>
          <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" name="busqueda" id="busqueda"></input><br>
      </div>
        <input type="submit" name="mostrar" class="btn btn-success" value="Mostrar Productos">
        <input type="submit" name="eliminar" class="btn btn-danger" value="Eliminar Producto">
        <input type="submit" name="usuarios" class="btn btn-info" value="ver usuarios">
    </form>


    
    <?php
        require_once("lib/nusoap.php");

        $serverURL = 'http://localhost/pwsdlpass/server2.php';
        $cliente = new nusoap_client("$serverURL?wsdl",'wsdl');
                
        session_start();
        if($_SESSION['usuario']!="admin@admin.com")
        {
          header("Location: http://localhost/pwsdlpass/index.php");
        }
        if(isset($_POST['mostrar'])){
            $busqueda=$_POST['busqueda'];

            $mostrar_productos=$cliente->call(
            "mostrar_productos",
            array('busqueda' => $busqueda),
            "uri:$serverURL"
            );

            
        }

        if(isset($_POST['eliminar'])){
          $busqueda2=$_POST['busqueda'];

          $eliminar=$cliente->call(
            "eliminar_telefonos",
            array('busqueda2' => $busqueda2  ),
            "uri:$serverURL"
            ); 
        }
             
        if(isset($_POST['usuarios'])){
          $busqueda3=$_POST['busqueda'];

          $showusers=$cliente->call(
            "showusers",
            array('busqueda' => $busqueda3  ),
            "uri:$serverURL"
            ); 
        }
        

         echo'<br><font color="black">' .$mostrar_productos.'</font>';
         echo'<br><font color="black">' .$eliminar.'</font>';
         echo'<br><font color="black">' .$showusers.'</font>';
         //echo "<script type='text/javascript'>alert('$eliminar');</script>";


                    
                        
                    
                    
    ?>
      
  
 



    




<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>


</body>
</html>