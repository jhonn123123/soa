<!DOCTYPE html>
<html lang="es">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://kit.fontawesome.com/493a09995c.js" crossorigin="anonymous"></script>
<link rel="stylesheet"  href="css/nav.css">
<link rel="stylesheet" href="css/estilos.css">
<script src="https://smtpjs.com/v3/smtp.js"></script>
<head>
    <meta charset="UTF-8">
    <title>Bienvenido</title>

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
      <li><a href="contacto.php">Soporte</a></li>
    </ul>
    <form class="form-inline" action="" method="POST">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="buscar">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
    </form>
    <a href="carrito.php"><i class="fas fa-shopping-cart fa-2x"></i></a>
    <a href="login.php"><i class="far fa-user-circle fa-2x"></i></a>
    
      

    </nav>

</head>
<body>
  
<div class="upcont">
        <section class="l-section s-100 contac" id="">
            <div class="contac__content">
                <h1 class="center-content">Contacto</h1>
            </div>
        </section>
    </div>
    <section class="l-section cont">
        <div class="espcont center-content center-block">
            <div class="espform s-30 center-block center-content">
                <form action="" method="post">
                    <div class="espnom">
                        <label for="nombre">Asunto</label>
                        <input id="asunto" name="asunto" type="text"  maxlength="50" data-length="50" required />
                    </div>
                    
                    <div class="espmen">
                        <label for="titmensaje">Mensaje</label>
                        <div class="alturaMensa">
                            <textarea name="mensaje" id="mensaje" class="ESPmensaje center-content" required></textarea>
                        </div>
                    </div>
                    <div class="espenv">
                        <button type="submit" name="submit">Enviar</button>
                        <h5 class="notifCorrecto"> <?= $result; ?></h5>
                    </div>
                </form>
                                   
            </div> 
        </div>                     
    </section>

  
  <?php
    require_once("lib/nusoap.php");

    $serverURL = 'http://localhost/pwsdlpass/server2.php';
    $cliente = new nusoap_client("$serverURL?wsdl",'wsdl');

    session_start();
    $user=$_SESSION['usuario'];
    if($user!=""||$user!=null)
    {
        if(isset($_POST['submit'])){
      
        $asunto=$_POST['asunto'];
        $mensaje=$_POST['mensaje'];
        
        $smtp=$cliente->call(
            "smtp",
            array('usuario' => $user,'asunto' => $asunto,'mensaje' => $mensaje),
            "uri:$serverURL"
            ); 
        }
    }
    else{
        echo'<div class="alert alert-danger" role="alert">
        No estas logueado, no puedes enviar mensajes
      </div>';
    }
    
    echo'<br><font color="black">'.$smtp.'</font>';

  ?>
 

    
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>