<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar producto</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>
<body>
    <div class="container mt-3">
        <h3>Búsqueda de plantas</h3>
        <div class="mb-3">
          <a href="./listar.php" class="btn btn-outline-primary btn-sm">Listar</a>
          <a href="./crear.php" class="btn btn-outline-success btn-sm">Crear</a>
          <a href="./buscar.php" class="btn btn-outline-info btn-sm">Buscar</a>
        </div>
      <h3>Búsqueda de planta por ID</h3>    
        <form id="form-busqueda-id">
            <div class="mb-3">
                <label for="idbuscado">ID de la planta</label>
                <div class="input-group">
                <span class="input-group-text">Ingrese solo números</span>
                <input type="text" class="form-control" id="idbuscado">
                <button class="btn btn-success" type="submit">
                    Buscar
                </button>
                </div>
            </div>

            <div>
                <label>Resultado</label>
                <input type="text" class="form-control" id="resultado">
            </div>
            </form>


        <hr>
    </div>

    <div class="container mt-3">
        <h3>Búsqueda por tipo de planta</h3>
            <form id="form-busqueda-tipo">
            <div class="input-group">
                <select id="tipo" class="form-select">
                <option value="">Seleccione</option>
                <option value="interior">Interior</option>
                <option value="ornamental">Ornamental</option>
                <option value="Medicinal">Medicinal</option>
                </select>
                <button class="btn btn-success" type="submit">Buscar</button>
            </div>
            </form>

            <table class="table table-bordered mt-3" id="tabla-tipo">
            <thead>
                <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Tipo</th>
                <th>Precio</th>
                <th>Stock</th>
                </tr>
            </thead>
            <tbody></tbody>
            </table>
        </div>



  </div>

    <script>
document.addEventListener("DOMContentLoaded", function () {

  // Buscar por ID
  document.querySelector("#form-busqueda-id").addEventListener("submit", function(e){
    e.preventDefault()

    const datos = new FormData()
    datos.append("operacion", "buscarPorId")
    datos.append("id", document.querySelector("#idbuscado").value)

    fetch('../../app/controllers/PlantaController.php', {
      method: 'POST',
      body: datos
    })
    .then(response => response.json())
    .then(data => {
      if (data.length > 0){
        const planta = data[0]
        document.querySelector("#resultado").value =
          planta.nombre + " (" + planta.tipo + ")"
      } else {
        document.querySelector("#resultado").value = ""
        alert("No se encontró la planta 😢")
      }
    })
  })

  // Buscar por tipo
  document.querySelector("#form-busqueda-tipo").addEventListener("submit", function(e){
    e.preventDefault()

    const datos = new FormData()
    datos.append("operacion", "buscarPorTipo")
    datos.append("tipo", document.querySelector("#tipo").value)

    fetch('../../app/controllers/PlantaController.php', {
      method: 'POST',
      body: datos
    })
    .then(response => response.json())
    .then(data => {
      const tabla = document.querySelector("#tabla-tipo tbody")
      tabla.innerHTML = ""

      data.forEach(p => {
        tabla.innerHTML += `
          <tr>
            <td>${p.id}</td>
            <td>${p.nombre}</td>
            <td>${p.tipo}</td>
            <td>${p.precio}</td>
            <td>${p.stock}</td>
          </tr>
        `
      })
    })
  })

})
</script>


</body>
</html>