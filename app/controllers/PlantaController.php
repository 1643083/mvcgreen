<?php


// necesita del modelo para poder responder
require_once '../models/Planta.php';
$planta = new Planta();

// ¿qué operación desea realizar el usuario?
if (isset($_POST['operacion'])) {

    switch ($_POST['operacion']) {

        case 'listar':
            $registros = $planta->listar();
            echo json_encode($registros);
            break;

        case 'registrar':
            $datos = [
                "nombre"        => $_POST['nombre'],
                "tipo"          => $_POST['tipo'],
                "precio"        => $_POST['precio'],
                "stock"         => $_POST['stock'],
                "descripcion"   => $_POST['descripcion']
            ];
            $idobtenido = $planta->registrar($datos);
            echo json_encode(["id" => $idobtenido]);
            break;

        case 'actualizar':
            $datos = [
                "id"            => $_POST['id'],
                "nombre"        => $_POST['nombre'],
                "tipo"          => $_POST['tipo'],
                "precio"        => $_POST['precio'],
                "stock"         => $_POST['stock'],
                "descripcion"   => $_POST['descripcion']
            ];
            $resultado = $planta->actualizar($datos);
            echo json_encode(["filas" => $resultado]);
            break;

        case 'eliminar':
            $resultado = $planta->eliminar($_POST['id']);
            echo json_encode(["filas" => $resultado]);
            break;

        case 'buscarPorId':
            echo json_encode($planta->buscarPorId($_POST['id']));
            break;

        case 'buscarPorTipo':
            echo json_encode($planta->buscarPorTipo($_POST['tipo']));
            break;
    }
}