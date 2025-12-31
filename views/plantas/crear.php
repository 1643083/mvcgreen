<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrar planta</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container">
  <h1>Registro de plantas</h1>
    <div class="mb-3">
      <a href="./listar.php" class="btn btn-outline-primary btn-sm">Listar</a>
      <a href="./crear.php" class="btn btn-outline-success btn-sm">Crear</a>
      <a href="./buscar.php" class="btn btn-outline-info btn-sm">Buscar</a>
    </div>
<hr>

  <form id="formulario-planta">
    <div class="card">
      <div class="card-header">Complete el formulario</div>
      <div class="card-body">

        <div class="form-floating mb-2">
          <input type="text" id="nombre" class="form-control" required>
          <label for="nombre">Nombre de la planta</label>
        </div>

        <div class="form-floating mb-2">
          <select id="tipo" class="form-select" required>
            <option value="">Seleccione tipo</option>
            <option value="interior">Interior</option>
            <option value="exterior">Ornamental</option>
            <option value="suculenta">Medicinal</option>
          </select>
        </div>

        <div class="form-floating mb-2">
          <input type="number" step="0.01" min="0" id="precio" class="form-control" required>
          <label for="precio">Precio</label>
        </div>

        <div class="form-floating mb-2">
          <input type="number" min="0" id="stock" class="form-control" required>
          <label for="stock">Stock</label>
        </div>

        <div class="form-floating mb-2">
          <textarea id="descripcion" class="form-control" style="height: 100px"></textarea>
          <label for="descripcion">Descripción</label>
        </div>

      </div>
      <div class="card-footer text-end">
        <button class="btn btn-primary" type="button" id="btnGuardar">Guardar</button>
        <button class="btn btn-outline-secondary" type="reset">Cancelar</button>
      </div>
    </div>
  </form>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {

  document.querySelector("#btnGuardar").addEventListener("click", function () {
    if (confirm("¿Desea guardar la planta?")) {
      guardarDatos()
    }
  })

  function guardarDatos() {
    const datos = new FormData()
    datos.append("operacion", "registrar")
    datos.append("nombre", document.querySelector("#nombre").value)
    datos.append("tipo", document.querySelector("#tipo").value)
    datos.append("precio", document.querySelector("#precio").value)
    datos.append("stock", document.querySelector("#stock").value)
    datos.append("descripcion", document.querySelector("#descripcion").value)

    fetch('../../app/controllers/PlantaController.php', {
      method: 'POST',
      body: datos
    })
    .then(response => response.json())
    .then(data => {
      console.log(data)
      if (data.id > 0) {
        alert("Planta registrada correctamente 🌱")
        document.querySelector("#formulario-planta").reset()
      } else {
        alert("No se pudo registrar la planta 😭")
      }
    })
  }

})
</script>
