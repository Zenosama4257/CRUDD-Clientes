<?php
require_once "controllers/clientsController.php";
//recoger datos
if (!isset($_REQUEST["id"])) {
  header('location:index.php?accion=listar');
  exit();
}
$id = $_REQUEST["id"];
$controlador = new clientsController();
$cliente = $controlador->ver($id);

$visibilidad = "hidden";
$mensaje = "";
$clase = "alert alert-success";
$mostrarForm = true;
if ($cliente == null) {
  $visibilidad = "visbility";
  $mensaje = "El cliente con id: {$id} no existe. Por favor vuelva a la pagina anterior";
  $clase = "alert alert-danger";
  $mostrarForm = false;
} else if (isset($_REQUEST["evento"]) && $_REQUEST["evento"] == "modificar") {
  $visibilidad = "vibility";
  $mensaje = "Cliente con id {$id}, que pertenece a la empresa: {$_REQUEST["company_name"]} y con el número de contacto  {$_REQUEST["contact_phone_number"]} Modificado con éxito";
  if (isset($_REQUEST["error"])) {
    $mensaje = "No se ha podido modificar el id {$id}  que pertenece a la empresa: {$_REQUEST["company_name"]} y con el número de contacto  {$_REQUEST["contact_phone_number"]}";
    $clase = "alert alert-danger";
  }
}
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h3">Editar Cliente con Id: <?= $id ?></h1>
  </div>
  <div id="contenido">
    <div id="msg" name="msg" class="<?= $clase ?>" <?= $visibilidad ?>> <?= $mensaje ?> </div>
    <?php
    if ($mostrarForm) {
    ?>
      <form action="index.php?tabla=client&accion=guardar&evento=modificar" method="POST">
        <input type="hidden" id="id" name="id" value="<?= $cliente->id ?>">
        <div class="form-group">
          <label for="idFiscal">Introduce el id Fiscal</label>
          <input type="number" value="<?= $cliente->idFiscal ?>" class=" form-control" id="idFiscal" name="idFiscal" placeholder="Introduce tu id Fiscal">
        </div>

        <div class="form-group">
          <label for="contact_name">Persona de contacto</label>
          <input type="text" value="<?= $cliente->contact_name ?>" class="form-control" id="contact_name" name="contact_name" placeholder="Introduce el nombre del contacto de la empresa">
        </div>

        <div class="form-group">
          <label for="company_name">Nombre de empresa</label>
          <input type="text" value="<?= $cliente->company_name ?>" class="form-control" id="company_name" name="company_name" placeholder="Introduce el nombre de empresa">
        </div>

        <div class="form-group">
          <label for="contact_email">Email del contacto en la empresa</label>
          <input type="text" value="<?= $cliente->contact_email ?>" class="form-control" id="contact_email" name="contact_email" placeholder="Introduce el email del contacto de la empresa">
        </div>

        <div class="form-group">
          <label for="contact_phone_number">Numero de telefono de contacto en la empresa</label>
          <input type="number" value="<?= $cliente->contact_phone_number ?>" class="form-control" id="contact_phone_number" name="contact_phone_number" placeholder="Introduce el número de telefono de la persona de contacto">
        </div>

        <div class="form-group">
          <label for="company_address">Dirección de la empresa</label>
          <input type="text" value="<?= $cliente->company_address ?>" class="form-control" id="company_address" name="company_address" placeholder="Introduce la dirección de la empresa">
        </div>

        <div class="form-group">
          <label for="company_phone_number">Introduce el numero de la empresa</label>
          <input type="number" value="<?= $cliente->company_phone_number ?>" class="form-control" id="company_phone_number" name="company_phone_number" placeholder="Introduce el número de telefono de la empresa">
        </div>

        

        <button type="submit" class="btn btn-primary">Guardar</button>
        <a class="btn btn-danger" href="index.php?tabla=client&accion=listar">Cancelar</a>
      </form>
    <?php
    } else {
    ?>
      <a href="index.php" class="btn btn-primary">Volver a Inicio</a>
    <?php
    }
    ?>
  </div>
</main>