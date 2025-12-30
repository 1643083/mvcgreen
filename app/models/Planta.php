<?php


// Requerimos de la conexión
require_once 'Conexion.php';

// Herencia (Conexion cede su método a Planta)
class Planta extends Conexion
{
  // Este atributo contendrá la conexión
  private $pdo;

  // Constructor
  public function __construct()
  {
    $this->pdo = parent::getConexion();
  }

   // Listar todas las plantas
  public function listar(): array
  {
    try {
      $sql = "
        SELECT 
          id, nombre, tipo, precio, stock, descripcion, created, updated
        FROM planta
        ORDER BY id DESC
      ";

      $consulta = $this->pdo->prepare($sql);
      $consulta->execute();

      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      return [];
    }
  }

   // Registrar nueva planta
  public function registrar($registro = []): int
  {
    try {
      $sql = "
        INSERT INTO planta
          (nombre, tipo, precio, stock, descripcion)
        VALUES
          (?,?,?,?,?)
      ";

      $consulta = $this->pdo->prepare($sql);
      $consulta->execute(
        array(
          $registro['nombre'],
          $registro['tipo'],
          $registro['precio'],
          $registro['stock'],
          $registro['descripcion']
        )
      );

      return $this->pdo->lastInsertId();
    } catch (Exception $e) {
      return -1;
    }
  }

   // Eliminar planta
  public function eliminar($id): int
  {
    try {
      $sql = "DELETE FROM planta WHERE id = ?";
      $consulta = $this->pdo->prepare($sql);
      $consulta->execute(array($id));

      return $consulta->rowCount();
    } catch (Exception $e) {
      return -1;
    }
  }

  // Actualizar planta
  public function actualizar($registro = []): int
  {
    try {
      $sql = "
        UPDATE planta SET
          nombre = ?,
          tipo = ?,
          precio = ?,
          stock = ?,
          descripcion = ?,
          updated = NOW()
        WHERE id = ?
      ";

      $consulta = $this->pdo->prepare($sql);
      $consulta->execute(
        array(
          $registro['nombre'],
          $registro['tipo'],
          $registro['precio'],
          $registro['stock'],
          $registro['descripcion'],
          $registro['id']
        )
      );

      return $consulta->rowCount();
    } catch (Exception $e) {
      return -1;
    }
  }

   // Buscar por ID
  public function buscarPorId(int $id)
  {
    try {
      $sql = "SELECT * FROM planta WHERE id = ?";
      $consulta = $this->pdo->prepare($sql);
      $consulta->execute(array($id));

      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      return [];
    }
  }

  // Buscar por tipo
  public function buscarPorTipo(string $tipo)
  {
    try {
      $sql = "SELECT * FROM planta WHERE tipo = ?";
      $consulta = $this->pdo->prepare($sql);
      $consulta->execute(array($tipo));

      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      return [];
    }
  }
}

//$planta = new Planta();
//print_r($planta->listar());