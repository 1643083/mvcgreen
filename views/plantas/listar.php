<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Plantas</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
</head>
<body>

  <div class="container">
    <h1>Lista de plantas</h1>
      <div class="mb-3">
        <a href="./listar.php" class="btn btn-outline-primary btn-sm">Listar</a>
        <a href="./crear.php" class="btn btn-outline-success btn-sm">Crear</a>
        <a href="./buscar.php" class="btn btn-outline-info btn-sm">Buscar</a>
      </div>
<hr>

    <table class="table table-striped" id="tabla-plantas">
      <thead>
        <tr>
          <th>ID</th>
          <th>NOMBRE</th>
          <th>TIPO</th>
          <th>PRECIO</th>
          <th>STOCK</th>
          <th>DESCRIPCIÓN</th>
          <th>OPERACIONES</th>
        </tr>
      </thead>
      <tbody>
        <!-- contenido dinámico -->
      </tbody>
    </table>
  </div>

  <script>

    function obtenerDatos(){
        const datos = new FormData();
        datos.append("operacion", "listar");

        fetch("/mvcgreen/app/controllers/PlantaController.php", {
          method: "POST",
          body: datos
        })
        .then(response => response.json())
        .then(data => {

          const tabla = document.querySelector("#tabla-plantas tbody");
          tabla.innerHTML = ""; // limpiar antes de pintar

          data.forEach(element => {
            tabla.innerHTML += `
              <tr>
                <td>${element.id}</td>
                <td>${element.nombre}</td>
                <td>${element.tipo}</td>
                <td>S/. ${element.precio}</td>
                <td>${element.stock}</td>
                <td>${element.descripcion ?? ""}</td>
                <td>
                    <button class="btn btn-sm btn-danger btn-eliminar" data-id="${element.id}">
                        Eliminar
                    </button>
                  <a href="editar.php?id=${element.id}" class="btn btn-sm btn-info">Editar</a>
                </td>
              </tr>
            `;
          });
        });
      }

    console.log("JS cargado");
    document.addEventListener("DOMContentLoaded", function(){

      obtenerDatos();
    });

    document.addEventListener("click", function(e){

    if (e.target.classList.contains("btn-eliminar")) {

        const id = e.target.getAttribute("data-id");

        if (confirm("¿Seguro que deseas eliminar esta planta?")) {

        const datos = new FormData();
        datos.append("operacion", "eliminar");
        datos.append("id", id);

        fetch("/mvcgreen/app/controllers/PlantaController.php", {
            method: "POST",
            body: datos
        })
        .then(response => response.json())
        .then(data => {
            obtenerDatos(); // recargar tabla
            console.log("resultado eliminar:", data);
        });
        }
    }
    });

  </script>

</body>
</html>
