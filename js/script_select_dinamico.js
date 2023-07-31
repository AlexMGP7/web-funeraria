$(document).ready(function () {
  // Función para cargar datos en los selectores según el tipo
  function loadOptions(type, id, targetSelector) {
    $.ajax({
      url: "../../models/obtener_domicilio.php",
      type: "GET",
      data: {
        type: type,
        id: id,
      },
      dataType: "json",
      success: function (data) {
        var options = '<option value="">Seleccione una opción</option>';
        for (var i = 0; i < data.length; i++) {
          // Modificar cómo se construyen las opciones para incluir código y descripción
          options +=
            '<option value="' +
            data[i]["codigo"] +
            '">' +
            data[i]["codigo"] +
            " - " +
            data[i]["descripcion"] +
            "</option>";
        }
        $(targetSelector).html(options);
      },
      error: function (error) {
        console.log(error);
      },
    });
  }

  // Cargar los municipios al seleccionar un estado
  $("#estado_codigo").on("change", function () {
    var estadoId = $(this).val();
    if (estadoId !== "") {
      loadOptions("municipios", estadoId, "#municipio_codigo");
    } else {
      $("#municipio_codigo").html(
        '<option value="">Seleccione un municipio</option>'
      );
    }
  });

  // Cargar las parroquias al seleccionar un municipio
  $("#municipio_codigo").on("change", function () {
    var municipioId = $(this).val();
    if (municipioId !== "") {
      loadOptions("parroquias", municipioId, "#parroquia_codigo");
    } else {
      $("#parroquia_codigo").html(
        '<option value="">Seleccione una parroquia</option>'
      );
    }
  });
});
