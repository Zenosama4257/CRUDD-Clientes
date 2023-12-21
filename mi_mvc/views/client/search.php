<?php
require_once "controllers/clientsController.php";

$mensaje = "";
$clase = "alert alert-success";
$visibilidad = "hidden";
$mostrarDatos = false;
$controlador = new clientsController();
$cliente = "";

if (isset($_REQUEST["evento"])) {
    $mostrarDatos = true;
    switch ($_REQUEST["evento"]) {
        case "todos":
            $clients = $controlador->listar();
            $mostrarDatos = true;
            break;
        case "filtrar":
            $cliente = ($_REQUEST["busqueda"]) ?? "";
            $clients = $controlador->buscar($cliente);
            break;
        case "borrar":
            $visibilidad = "visibility";
            $mostrarDatos = true;
            $clase = "alert alert-success";
            //Mejorar y poner el nombre/usuario
            $mensaje = "El cliente con id: {$_REQUEST['id']} Borrado correctamente";
            if (isset($_REQUEST["error"])) {
                $clase = "alert alert-danger ";
                $mensaje = "ERROR!!! No se ha podido borrar el cliente con id: {$_REQUEST['id']}";
            }
            break;
    }
} ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Buscar Cliente</h1>
    </div>
    <div id="contenido">
        <div class="<?= $clase ?>" <?= $visibilidad ?> role="alert">
            <?= $mensaje ?>
        </div>
        <div>
        <form action="index.php?tabla=client&accion=buscar&evento=filtrar" method="POST">
            <div class="form-group">
                <label for="idFiscal">Buscar Cliente</label>
                <input type="number" required class="form-control" id="busqueda" name="busqueda" value="<?= $cliente ?>" placeholder="Buscar por Numero Fiscal">
            </div>
            <button type="submit" class="btn btn-success" name="Filtrar"><i class="fas fa-search"></i> Buscar</button>
        </form>
        <!-- Este formulario es para ver todos los datos    -->
        <form action="index.php?tabla=client&accion=buscar&evento=todos" method="POST">
            <button type="submit" class="btn btn-info" name="Todos"><i class="fas fa-list"></i> Listar</button>
        </form>
        </div>
        <?php
        if ($mostrarDatos) {
        ?>
            <table class="table table-light table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nº FISCAL</th>
                            <th scope="col">Nombre Empresa</th>
                            <th scope="col">Direccion de la Empresa</th>
                            <th scope="col">Número de telefono de la Empresa</th>
                            <th scope="col">Eliminar</th>
                            <th scope="col">Editar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($clients as $client) :
                            $id = $client->id;
                        ?>
                            <tr>
                                <th scope="row"><?= $client->id ?></th>
                                <td><?= $client->idFiscal ?></td>
                                <td><?= $client->company_name ?></td>
                                <td><?= $client->company_addres ?></td>
                                <td><?= $client->company_phone_number ?></td>

                                <td><a class="btn btn-danger" href="index.php?tabla=client&accion=borrar&id=<?= $id ?>"><i class="fa fa-trash"></i> Borrar</a></td>
                                <td><a class="btn btn-success" href="index.php?tabla=client&accion=editar&id=<?= $id ?>"><i class="fas fa-pencil-alt"></i> Editar</a></td>
                            </tr>
                        <?php
                        endforeach;


                        ?>
                    </tbody>
                </table>
        <?php
        }
        ?>
    </div>
</main>