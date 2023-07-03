$(function () {
  $("#task-result").hide();
  fetchTasks();
  cargarSelect();
  function fetchTasks() {
    $.ajax({
      url: "./tablaPreparacion.php",
      type: "GET",
      success: function (data) {
        $("#tabla").html(data);
      },
      error: function (xhr, status, error) {
        console.error("Error al cargar los datos de la tabla:", error);
      },
    });
  }

  function cargarSelect() {
    const preparacion = $("#selectPreparaciones");
    const cantidad = $("#selectCantidad");
    const mililitros = $("#selectML");
    const litros = $("#selectL");
    const accion = "seleccionarPreparacion";
    const accionPreparacion = "seleccionarCantidad";
    const accionCantidad = "seleccionarML";
    const accionMililitros = "seleccionarL";

    $("#selectInsumos").change(function () {
      var idSolucion = $(this).val();
      $.ajax({
        data: {
          idSolucion: idSolucion,
          accion: accion,
        },
        dataType: "html",
        type: "POST",
        url: "./c_almacen.php",
      }).done(function (data) {
        preparacion.html(data);
        // console.log(data);
      });
    });

    $("#selectPreparaciones").change(function () {
      var idPreparacion = $(this).val();
      $.ajax({
        data: {
          idPreparacion: idPreparacion,
          accion: accionPreparacion,
        },
        dataType: "html",
        type: "POST",
        url: "./c_almacen.php",
      }).done(function (data) {
        cantidad.html(data);
        // console.log(data);
      });
    });

    $("#selectCantidad").change(function () {
      var idCantidad = $(this).val();
      $.ajax({
        data: {
          idCantidad: idCantidad,
          accion: accionCantidad,
        },
        dataType: "html",
        type: "POST",
        url: "./c_almacen.php",
      }).done(function (data) {
        mililitros.html(data);
      });
    });

    $("#selectML").change(function () {
      var idMililitros = $(this).val();

      $.ajax({
        data: {
          idMililitros: idMililitros,
          accion: accionMililitros,
        },
        dataType: "html",
        type: "POST",
        url: "./c_almacen.php",
      }).done(function (data) {
        litros.html(data);
      });
    });
  }
});
