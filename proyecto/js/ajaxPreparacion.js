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
    var producto = $("#selectProductos");

    const accion = "seleccionarProducto";
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
        producto.html(data);
        // console.log(data);
      });
    });
  }
});
