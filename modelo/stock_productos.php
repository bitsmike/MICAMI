<?php

require('../conexion/class.php');
require('../conexion/conf.php');

//sleep(1);
$type=$_POST[saludo];
$con = new DB_mysql();
$con->conectar($BASEDEDATOS, $SERVIDOR, $USUARIO, $PASSWORD);

// Muestra los productos en Stock
    $query = 'select * from producto where rubro="'.$type.'"';
    $cResultf = $con->consulta($query);
    $cont = $con->numregistros();
    if ($cResultf) {
        if ($cont > 0) {
            $JSONArray = array();

            while ($result = mysql_fetch_array($cResultf)) {
                $JSONObject = array(
                    'idProducto' => $result['idproducto'],
                    'nombreProducto' => $result[nombre],
                    'presentacionProducto' => $result['presentacion'],
                    'precioProducto' => $result['precioVenta'],
                    'anchoProducto' => $result['ancho'],
                    'altoProducto' => $result['alto'],
                    'largoProducto' => $result['largo'],
                    'materialProducto' => $result['material'],
                    'caracteristicasProducto' => $result['caracteristicas'],
                    'fotoProducto' => $result['foto'],
                    'status' => ( ($result['exist'] == null) ? true : false )
                );
                $JSONArray[] = $JSONObject;
            }

            $JSONObject = array(
                'success' => true,
                'items' => $JSONArray
            );
        } else {
            $JSONObject = array(
                'success' => false,
                'error' => 'no se encontraron datos'
            );
        }

        $result = json_encode($JSONObject);
        print $result;
    } else {
        $JSONObject = array(
            'success' => false,
            'error' => 'error con la db'
        );
        $result = json_encode($JSONObject);
        print $result;
    }
?>
