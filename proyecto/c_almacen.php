<?php
require_once("./m_almacen.php");
include("../funciones/f_funcion.php");



if ($_POST['accion'] == 'seleccionarPreparacion') {

    $respuesta = c_almacen::c_selectproductos();
    echo $respuesta;
}

if ($_POST['accion'] == 'seleccionarCantidad') {

    $respuesta = c_almacen::c_selectcantidad();
    echo $respuesta;
}

if ($_POST['accion'] == 'seleccionarML') {

    $respuesta = c_almacen::c_selectML();
    echo $respuesta;
}

if ($_POST['accion'] == 'seleccionarL') {

    $respuesta = c_almacen::c_selectL();
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
            echo '<option value="0">No hay registros en soluciones</option>';
        }
        echo '<option value="0" selected disabled>Seleccione Preparación</option>';
        for ($i = 0; $i < count($datos); $i++) {

            echo '<option value="' . $datos[$i]["ID_PREPARACIONES"] . '">' . $datos[$i]["NOMBRE_PREPARACION"] . '</option>';
        }
    }

    static function c_selectcantidad()
    {
        $consulta = new m_almacen();
        $ID_PREPARACIONES = filter_input(INPUT_POST, 'idPreparacion');

        $datos = $consulta->MostrarCantidades($ID_PREPARACIONES);

        if (count($datos) == 0) {
            echo '<option value="0">No hay registros en preparaciones</option>';
        }
        echo '<option value="0" selected disabled>Seleccione Cantidad</option>';
        for ($i = 0; $i < count($datos); $i++) {
            echo '<option value="' . $datos[$i]["ID_CANTIDAD"] . '">' . $datos[$i]["CANTIDAD_PORCENTAJE"] . '</option>';
        }
    }

    static function c_selectML()
    {

        $consulta = new m_almacen();
        $ID_CANTIDAD = filter_input(INPUT_POST, 'idCantidad');

        $datos = $consulta->MostrarML($ID_CANTIDAD);

        if (count($datos) == 0) {
            echo '<option value="0">No hay registros en mililitros</option>';
        }
        echo '<option value="0" selected disabled>Seleccione cantidad ML</option>';
        for ($i = 0; $i < count($datos); $i++) {
            echo '<option value="' . $datos[$i]["ID_ML"] . '">' . $datos[$i]["CANTIDAD_MILILITROS"] . '</option>';
        }
    }
    static function c_selectL()
    {

        $consulta = new m_almacen();
        $ID_L = filter_input(INPUT_POST, 'idMililitros');

        $datos = $consulta->MostrarL($ID_L);

        if (count($datos) == 0) {
            echo '<option value="0">No hay registros en Litros</option>';
        }
        echo '<option value="0" selected disabled>Seleccione cantidad Litros</option>';
        for ($i = 0; $i < count($datos); $i++) {
            echo '<option value="' . $datos[$i]["ID_L"] . '">' . $datos[$i]["CANTIDAD_LITROS"] . '</option>';
        }
    }
}
