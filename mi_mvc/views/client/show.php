<?php
require_once "controllers/clientsController.php";
if (!isset($_REQUEST['id'])) {
    header("location:index.php");
    exit();
    // si no ponemos exit despues de header redirecciona al finalizar la pagina 
    // ejecutando el código que viene a continuación, aunque no llegues a verlo
    // No poner exit puede provocar acciones no esperadas dificiles de depurar
}
$id = $_REQUEST['id'];
$controlador = new clientsController();
$client = $controlador->ver($id);
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Ver datos del Cliente</h1>
    </div>
    <div id="contenido">
        <div class="card"  style="width: 18rem;">
            <div >
                <h5 class="card-title">ID: <?= $client->id ?> <br>NOMBRE: <?= $client->name ?></h5>
                <p class="card-text">
                    ID: <?= $client->id ?> <br>
                    Numero Fiscal: <?= $client->idFiscal ?><br>
                    Email del contacto: <?= $client->contact_email ?><br>
                    Nombre del contacto: <?= $client->contact_name ?><br>
                    Nº de telefono del contacto: <?= $client->contact_phone_number ?><br>
                    Nombre de la empresa: <?= $client->company_name ?><br>
                    Direccion de la empresa:<?= $client->company_address ?><br>
                    Numero de telefono de la empresa:  <?= $client->company_phone_number ?><br>

                </p>
                <a href="index.php" class="btn btn-primary">Volver a Inicio</a>
            </div>
        </div>
</main>