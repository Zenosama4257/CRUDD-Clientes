<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h3">Añadir Cliente</h1>
  </div>
  <div id="contenido">
    <?php
    $cadena = (isset($_REQUEST["error"])) ? "Error, ha fallado la inserción" : "";
    $visibilidad = (isset($_REQUEST["error"])) ? "visible" : "invisible";
    ?>
    <div class="alert alert-danger <?= $visibilidad ?>"><?= $cadena ?></div>
    <form action="index.php?tabla=client&accion=guardar&evento=crear" method="POST">

      <div class="form-group">
        <label for="idFiscal">Introduce el id Fiscal</label>
        <input type="number" class="form-control" id="idFiscal" name="idFiscal" placeholder="Introduce tu id Fiscal">
      </div>

      <div class="form-group">
        <label for="contact_name">Persona de contacto</label>
        <input type="text" class="form-control" id="contact_name" name="contact_name" placeholder="Introduce el nombre del contacto de la empresa">
      </div>

      <div class="form-group">
        <label for="company_name">Nombre de empresa</label>
        <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Introduce el nombre de empresa">
      </div>

      <div class="form-group">
        <label for="contact_email">Email del contacto en la empresa</label>
        <input type="text" class="form-control" id="contact_email" name="contact_email" placeholder="Introduce el email del contacto de la empresa">
      </div>

      <div class="form-group">
        <label for="contact_phone_number">Numero de telefono de contacto en la empresa</label>
        <input type="number" class="form-control" id="contact_phone_number" name="contact_phone_number" placeholder="Introduce el número de telefono de la persona de contacto">
      </div>

      <div class="form-group">
        <label for="company_address">Dirección de la empresa</label>
        <input type="text" class="form-control" id="company_addres" name="company_addres" placeholder="Introduce la dirección de la empresa">
      </div>

      <div class="form-group">
        <label for="company_phone_number">Introduce el numero de la empresa</label>
        <input type="number" class="form-control" id="company_phone_number" name="company_phone_number" placeholder="Introduce el número de telefono de la empresa">
      </div>

      

      <button type="submit" class="btn btn-primary">Guardar</button>
      <a class="btn btn-danger" href="index.php">Cancelar</a>
    </form>
  </div>
</main>