<?php
    session_start();
    require('../conexion/class.php');
    require('../conexion/conf.php');

    $error="";
    $saludo="";
    //$usuLogin="camila";
    //$pasLogin="camila";
    $usuLogin=$_POST["value"];
    $pasLogin=$_POST["value2"];

    $con = new DB_mysql();
    $con->conectar($BASEDEDATOS, $SERVIDOR, $USUARIO, $PASSWORD);
    //$query = 'select * from usuario where user="camila" and pass="camila"';
    $query = 'select * from usuario where user="'.$usuLogin.'" and pass="'.$pasLogin.'"';
    $cResultf = $con->consulta($query);
    $cont = $con->numregistros();
    if ($cResultf) {
        if ($cont > 0){
            $JSONArray = array();
            while ($result = mysql_fetch_array($cResultf)) {
                $JSONObject = array(
                    'idUsuario' => $result['idusuario'],
                    'dni' => $result['dni'],
                    'user' => $result['user'],
                    'pass' => $result['pass'],
                    'nombres' => $result['nombres'],
                    'paterno' => $result['paterno'],
                    'materno' => $result['materno'],
                    'status' => ( ($result['exist'] == null) ? true : false )
                );
                $JSONArray[] = $JSONObject;
            }
            $JSONObject = array('success' => true,  'items' => $JSONArray);
            //$_SESSION['sesion_micami']=date();
        } else {
            $JSONObject = array('success' => false, 'error' => 'no se encontraron datos');
        }
        $result = json_encode($JSONObject);
        print $result;
        print $_SESSION['sesion_micami'];
    } else {
        $JSONObject = array('success' => false, 'error' => 'error con la db');
        $result = json_encode($JSONObject);
        print $result;
    }

//    if(!$usuLogin || !$pasLogin){
//        $error="Usuario invalido, por favor ingrese su Usuario y Contraseña";
//    }else if($usuLogin=="bitsmike"){
//        $saludo="Hola que tal Mike";
//    }else{
//        $saludo="No eres Mike";
//    }
//    echo json_encode(array("error"=>$error, "saludo"=>$saludo));

?>