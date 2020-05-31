<?php
    require_once("lib/nusoap.php");
    $miURL = "http://localhost/pwsdlpass/server2.php";
    $server = new soap_server();
    $server->configureWSDL('WSDLTST',$miURL);
    $server->wsdl->schemaTargetNamespace=$miURL;

    if(!isset($HTTP_RAW_POST_DATA))
    {
        $HTTP_RAW_POST_DATA = file_get_contents('php://input');
    }
    
    $server->register('valida_pass',
        array('pass' => 'xsd:string','email' => 'xsd:string'),
        array('return' => 'xsd:string'),
        $miURL);
    
    function valida_pass($pass,$email)
    {   
        $mayuscula=true;
        $minuscula=true;
        $numero=true;
        $especial=false;

        if(strlen($pass)<8){
            $msg="*Error contraseña invalida";
            return new soapval('return', 'xsd:string', $msg);
        }
        else{
            for($i=0;$i<strlen($pass);$i++)
            {
                if(!preg_match('`[a-z]`',$pass))
                {
                    $minuscula=false;
                    $msg="*Error debe tener almenos una letra minuscula";
                    return new soapval('return', 'xsd:string', $msg);
                }
                else if(!preg_match('`[A-Z]`',$pass))
                {
                    $mayuscula=false;
                    $msg="*Error debe tener almenos una letra mayuscula";
                    return new soapval('return', 'xsd:string', $msg);
                }
                else if (!preg_match('`[0-9]`',$pass))
                {
                    $numero=false;
                    $msg="*Error debe tener almenos un numero";
                    return new soapval('return', 'xsd:string', $msg);
                }
                else if(!preg_match('/[\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/',$pass)){
                    $especial=false;
                    $msg="*Error debe tener almenos un caracter especial";
                    return new soapval('return', 'xsd:string', $msg);
                }
            }
            $especial=true;
            if($mayuscula==true&&$minuscula==true&&$numero==true&&$especial==true){
                $msg="OK";
                return new soapval('return', 'xsd:string',$msg);
            }
        }
    }  
    //////////////////////////////////////////////////////////////////////////////////////////////////////////
   
    $server->register('valida_phone',
        array('phone' => 'xsd:string'),
        array('return' => 'xsd:string'),
        $miURL);

    function valida_phone($phone)
    {
        if(strlen($phone)==10)
        {
            $msg="OK";
            return new soapval('return', 'xsd:string',$msg);
        }
        else{
            $msg="*telefono incorrecto ";
        return new soapval('return', 'xsd:string',$msg);
        }
    }    
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    $server->register('base_datos',
        array('name' => 'xsd:string','email' => 'xsd:string','pass' => 'xsd:string','address' => 'xsd:string','estados' => 'xsd:string','phone' => 'xsd:string'),
        array('return' => 'xsd:string'),
        $miURL);



    function base_datos($name,$email,$pass,$address,$estados,$phone)
    {
        $servidor="localhost";
        $usuario="root";
        $clave="Benito9710";
        $DB="SOA_emarket";
        

    $enlace=mysqli_connect($servidor,$usuario,$clave,$DB);
    if(!$enlace)
    {
        $msg="Error al registrarse";
        return new soapval('return', 'xsd:string',$msg);
    }

        //$md5pass=md5($pass);
        $insertar="INSERT INTO usuarios(id, nombre, correo, contraseña, direccion, estado, telefono) 
        VALUES (null,'$name','$email','$pass','$address','$estados','$phone')";

        $insertar2="INSERT INTO users(name, emaill, password, address, state, cell) 
        VALUES ('$name','$email','$pass','$address','$estados','$phone')";

        $resultado=mysqli_query($enlace,$insertar2);

        if($resultado){
            $msg="OK datos agregados";
            return new soapval('return', 'xsd:string',$msg);
        }
        else{
            $msg="Error al ingresar datos";
            return new soapval('return', 'xsd:string',$msg);
        }
        mysqli_close($enlace);
    }
   //////////////////////////////////////////////////////////////////////////////////////////////////////////////
