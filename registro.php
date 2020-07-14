

<!DOCTYPE html>
<html lang="es">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://kit.fontawesome.com/493a09995c.js" crossorigin="anonymous"></script>
<link rel="stylesheet"  href="css/nav.css">
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<link rel="stylesheet"  href="css/form.css">
<link rel="stylesheet" type="text/css" href="css/utilidad.css">
<link rel="stylesheet" type="text/css" href="css/ingresar.css">



<head>
    <meta charset="UTF-8">
    <title>Registro</title>

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
    <i class="far fa-user-circle fa-2x"></i>
    
      

    </nav>


    <h2>Registro</h2>
</head>
<body>

<form action="" method="POST" class="needs-validation col " novalidate>
<div class="container-contact100">
  <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="usuario">Nombre</label>
      <input type="text" class="input100" name="name" id="validationCustom01" placeholder="Name" required>
      <span class="focus-input100"></span>
      <div class="valid-feedback">
        OK!
      </div>
    </div>
    <div class="col-md-4 mb-3">
    <label for="email ">Email </label>
    <input type="email" name="email" placeholder="name@example.com" class="input100" id="validationCustom02" required>
    <span class="focus-input100"></span>
      <div class="valid-feedback">
        Ok!
      </div>
    </div>
    <div class="col-md-4 mb-3">
     <label for="Pass">Contraseña</label>
        <input type="password" name="pass" placeholder="********" class="input100" id="validationCustomUsername"  required>
        <span class="focus-input100"></span>
        <div class="valid-feedback">
          OK!
        </div>
      </div>
    </div>
  
    <div class="col-md-6 mb-3">
      <label for="direccion">Direccion</label>
      <input type="text" name="address" placeholder="Calle_ #123 Col#" class="input100" id="validationCustom03" required>
      <span class="focus-input100"></span>
      <div class="invalid-feedback">
        Coloca una ciudad valida
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <label for="validationCustom04">Estado</label>
      <select name="estados" class="custom-select" id="validationCustom04" required>
        <option selected disabled value="">...</option>
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
        Selecciona un estado válido
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <label for="numero">Celular</label>
      <input type="text" name="phone" placeholder="0123456789" class="input100" id="validationCustom05" required>
      <span class="focus-input100"></span>
      <div class="invalid-feedback">
        selecciona un numero válido
      </div>
    </div>

    <div class="form-group">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
      <label class="form-check-label" for="invalidCheck">
        Acepto terminos y condiciones 
      </label>
      <div class="invalid-feedback">
        Debes de aceptar los terminos y condiciones 
      </div>
    </div>
    <br>
    <div class="g-recaptcha" data-sitekey="6LcNQPwUAAAAACKCJoKNORSz_nXZ-pB_NMjMzwEu"></div>
  <br>

  <button class="btn btn-primary" name="enviar" type="submit" value="Enviar">Enviar</button>
  </div>
    
  </div>
  
</form>




<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields

(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>




<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>


</body>
</html>


<?php 
    require_once("lib/nusoap.php");

    $serverURL = 'http://localhost/pwsdlpass/server2.php';
    $cliente = new nusoap_client("$serverURL?wsdl",'wsdl');

    if(isset($_POST['pass'])){
        $pass=$_POST['pass'];
        $email=$_POST['email'];
        $phone=$_POST['phone'];
        $name=$_POST['name'];
        $addres=$_POST['address'];
        $estados=$_POST['estados'];
        $captcha=$_POST['g-recaptcha-response'];
        //$secret='6LcNQPwUAAAAAG6iKMBdgvr7U-BoSQOLGZqoYu7t';
        //$response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha");
        //$arr=json_decode($response,TRUE);
        //var_dump($response);


          $result =$cliente->call(
              "valida_pass",
              array('pass' => $pass, 'email' => $email),
              "uri:$serverURL"
          );

        $result2=$cliente->call(
            "valida_phone",
            array('phone' => $phone),
            "uri:$serverURL"
        );

        $result4=$cliente->call(
          "recaptcha",
          array('g-recaptcha-response' => $captcha),
          "uri:$serverURL"
      );
           
        if(!$captcha){
          echo'<div class="alert alert-danger" role="alert">
          Verifica captcha
        </div>';
        }
       
        

    }

    echo'<br><font color="red">' .$result.'</font>';
    echo '<br><font color="red"> ' .$result2.'</font>';
    echo '<br><font color="blue"> ' .$result3.'</font>';
    echo '<br><font color="blue"> ' .$result4.'</font>';



    if($result=="OK"&&$result2=="OK"&&$result4=="OK")    {
//insertar usuario a la tabla de la d
      $result3=$cliente->call(
        "base_datos",
        array('name' => $name,'email' => $email,'pass' => $pass,'address' => $addres,'estados' => $estados,'phone' => $phone),
        "uri:$serverURL"
      );
        echo '<br><font color="blue"> ' .$result3.'</font>';

        header("Location: http://localhost/pwsdlpass/login.php");
      
    }
?>