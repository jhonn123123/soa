<!DOCTYPE html>
<html lang="es">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://kit.fontawesome.com/493a09995c.js" crossorigin="anonymous"></script>
<link rel="stylesheet"  href="css/nav.css">
<link rel="stylesheet"  href="css/form.css">
<link rel="stylesheet" type="text/css" href="css/utilidad.css">
<link rel="stylesheet" type="text/css" href="css/ingresar.css">

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




<form action="" method="POST" enctype="multipart/form-data">
        
<div class="container-contact100">

    <div class="wrap-contact100 " >
        <!--<form class="contact100-form " id="form_ingresar" method="POST" >-->
				<span class="contact100-form-title">
					Ingresar Productos
				</span>

            <div class="wrap-input100 ">
                <select name="departamento" class="custom-select" id="departamento" placeholder="Departamento" required>
                    <option selected disabled value="" placeholder="Departamento">Departamento</option>
                    <option>Almacenamiento</option>
                    <option>Audio</option>
                    <option>Computacion</option>
                    <option>Energia</option>
                    <option>Telefonia</option>

                </select>
                <div class="invalid-feedback">
                    Selecciona un departamento valido
                </div>
            </div>

            <div class="wrap-input100 ">
                <input class="input100" type="text" name="nombrep" id="nombrep" placeholder="Producto" required>
                <span class="focus-input100"></span>
            </div>

            <div class="wrap-input100 ">
                <input class="input100" type="text" name="descripcion" id="descripcion" placeholder="Descripción" required>
                <span class="focus-input100"></span>
            </div>
            <div class="wrap-input100">
                <input class="input100" type="tel" name="precio_costo" id="precio_costo" placeholder="Precio Costo" required>
                <span class="focus-input100"></span>
            </div>
            
<fieldset class="form-group">
    <div class="row">
      <legend class="col-form-label col-sm-10 pt-0">Producto visible?</legend>
      <div class="col-sm-10">
        <div class="form-check">
          <input class="form-check-input" type="radio" name="visible" id="visible" value="si" checked>
          <label class="form-check-label" for="visible">
            Visible
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="visible" id="novisible" value="no">
          <label class="form-check-label" for="gridRadios2">
            No visible
          </label>
        </div>
      </div>
    </div>
  </fieldset>
            
            
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="imagen" name="imagen"  required>
                <label class="custom-file-label" >Subir Foto</label>

            </div>

            <div class="container-contact100-form-btn">
                <button class="contact100-form-btn" type="submit"  id="save" name="save" >
						<span>
							<i class="fa fa-paper-plane-o m-r-6" aria-hidden="true"></i>
							Enviar
						</span>
                </button>
               
            </div>
            
        <br><br>


       <!--</form>-->
    </div>
</div>

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


    if(isset($_POST['save'])){
        $departamento=$_POST['departamento'];
        $nombrep=$_POST['nombrep'];
        $descripcion=$_POST['descripcion'];
        $precio_c=$_POST['precio_costo'];
        $visible=$_POST['visible'];
        $imagen=$_POST['imagen']; 
        
        $nombre_imagen=$_FILES['imagen']['name'];
        $ruta='img/productos/'.$nombre_imagen;
        move_uploaded_file($_FILES['imagen']['tmp_name'],$ruta);

        $result =$cliente->call(
            "ingresar_productos",
             array('departamento' => $departamento,'nombrep' => $nombrep,'descripcion' => $descripcion,'precio_costo' => $precio_c,'visible' => $visible,'imagen' => $ruta),
            "uri:$serverURL"
        );
        echo $departamento.$nombrep.$descripcion.$precio_c.$visible.$ruta;
           
        
        
        
    }
    
   echo'<br><font color="red">' .$result.'</font>';
?>
