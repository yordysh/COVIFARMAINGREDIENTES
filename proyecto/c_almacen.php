<?php
require_once("./m_almacen.php");
include("../funciones/f_funcion.php");



if ($_POST['accion'] == 'seleccionarProducto') {

    $respuesta = c_almacen::c_selectproductos();
    echo $respuesta;
}





class c_almacen
{



    static function c_selectproductos()
    {
        $consulta = new m_almacen();
        $ID_SOLUCIONES = filter_input(INPUT_POST, 'idSolucion');

        $datos = $consulta->MostrarPreparaciones($ID_SOLUCIONES);

        if (count($datos) == 0) {
            echo '<option value="0">No hay registros en esta colonia</option>';
        }

        for ($i = 0; $i < count($datos); $i++) {
            echo '<option value="' . $datos[$i]["ID_PREPARACIONES"] . '">' . $datos[$i]["NOMBRE_PREPARACION"] . '</option>';
        }
    }
}
