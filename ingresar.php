<!DOCTYPE html>
<html lang="es">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://kit.fontawesome.com/493a09995c.js" crossorigin="anonymous"></script>
<link rel="stylesheet"  href="css/nav.css">
<link rel="stylesheet"  href="css/form.css">
<head>
    <meta charset="UTF-8">
    <title>Altas Telefonos</title>

    <nav class="navbar navbar-light" style="background-color: papayawhip;">  
    <ul>
      <li><a href="prueba.html">Home</a></li>
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


<br>  

<form action="" method="POST">
        <label for="Marca ">Marca</label><br>
        <select name="marca" class="custom-select" id="validationCustom04" required>
          <option selected disabled value="">...</option>
          <option>SAMSUNG</option>
          <option>APPLE</option>
          <option>HUAWEI</option>
          <option>MOTOROLA</option>
          <option>XIAOMI</option>
          <option>ZTE</option>
          <option>LG</option>
        </select>
        <div class="form-group">
          <label for="modelo">Modelo</label>
          <input type="text" class="form-control" name="modelo" id="modelo" required>
        </div>
        <div class="form-group">
          <label for="exampleFormControlTextarea1">Caracteristicas</label>
          <textarea class="form-control" id="caracteristicas" name="caracteristicas" rows="3" required></textarea>
        </div>  
        <div class="form-group">
          <label for="precio">Precio</label>
          <input type="tel" class="form-control" name="precio" id="precio" required>
        </div>
        <div class="form-group">
          <label for="exampleFormControlTextarea2">URL foto</label>
          <textarea class="form-control" id="url_foto" name="url_foto" rows="3" required></textarea>
        </div>   
        <br>

        <input type="submit" class="btn btn-info" value="Enviar">
  </form>

  
    

  
  
 



    




<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>


</body>
</html>

<?php 
    require_once("lib/nusoap.php");

    $serverURL = 'http://localhost/pwsdlpass/server2.php';
    $cliente = new nusoap_client("$serverURL?wsdl",'wsdl');

    if(isset($_POST['marca'])){
        $marca=$_POST['marca'];
        $modelo=$_POST['modelo'];
        $caracteristicas=$_POST['caracteristicas'];
        $precio=$_POST['precio'];
        $foto=$_POST['url_foto'];

        $ingresar_telefonos=$cliente->call(
          "ingresar_telefonos",
          array('marca' => $marca,'modelo' => $modelo,'caracteristicas' => $caracteristicas,'precio' => $precio,'foto' => $foto),
          "uri:$serverURL"
      );
    }

    echo'<br><font color="red">' .$ingresar_telefonos.'</font>';
?>