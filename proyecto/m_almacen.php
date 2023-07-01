<?php

require_once("../funciones/DataBaseA.php");
// require_once("../funciones/f_funcion.php");

class m_almacen
{
  private $bd;
  public function __construct()
  {
    $this->bd = DataBase::Conectar();
  }

  public function MostrarSoluciones()
  {
    try {


      $stm = $this->bd->prepare(
        "SELECT * FROM T_SOLUCIONES"
      );

      $stm->execute();
      $datos = $stm->fetchAll();

      return $datos;
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }

  public function MostrarPreparaciones($ID_SOLUCIONES)
  {
    try {


      $stm = $this->bd->prepare(
        "SELECT * FROM T_PREPARACIONES WHERE ID_SOLUCIONES=:ID_SOLUCIONES"
      );
      $stm->bindParam(':ID_SOLUCIONES', $ID_SOLUCIONES);
      $stm->execute();
      $datos = $stm->fetchAll();

      return $datos;
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }
  public function MostrarPreparacionSoluciones()
  {
    try {


      $stm = $this->bd->prepare(
        "SELECT TS.NOMBRE_INSUMOS AS NOMBRE_INSUMOS, TP.NOMBRE_PREPARACION AS NOMBRE_PREPARACION, 
                                  TC.CANTIDAD_PORCENTAJE AS CANTIDAD_PORCENTAJE,TM.CANTIDAD_MILILITROS AS CANTIDAD_MILILITROS, 
                                  TL.CANTIDAD_LITROS AS CANTIDAD_LITROS  FROM T_SOLUCIONES AS TS
                                  INNER JOIN T_PREPARACIONES AS TP ON TP.ID_SOLUCIONES = TS.ID_SOLUCIONES
                                  INNER JOIN T_CANTIDAD AS TC ON TC.ID_PREPARACIONES = TP.ID_PREPARACIONES
                                  INNER JOIN T_ML AS TM ON TM.ID_CANTIDAD=TC.ID_CANTIDAD
                                  INNER JOIN T_L AS TL ON TL.ID_L = TM.ID_L"
      );

      $stm->execute();
      $datos = $stm->fetchAll();

      return $datos;
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }





  // public function InsertarAlmacen($NOMBRE_T_ZONA_AREAS)
  // {
  //   try {
  //     $stm = $this->bd->prepare("INSERT INTO T_ZONA_AREAS (COD_ZONA, NOMBRE_T_ZONA_AREAS, FECHA, VERSION) 
  //                                 VALUES ( '$COD_ZONA', '$NOMBRE_T_ZONA_AREAS', '$FECHA', '$VERSION')");


  //     $insert = $stm->execute();

  //     return $insert;
  //   } catch (Exception $e) {
  //     $this->bd->rollBack();
  //     die($e->getMessage());
  //   }
  // }

  // public function editarAlmacen($NOMBRE_T_ZONA_AREAS, $task_id)
  // {
  //   try {
  //     $this->bd->beginTransaction();

  //     $cod = new m_almacen();
  //     $repetir = $cod->contarRegistrosZona($NOMBRE_T_ZONA_AREAS);

  //     if ($repetir == 0) {
  //       $stmt = $this->bd->prepare("UPDATE T_ZONA_AREAS SET NOMBRE_T_ZONA_AREAS = :NOMBRE_T_ZONA_AREAS, VERSION =:VERSION WHERE COD_ZONA = :COD_ZONA");


  //       $VERSION = $cod->generarVersion();

  //       $stmt->bindParam(':NOMBRE_T_ZONA_AREAS', $NOMBRE_T_ZONA_AREAS, PDO::PARAM_STR);
  //       $stmt->bindParam(':COD_ZONA', $task_id, PDO::PARAM_INT);
  //       $stmt->bindParam(':VERSION', $VERSION, PDO::PARAM_STR);
  //       $update = $stmt->execute();

  //       $fechaDHoy = date('Y-m-d');

  //       if ($VERSION == '01') {
  //         $stm1 = $this->bd->prepare("INSERT INTO T_VERSION(VERSION) values(:version)");
  //         $stm1->bindParam(':version', $VERSION, PDO::PARAM_STR);
  //         $stm1->execute();
  //       } else {
  //         $stmver = $this->bd->prepare("SELECT * FROM T_VERSION WHERE cast(FECHA_VERSION as DATE) =cast('$fechaDHoy' as date)");


  //         $stmver->execute();
  //         $valor = $stmver->fetchAll();

  //         $valor1 = count($valor);

  //         if ($valor1 == 0) {
  //           $stm1 = $this->bd->prepare("UPDATE T_VERSION SET VERSION = :VERSION, FECHA_VERSION = :FECHA_VERSION");
  //           $stm1->bindParam(':VERSION', $VERSION, PDO::PARAM_STR);
  //           $stm1->bindParam(':FECHA_VERSION', $fechaDHoy);
  //           $stm1->execute();
  //         }
  //       }

  //       $update = $this->bd->commit();

  //       return $update;
  //     }
  //   } catch (Exception $e) {
  //     die($e->getMessage());
  //   }
  // }
  // public function eliminarAlmacen($COD_ZONA)
  // {
  //   try {

  //     $stm = $this->bd->prepare("DELETE FROM T_ZONA_AREAS WHERE COD_ZONA = :COD_ZONA");
  //     $stm->bindParam(':COD_ZONA', $COD_ZONA, PDO::PARAM_INT);

  //     $delete = $stm->execute();
  //     return $delete;
  //   } catch (Exception $e) {
  //     die("Error al eliminar los datos: " . $e->getMessage());
  //   }
  // }
}
