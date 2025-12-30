<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar planta</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container">
  <h1>Editar planta</h1>

  <form id="form-editar">
    <input type="hidden" id="id">

    <input class="form-control mb-2" id="nombre" placeholder="Nombre">
    <input class="form-control mb-2" id="tipo" placeholder="Tipo">
    <input class="form-control mb-2" id="precio" placeholder="Precio">
    <input class="form-control mb-2" id="stock" placeholder="Stock">
    <textarea class="form-control mb-2" id="descripcion" placeholder="Descripción"></textarea>

    <button class="btn btn-primary">Actualizar</button>
    <a href="listar.php" class="btn btn-secondary">Cancelar</a>
  </form>
</div>

<script>
  const params = new URLSearchParams(window.location.search);
  const id = params.get("id");

  const datos = new FormData();
  datos.append("operacion", "buscarPorId");
  datos.append("id", id);

  fetch("/mvcgreen/app/controllers/PlantaController.php", {
    method: "POST",
    body: datos
  })
  .then(res => res.json())
  .then(data => {
    const p = data[0];
    document.getElementById("id").value = p.id;
    document.getElementById("nombre").value = p.nombre;
    document.getElementById("tipo").value = p.tipo;
    document.getElementById("precio").value = p.precio;
    document.getElementById("stock").value = p.stock;
    document.getElementById("descripcion").value = p.descripcion;
  });

  document.getElementById("form-editar").addEventListener("submit", function(e){
    e.preventDefault();

    const datos = new FormData();
    datos.append("operacion", "actualizar");
    datos.append("id", document.getElementById("id").value);
    datos.append("nombre", document.getElementById("nombre").value);
    datos.append("tipo", document.getElementById("tipo").value);
    datos.append("precio", document.getElementById("precio").value);
    datos.append("stock", document.getElementById("stock").value);
    datos.append("descripcion", document.getElementById("descripcion").value);

    fetch("/mvcgreen/app/controllers/PlantaController.php", {
      method: "POST",
      body: datos
    })
    .then(res => res.json())
    .then(data => {
      window.location.href = "listar.php";
    });
  });
</script>

</body>
</html>