$server->register('valida_login',
    array('email' => 'xsd:string','pass' => 'xsd:string'),
    array('return' => 'xsd:string'),
    $miURL);

    function valida_login($email,$pass)
    {
        $servidor="localhost";
        $usuario="root";
        $clave="Benito9710";
        $DB="SOA_emarket";
        
        $enlace=mysqli_connect($servidor,$usuario,$clave,$DB);
        if(!$enlace)
        {
            $msg="Error al registrarse";
            return new soapval('return', 'xsd:string',$msg);
        }

        $query="SELECT COUNT(*) as contar from users where emaill='$email' and password = '$pass'";
        $resultado=mysqli_query($enlace,$query);
        $array=mysqli_fetch_array($resultado);

        if($array['contar']>0)
        {
            $msg="OK";
            return new soapval('return', 'xsd:string',$msg);
            
        }
        else
        {
            $msg="*Error no se encuentra en la base de datos ";
            return new soapval('return', 'xsd:string',$msg);
        }

        mysqli_close($enlace);
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    $server->register('ingresar_telefonos',
    array('marca' => 'xsd:string','modelo' => 'xsd:string','caracteristicas' => 'xsd:string','precio' => 'xsd:string','foto' => 'xsd:string'),
    array('return' => 'xsd:string'),    
    $miURL);

    function ingresar_telefonos($marca,$modelo,$caracteristicas,$precio,$foto)
    {
        $servidor="localhost";
        $usuario="root";
        $clave="Benito9710";
        $BD="SOA_emarket";
        $tabla="celulares";
        

    $enlace=mysqli_connect($servidor,$usuario,$clave,$BD);
    if(!$enlace)
    {
        $msg="Error al conectarse";
        return new soapval('return', 'xsd:string',$msg);
    }

       
        $insertar="INSERT INTO $tabla( marca, nombre_cel, caracteristicas, precio, foto) 
        VALUES ('$marca','$modelo','$caracteristicas','$precio','$foto')";

        $resultado=mysqli_query($enlace,$insertar);

        if($resultado){
            $msg="OK datos agregados";
            return new soapval('return', 'xsd:string',$msg);
        }
        else{
            $msg="*Error al ingresar datos a la base de datos";
            return new soapval('return', 'xsd:string',$msg);
        }
        mysqli_close($enlace);
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$server->register('ingresar_productos',
    array('departamento' => 'xsd:string','nombrep' => 'xsd:string','descripcion' => 'xsd:string','precio_costo' => 'xsd:string','visible' => 'xsd:string','imagen' => 'xsd:string'),
    array('return' => 'xsd:string'),    
    $miURL);

    function ingresar_productos($departamento,$nombrep,$descriocion,$precio_c,$visible,$imagen)
    {
        $servidor="localhost";
        $usuario="root";
        $clave="Benito9710";
        $BD="SOA_emarket";
        $tabla="tproductos";
        

    $enlace=mysqli_connect($servidor,$usuario,$clave,$BD);
    if(!$enlace)
    {
        $msg="Error al conectarse";
        return new soapval('return', 'xsd:string',$msg);
    }

       
        $insertar="INSERT INTO $tabla(id, departament, nombrep, descripcionp, precioc, visible, foto) 
        VALUES (null,'$departamento','$nombrep','$descriocion','$precio_c','$visible','$imagen')";

        $resultado=mysqli_query($enlace,$insertar);

        if($resultado){
            $msg="OK productos agregados";
            return new soapval('return', 'xsd:string',$msg);
        }
        else{
            $msg="*Error al ingresar producto a la base de datos";
            return new soapval('return', 'xsd:string',$msg);
        }
        mysqli_close($enlace);
    }

///////////////////////////////////////////////////////////////////////////////////////////////
$server->register('mostrar_productos',
array('busqueda' => 'xsd:string'),
array('return' => 'xsd:string'),    
$miURL);

function mostrar_productos($busqueda)
{
    $servidor="localhost";
    $usuario="root";
    $clave="Benito9710";
    $BD="SOA_emarket";
    $tabla="tproductos";
    

$enlace=mysqli_connect($servidor,$usuario,$clave,$BD);
if(!$enlace)
{
    $msg="Error al conectarse";
    return new soapval('return', 'xsd:string',$msg);
}

    $msg="";
    $mostrar="SELECT * FROM $tabla";
    
    $resultado=mysqli_query($enlace,$mostrar);
    $lista=mysqli_fetch_array($resultado);
    
    
    $query2="SELECT * FROM $tabla ORDER By id";
    
    if($resultado)
    {
        $q=mysqli_real_escape_string($enlace,$busqueda);
        $query2="SELECT id, departament, nombrep, descripcionp, precioc, visible, foto FROM $tabla
        WHERE departament LIKE '%".$q."%' OR nombrep LIKE '%".$q."%' OR descripcionp LIKE '%".$q."%' OR precioc LIKE '%".$q."%' OR visible LIKE '%".$q."%'
        OR foto LIKE '%".$q."%'";
        $resultado2=mysqli_query($enlace,$query2);
        if($resultado2->num_rows>0)
        {
            $msg.="<table class='table table-striped table-dark my-3'>
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Departamento</td>
                            <td>Producto</td>
                            <td>Descripcion</td>
                            <td>Precio</td>
                            <td>Visble</td>
                            <td>Foto</td>
                            <td>Editar</td>
                            <td>Eliminar</td>
                        </tr>
                    </thead>
                    <tbody>";
            //return new soapval('return', 'xsd:string',$msg); 
            while($fila=$resultado2->fetch_assoc())
            {
                $msg.="<tr>
                        <td>".$fila['id']."</td>
                        <td>".$fila['departament']."</td>
                        <td>".$fila['nombrep']."</td>
                        <td>".$fila['descripcionp']."</td>
                        <td>$".$fila['precioc'].".00</td>
                        <td>".$fila['visible']."</td>
                        <td><img src=".$fila['foto']." width='60' height='60'></td>
                        <td><a href='update.php?id=".$fila['id']."' class='btn btn-warning' >Editar</a></td>
                        <td><a href='delete.php?id=".$fila['id']."' class='btn btn-danger' >X</a></td>
                      </tr>";
            //return new soapval('return', 'xsd:string',$msg);  
            } 
            $msg.="</tbody></table>";
            return new soapval('return', 'xsd:string',$msg);
        }
        else{
            $msg="No se encontró resultado";
            return new soapval('return', 'xsd:string',$msg);
        }   
    }
    else{
        $msg="*Error al mostrar datos";
        return new soapval('return', 'xsd:string',$msg);
    }
    mysqli_close($enlace);
}
/////////////////////////////////////////////////////////////////////////////////////////
$server->register('update_productos',
array('id' => 'xsd:string','departamento' => 'xsd:string','nombrep' => 'xsd:string','descripcion' => 'xsd:string','precio_costo' => 'xsd:string','visible' => 'xsd:string','imagen' => 'xsd:string'),
array('return' => 'xsd:string'),    
$miURL);

function update_productos($idu,$depau,$nombreu,$despcionu,$preciou,$visibleu,$imagenu)
{
 
    $servidor="localhost";
    $usuario="root";
    $clave="Benito9710";
    $BD="SOA_emarket";
    $tabla="tproductos";
    

$enlace=mysqli_connect($servidor,$usuario,$clave,$BD);
if(!$enlace)
{
    $msg="Error al conectarse";
    return new soapval('return', 'xsd:string',$msg);
}
   
    $query="UPDATE $tabla SET departament='$depau',nombrep='$nombreu',descripcionp='$despcionu',precioc='$preciou',visible='$visibleu',foto='$imagenu' WHERE id=$idu";
    
    $resultado=mysqli_query($enlace,$query);
    if($resultado)
    {
        
        $msg="datos modificados";
        return new soapval('return', 'xsd:string',$msg);
        
    }
    else{
        $msg="*Error al actualizar datos";
        return new soapval('return', 'xsd:string',$msg);
    }
mysqli_close($enlace);

}
///////////////////////////////////////////////////////////////////////////////////
$server->register('showusers',
array('busqueda' => 'xsd:string'),
array('return' => 'xsd:string'),    
$miURL);

function showusers($busqueda)
{
    $servidor="localhost";
    $usuario="root";
    $clave="Benito9710";
    $BD="SOA_emarket";
    $tabla="users";
    

$enlace=mysqli_connect($servidor,$usuario,$clave,$BD);
if(!$enlace)
{
    $msg="Error al conectarse";
    return new soapval('return', 'xsd:string',$msg);
}
    $msg="";
   
    $mostrar="SELECT * FROM $tabla";
    
    $resultado=mysqli_query($enlace,$mostrar);
    $lista=mysqli_fetch_array($resultado);
    
    
    $query2="SELECT * FROM $tabla ORDER By id";
    
    if($resultado)
    {
        $q=mysqli_real_escape_string($enlace,$busqueda);
        $query2="SELECT id, name, emaill, password, address, state, cell FROM $tabla
        WHERE id LIKE '%".$q."%' OR name LIKE '%".$q."%' OR emaill LIKE '%".$q."%' OR cell LIKE '%".$q."%'";
        $resultado2=mysqli_query($enlace,$query2);
        if($resultado2->num_rows>0)
        {
            $msg.="<table class='table table-striped table-dark my-3'>
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Nombre</td>
                            <td>Email</td>
                            <td>Contraseña</td>
                            <td>Dirección</td>
                            <td>Estado</td>
                            <td>Telefono</td>
                            <td>Editar</td>
                        </tr>
                    </thead>
                    <tbody>";
            //return new soapval('return', 'xsd:string',$msg); 
            while($fila=$resultado2->fetch_assoc())
            {
                $msg.="<tr>
                        <td>".$fila['id']."</td>
                        <td>".$fila['name']."</td>
                        <td>".$fila['emaill']."</td>
                        <td>".$fila['password']."</td>
                        <td>".$fila['address']."</td>
                        <td>".$fila['state']."</td>
                        <td>".$fila['cell']."</td>
                        <td><a href='updateuser.php?id=".$fila['id']."' class='btn btn-warning' >Editar</a></td>
                      </tr>";
            //return new soapval('return', 'xsd:string',$msg);  
            } 
            $msg.="</tbody></table>";
            return new soapval('return', 'xsd:string',$msg);
        }
        else{
            $msg="No se encontró resultado";
            return new soapval('return', 'xsd:string',$msg);
        }   
    }
    else{
        $msg="*Error al mostrar datos";
        return new soapval('return', 'xsd:string',$msg);
    }
    mysqli_close($enlace);
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$server->register('eliminar_telefonos',
array('busqueda2' => 'xsd:string'),
array('return' => 'xsd:string'),    
$miURL);

function eliminar_telefonos($busqueda2)
{
    $servidor="localhost";
    $usuario="root";
    $clave="Benito9710";
    $BD="SOA_emarket";
    $tabla="tproductos";
    

$enlace=mysqli_connect($servidor,$usuario,$clave,$BD);
if(!$enlace)
{
    $msg="Error al conectarse";
    return new soapval('return', 'xsd:string',$msg);
}

    //$q=mysqli_real_escape_string($enlace,$busqueda2);
    $query="DELETE FROM  $tabla WHERE nombrep = '$busqueda2'";
    $resultado=mysqli_query($enlace,$query);
    
    if($resultado)
    {
        $msg="Datos eliminados";
        return new soapval('return', 'xsd:string',$msg);
    }
    else{
        $msg="*Error al eliminar datos";
        return new soapval('return', 'xsd:string',$msg);
    }
    mysqli_close($enlace);

}
////////////////////////////////////////////////////////////////////////////////////////////////
$server->register('eliminar_p',
array('id' => 'xsd:string'),
array('return' => 'xsd:string'),    
$miURL);

function eliminar_p($id)
{
    $servidor="localhost";
    $usuario="root";
    $clave="Benito9710";
    $BD="SOA_emarket";
    $tabla="tproductos";
    

$enlace=mysqli_connect($servidor,$usuario,$clave,$BD);
if(!$enlace)
{
    $msg="Error al conectarse";
    return new soapval('return', 'xsd:string',$msg);
}

    //$q=mysqli_real_escape_string($enlace,$busqueda2);
    $query="DELETE FROM  $tabla WHERE id = '$id'";
    $resultado=mysqli_query($enlace,$query);
    
    if($resultado)
    {
        $msg="Datos eliminados";
        return new soapval('return', 'xsd:string',$msg);
    }
    else{
        $msg="*Error al eliminar datos";
        return new soapval('return', 'xsd:string',$msg);
    }
    mysqli_close($enlace);

}
/////////////////////////////////////////////////////////////////////////////////////////////////
$server->register('update_user',
array('id' => 'xsd:string','nombreus' => 'xsd:string','emailus' => 'xsd:string','addresssus' => 'xsd:string','estadous' => 'xsd:string','celularus' => 'xsd:string'),
array('return' => 'xsd:string'),    
$miURL);

function update_user($idu,$nombreus,$emailus,$addressus,$estadous,$celularus)
{
 
    $servidor="localhost";
    $usuario="root";
    $clave="Benito9710";
    $BD="SOA_emarket";
    $tabla="users";
    

$enlace=mysqli_connect($servidor,$usuario,$clave,$BD);
if(!$enlace)
{
    $msg="Error al conectarse";
    return new soapval('return', 'xsd:string',$msg);
}
   
    $query="UPDATE $tabla SET name='$nombreus',emaill='$emailus',address='$addressus',state='$estadous',cell='$celularus' WHERE id=$idu";
    
    $resultado=mysqli_query($enlace,$query);
    if($resultado)
    {
        
        $msg="datos modificados";
        return new soapval('return', 'xsd:string',$msg);
        
    }
    else{
        $msg="*Error al actualizar datos";
        return new soapval('return', 'xsd:string',$msg);
    }
mysqli_close($enlace);

}
///////////////////////////////////////////////////////////////////////////////////////////////////
$server->register('mostrarp',
array('user' => 'xsd:string'),
array('return' => 'xsd:string'),    
$miURL);

function mostrarp($user)
{
    $servidor="localhost";
    $usuario="root";
    $clave="Benito9710";
    $BD="SOA_emarket";
    $tabla="tproductos";
    

$enlace=mysqli_connect($servidor,$usuario,$clave,$BD);
if(!$enlace)
{
    $msg="Error al conectarse";
    return new soapval('return', 'xsd:string',$msg);
}
    $msg="";
   
    $mostrar="SELECT * FROM $tabla";
    
    $resultado=mysqli_query($enlace,$mostrar);
    $lista=mysqli_fetch_array($resultado);
    
    
    $query2="SELECT * FROM $tabla ORDER By id";
    
    if($resultado)
    {
        $q=mysqli_real_escape_string($enlace,"");
        /*$query2="SELECT departament, nombrep, descripcionp, precioc, foto FROM $tabla
        WHERE departament LIKE '%".$q."%' OR nombrep LIKE '%".$q."%' OR descripcionp LIKE '%".$q."%' OR precioc LIKE '%".$q."%' 
        OR foto LIKE '%".$q."%'";*/
        $query2="SELECT * FROM $tabla WHERE visible='si'";
        $resultado2=mysqli_query($enlace,$query2);
        if($resultado2->num_rows>0)
        {
            $msg.="<div class='row row-cols-1 row-cols-md-4'>";
            //return new soapval('return', 'xsd:string',$msg); 
            while($fila=$resultado2->fetch_assoc())
            {
                $msg.="
            <div class='col mb-5'>
                <div class='card text-white bg-secondary h-100'>
                  <img src=".$fila['foto']." style='height: auto;' class='card-img-top' alt='...'>
                  <div class='card-body'>
                    <h1 class='card-title'>".$fila['nombrep']."</h5>
                    <p class='card-text'>".$fila['descripcionp']."</p>
                    <h2 class='card-text'>$".$fila['precioc'].".00MXN</h2>
                    <a href='carrito.php?id=".$fila['id']."' class='btn btn-primary'>Añadir al carrito</a>
                  </div>
                </div>
              </div>";
            //return new soapval('return', 'xsd:string',$msg);  
            } 
            $msg.="</div>";
            return new soapval('return', 'xsd:string',$msg);
        }
        else{
            $msg="No se encontró resultado";
            return new soapval('return', 'xsd:string',$msg);
        }    
    }
    else{
        $msg="*Error al mostrar los productos";
        return new soapval('return', 'xsd:string',$msg);
    }
    mysqli_close($enlace);
}
/////////////////////////////////////////////////////////////////////////////////////////////////
$server->register('carrito',
array('id' => 'xsd:string','usuario' => 'xsd:string','cantidad' => 'xsd:int','nombrep' => 'xsd:string','descripcionp' => 'xsd:string','precioc' => 'xsd:string','foto' => 'xsd:string','total' => 'xsd:int'),
array('return' => 'xsd:string'),    
$miURL);

function carrito($idc,$usuarioc,$cantidad,$productoc,$descripcionc,$preciocar,$foto,$total)
{
        $servidor="localhost";
        $usuario="root";
        $clave="Benito9710";
        $BD="SOA_emarket";
        $tabla="carrito";
        

    $enlace=mysqli_connect($servidor,$usuario,$clave,$BD);
    if(!$enlace)
    {
        $msg="Error al conectarse";
        return new soapval('return', 'xsd:string',$msg);
    }

       
        $insertar="INSERT INTO $tabla(idproducto, iduser, cantidad, producto, description, precio, foto, total) 
        VALUES ('$idc','$usuarioc','$cantidad','$productoc','$descripcionc','$preciocar','$foto','$total')";

        $resultado=mysqli_query($enlace,$insertar);

        if($resultado){
            $msg="Producto añadido al carrito";
            return new soapval('return', 'xsd:string',$msg);
        }
        else{
            $msg="*Error al ingresar producto al carrito";
            return new soapval('return', 'xsd:string',$msg);
        }
        mysqli_close($enlace);
}

////////////////////////////////////////////////////////////////////////////////////////////////
$server->register('mostrarcarrito',
array('usuario' => 'xsd:string'),
array('return' => 'xsd:string'),    
$miURL);

function mostrarcarrito($user)
{
    $servidor="localhost";
    $usuario="root";
    $clave="Benito9710";
    $BD="SOA_emarket";
    $tabla="carrito";
    

$enlace=mysqli_connect($servidor,$usuario,$clave,$BD);
if(!$enlace)
{
    $msg="Error al conectarse";
    return new soapval('return', 'xsd:string',$msg);
}
    $msg="";
    $subtotal=0;
   
    $mostrar="SELECT * FROM $tabla";
    
    $resultado=mysqli_query($enlace,$mostrar);
    $lista=mysqli_fetch_array($resultado);
    $cantidades=2; 
    
    //$query2="SELECT * FROM $tabla ORDER By id";
    
    if($resultado)
    {
        $q=mysqli_real_escape_string($enlace,"");
        /*$query2="SELECT departament, nombrep, descripcionp, precioc, foto FROM $tabla
        WHERE departament LIKE '%".$q."%' OR nombrep LIKE '%".$q."%' OR descripcionp LIKE '%".$q."%' OR precioc LIKE '%".$q."%' 
        OR foto LIKE '%".$q."%'";*/
        $query2="SELECT * FROM $tabla WHERE iduser='$user'";
        $resultado2=mysqli_query($enlace,$query2);
        if($resultado2->num_rows>0)
        {
            $msg.="
            <table class='table table-hover table-dark my-7'>
                    <thead>
                        <tr>
                            <td></td>
                            <td>Producto</td>
                            <td>Precio</td>
                            <td>Eliminar</td>
                        </tr>
                    </thead>
                    <tbody>";
            //return new soapval('return', 'xsd:string',$msg); 
            while($fila=$resultado2->fetch_assoc())
            {
                $msg.="
                <tr class='table-active'>
                <td><img src=".$fila['foto']." width='90' height='90'></td>
                <td>".$fila['producto']."</td>
                <td>$".$fila['precio'].".00</td>
                <td><a href='deletecart.php?id=".$fila['id']."' class='btn btn-danger'>X</a></td>
                
              </tr>";
             // $subtotal=$subtotal+$fila['total'];
              //$cantidades=$_POST['cantidad'];
            //return new soapval('return', 'xsd:string',$msg); 
            //<td><a href='updateuser.php?id=".$fila['id']."' class='btn btn-warning' >Editar</a></td> 
            } 
            $msg.="</tbody></table>";
            return new soapval('return', 'xsd:string',$msg);
        }
        else{
            $msg="No se encontró resultado";
            return new soapval('return', 'xsd:string',$msg);
        }    
    }
    else{
        $msg="*Error al mostrar el carrito";
        return new soapval('return', 'xsd:string',$msg);
    }
    mysqli_close($enlace);
}
//////////////////////////////////////////////////////////////////////////////////////////////////
$server->register('eliminar_carrito',
array('id' => 'xsd:string'),
array('return' => 'xsd:string'),    
$miURL);

function eliminar_carrito($id)
{
    $servidor="localhost";
    $usuario="root";
    $clave="Benito9710";
    $BD="SOA_emarket";
    $tabla="carrito";  

$enlace=mysqli_connect($servidor,$usuario,$clave,$BD);
if(!$enlace)
{
    $msg="Error al conectarse";
    return new soapval('return', 'xsd:string',$msg);
}
    //$q=mysqli_real_escape_string($enlace,$busqueda2);
    $query="DELETE FROM  $tabla WHERE id = '$id'";
    $resultado=mysqli_query($enlace,$query);
    
    if($resultado)
    {
        $msg="Datos eliminados";
        return new soapval('return', 'xsd:string',$msg);
    }
    else{
        $msg="*Error al eliminar datos";
        return new soapval('return', 'xsd:string',$msg);
    }
    mysqli_close($enlace);
}
///////////////////////////////////////////////////////////////////////////////////////////////////
$server->register('mostrarsubtotal',
array('usuario' => 'xsd:string'),
array('return' => 'xsd:string'),    
$miURL);

function mostrarsubtotal($user)
{
    $servidor="localhost";
    $usuario="root";
    $clave="Benito9710";
    $BD="SOA_emarket";
    $tabla="carrito";
    

$enlace=mysqli_connect($servidor,$usuario,$clave,$BD);
if(!$enlace)
{
    $msg="Error al conectarse";
    return new soapval('return', 'xsd:string',$msg);
}
    $msg="";
    $subtotal=0;
   
    $mostrar="SELECT * FROM $tabla";
    $resultado=mysqli_query($enlace,$mostrar);
    
    if($resultado)
    {
        $q=mysqli_real_escape_string($enlace,"");
        /*$query2="SELECT departament, nombrep, descripcionp, precioc, foto FROM $tabla
        WHERE departament LIKE '%".$q."%' OR nombrep LIKE '%".$q."%' OR descripcionp LIKE '%".$q."%' OR precioc LIKE '%".$q."%' 
        OR foto LIKE '%".$q."%'";*/
        $query2="SELECT * FROM $tabla WHERE iduser='$user'";
        $resultado2=mysqli_query($enlace,$query2);
        if($resultado2->num_rows>0)
        {
            $msg.="
            <div class='container p-l-40 p-r-40 p-t-30 p-b-38 m-t-10 m-r-5 m-l-auto p-lr-15-sm' id='tabla_total'>
            <h5 class='m-text20 p-b-24'>
                Total
            </h5>

            <div class='flex-w flex-sb-m p-b-12' >
                <span class='s-text18 w-size19 w-full-sm'>
                    Subtotal:
                </span>
            ";
            //return new soapval('return', 'xsd:string',$msg); 
            while($fila=$resultado2->fetch_assoc())
            {
                //$msg.="";
                $subtotal+=$fila['total'];
               
            } 
            $msg.="	
                <span class='m-text21 w-size20 w-full-sm'id='total_carrito'>
                    <h2 id='subtotal'>$".$subtotal.".00 MNX</h2>
                </span>
            </div>
            </div>";
            return new soapval('return', 'xsd:string',$msg);
        }
        else{
            $msg="No se encontró resultado";
            return new soapval('return', 'xsd:string',$msg);
        }    
    }
    else{
        $msg="*Error al mostrar el carrito";
        return new soapval('return', 'xsd:string',$msg);
    }
    mysqli_close($enlace);
}
/////////////////////////////////////////////////////////////////////////////////////////////////
$server->register('mostrarcheckout',
array('usuario' => 'xsd:string'),
array('return' => 'xsd:string'),    
$miURL);

function mostrarcheckout($user)
{
    $servidor="localhost";
    $usuario="root";
    $clave="Benito9710";
    $BD="SOA_emarket";
    $tabla="users";
    

$enlace=mysqli_connect($servidor,$usuario,$clave,$BD);
if(!$enlace)
{
    $msg="Error al conectarse";
    return new soapval('return', 'xsd:string',$msg);
}
    $msg="";
    $subtotal=0;
   
    $mostrar="SELECT * FROM $tabla WHERE emaill='$user'";
    $resultado=mysqli_query($enlace,$mostrar);
    
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

            $msg="
            <div class='container p-l-40 p-r-40 p-t-30 p-b-38 m-t-10 m-r-5 m-l-auto p-lr-15-sm' id='tabla_total'>
                <div class='flex-w flex-sb-m p-b-12'>
					<span class='s-text18 w-size19 w-full-sm'>
						Envio:
					</span>
					<span class='m-text21 w-size20 w-full-sm'id='shippin'>
						<h2 id='shipping'>$150.00 MXN</h2>
					</span>
				</div>
				<div class='flex-w flex-sb bo10 p-t-15 p-b-20'>
					<span class='s-text18 w-size19 w-full-sm'>
						Checkout:
					</span>
					<div class='w-size20 w-full-sm' id='tabla_subtotal'>
						<p class='s-text8 p-b-23'>
							Verifica que tus todos tus datos esten correctamente antes de proceder a la compra 
						</p>

						<div class='size13 bo4 m-b-12'>
							<input class='sizefull s-text7 p-l-15 p-r-15' type='text' name='estadoss' placeholder='Estado' value=".$estadouser.">
						</div>

						<div class='size13 bo4 m-b-12'>
						<input class='sizefull s-text7 p-l-15 p-r-15' type='text' name='nombre' placeholder='Nombre' value=".$nombreuser.">
						</div>

						<div class='size13 bo4 m-b-22'>
							<input class='sizefull s-text7 p-l-15 p-r-15' type='text' name='celular' placeholder='+52' value='+52 ".$celluser."'>
						</div>


					</div>
                </div>
            </div>";
            return new soapval('return', 'xsd:string',$msg);
        }   
        
        
    }
    else{
        $msg="*Error al mostrar el carrito";
        return new soapval('return', 'xsd:string',$msg);
    }
    mysqli_close($enlace);
}
/////////////////////////////////////////////////////////////////////////////////////////////////
$server->register('mostrartotal',
array('usuario' => 'xsd:string'),
array('return' => 'xsd:string'),    
$miURL);

function mostrartotal($user)
{
    $servidor="localhost";
    $usuario="root";
    $clave="Benito9710";
    $BD="SOA_emarket";
    $tabla="carrito";
    

$enlace=mysqli_connect($servidor,$usuario,$clave,$BD);
if(!$enlace)
{
    $msg="Error al conectarse";
    return new soapval('return', 'xsd:string',$msg);
}
    $msg="";
    $total=0;
   
    $mostrar="SELECT * FROM $tabla";
    $resultado=mysqli_query($enlace,$mostrar);
    
    if($resultado)
    {
        $q=mysqli_real_escape_string($enlace,"");
        /*$query2="SELECT departament, nombrep, descripcionp, precioc, foto FROM $tabla
        WHERE departament LIKE '%".$q."%' OR nombrep LIKE '%".$q."%' OR descripcionp LIKE '%".$q."%' OR precioc LIKE '%".$q."%' 
        OR foto LIKE '%".$q."%'";*/
        $query2="SELECT * FROM $tabla WHERE iduser='$user'";
        $resultado2=mysqli_query($enlace,$query2);
        if($resultado2->num_rows>0)
        {
            $msg.="
            <div class='container p-l-40 p-r-40 p-t-30 p-b-38 m-t-10 m-r-5 m-l-auto p-lr-15-sm' id='tabla_total'>
            ";
            //return new soapval('return', 'xsd:string',$msg); 
            while($fila=$resultado2->fetch_assoc())
            {
                //$msg.="";
                $total+=$fila['total'];
               
            } 
            $total=$total+150;
            $msg.="	
        <div class='flex-w flex-sb-m p-t-26 p-b-30'>
            <span class='m-text22 w-size19 w-full-sm'>
                Total:
            </span>

            <span class='m-text21 w-size20 w-full-sm'>
                <h3 id='total2'>$".$total.".00 MXN</h3>
            </span>
        </div>

        <div id='paypal-button-container'></div>

  <script>
  paypal.Buttons({
    createOrder: function(data, actions) {
      // This function sets up the details of the transaction, including the amount and line item details.
      return actions.order.create({
        purchase_units: [{
          amount: {
            value: '".$total."'
          }
        }]
      });
    }
  }).render('#paypal-button-container');
  </script>

        </div>";
            return new soapval('return', 'xsd:string',$msg);
        }
        else{
            $msg="No se encontró resultado";
            return new soapval('return', 'xsd:string',$msg);
        }    
    }
    else{
        $msg="*Error al mostrar el carrito";
        return new soapval('return', 'xsd:string',$msg);
    }
    mysqli_close($enlace);
}
/////////////////////////////////////////////////////////////////////////////////////////////////
    $server->service($HTTP_RAW_POST_DATA);
    ?>