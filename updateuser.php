<?php 

require_once("lib/nusoap.php");

$serverURL = 'http://localhost/pwsdlpass/server2.php';
$cliente = new nusoap_client("$serverURL?wsdl",'wsdl');

    include("db.php");

    if(isset($_GET['id'])){
        
        $id=(int)$_GET['id'];
        $tabla="users";
        $query="SELECT * FROM $tabla where id=$id";
    
        $resultado=mysqli_query($enlace,$query);
        if($resultado)
        {
            if(mysqli_num_rows($resultado)==1){
            $row=mysqli_fetch_array($resultado);
            $nombreuser=$row['name'];
            $emailuser=$row['emaill'];
            $passuser=$row['password'];
            $addressuser=$row['address'];
            $estadouser=$row['state'];
            $celluser=$row['cell'];
            $msg=$row;

        /*$update_productos=$cliente->call(
            "update_productos",
            array('id' => $id),
            "uri:$serverURL"
            );*/
            //echo'<br><font color="black">'.$depa.'</font>';
            }
        }
    }

    if(isset($_POST['update'])){
        $idu=$_GET['id'];
        $nombreus=$_POST['nombreus'];
        $emailus=$_POST['emailus'];
        $addus=$_POST['addresssus'];
        $estadous=$_POST['estadous'];
        $cellus=$_POST['celularus'];

        $update_user=$cliente->call(
            "update_user",
            array('id' => $idu,'nombreus' => $nombreus,'emailus' => $emailus,'addresssus' => $addus,'estadous' => $estadous,'celularus' => $cellus),
            "uri:$serverURL"
            );
            header("Location: http://localhost/pwsdlpass/mostrar.php");
    }
    echo'<br><font color="black">'.$update_user.'</font>';
    //
        

    

?>

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
    <title>Editar Usuario</title>

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
					Actualizar Usuario
				</span>

            

            <div class="wrap-input100 ">
                <input class="input100" type="text" name="nombreus" id="nombreus" placeholder="Nombre" value="<?php echo $nombreuser;?>" required>
                <span class="focus-input100"></span>
            </div>

            <div class="wrap-input100 ">
                <input class="input100" type="text" name="emailus" id="emailus" placeholder="name@example.com" value="<?php echo $emailuser;?>"required>
                <span class="focus-input100"></span>
            </div>
            <div class="wrap-input100">
                <input class="input100" type="tel" name="addresssus" id="addresssus" placeholder="calle_#123 Col. _" value="<?php echo $addressuser;?>"required>
                <span class="focus-input100"></span>
            </div>
            
            <div class="wrap-input100 ">
                <select name="estadous" class="custom-select" id="estadous" placeholder="" value="<?php echo $estadouser;?>" required>
                    <option selected disabled value="" ><?php echo $estadouser;?></option>
                    <option>Aguascalientes</option>
        <option>Baja California</option>
        <option>Baja California Sur</option>
        <option>Campeche</option>
        <option>Chiapas</option>
        <option>Chihuahua</option>
        <option>Coahuila</option>
        <option>Colima</option>
        <option>Durango</option>
        <option>Estado de México</option>
        <option>Guanajuato</option>
        <option>Guerrero </option>
        <option>Hidalgo</option>
        <option>Jalisco</option>
        <option>Michoacan</option>
        <option>Morelos</option>
        <option>Nayarit</option>
        <option>Nuevo León</option>
        <option>Oaxaca</option>
        <option>Puebla</option>
        <option>Querétaro</option>
        <option>Quintana Roo</option>
        <option>San Luis Potosí</option>
        <option>Sinaloa</option> 
        <option>Sonora</option>
        <option>Tabasco</option> 
        <option>Tamaulipas</option>
        <option>Tlaxcala</option>
        <option>Veracruz</option> 
        <option>Yucatán</option> 
        <option>Zacatecas</option> 

                </select>
                <div class="invalid-feedback">
                    Selecciona un estado valido
                </div>
            </div>
            
            <div class="wrap-input100">
                <input class="input100" type="tel" name="celularus" id="celularus" placeholder="+52 123456789" value="<?php echo $celluser;?>"required>
                <span class="focus-input100"></span>
            </div>
            

            <div class="container-contact100-form-btn">
                <button class="contact100-form-btn" type="submit"  id="update" name="update" >
						<span>
							<i class="fa fa-paper-plane-o m-r-6" aria-hidden="true"></i>
							Editar
						</span>
                </button>
               
            </div>
            
        <br><br>


       <!--</form>-->
    </div>
</div>

  </form>

<?php



/*
    if(isset($_POST['update'])){
        $idu=$_GET['id'];
        $departamentou=$_POST['departamento'];
        $nombreu=$_POST['nombrep'];
        $descripcionu=$_POST['descripcion'];
        $precio_cu=$_POST['precio_costo'];
        $visibleu=$_POST['visible'];
        $imagenu=$_POST['imagen']; 

        $nombre_imagen=$_FILES['imagen']['name'];
        $ruta='img/productos/'.$nombre_imagen;
        move_uploaded_file($_FILES['imagen']['tmp_name'],$ruta);

        

        $update_productos=$cliente->call(
        "update_productos",
        array('id' => $idu,'departamento' => $departamentou,'nombrep' => $nombreu,'descripcion' => $descripcionu,'precio_costo' => $precio_cu,'visible' => $visibleu,'imagen' => $ruta),
        "uri:$serverURL"
        );
        //header("Location: http://localhost/pwsdlpass/mostrar.php");
    }    
    
        echo'<br><font color="black">'.$update_productos.'</font>';
        header("Location: http://localhost/pwsdlpass/mostrar.php");*/
?>
    

  
  
 



    




<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>


</body>
</html>