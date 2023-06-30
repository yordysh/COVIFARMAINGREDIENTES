$(function () {
  $("#task-result").hide();
  fetchTasks();
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
});
