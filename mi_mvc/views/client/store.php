<?php
require_once "controllers/clientsController.php";
//recoger datos
if (!isset ($_REQUEST["cliente"])){
   header('Location:index.php?tabla=client&accion=crear' );
   exit();
}

$id= ($_REQUEST["id"])??"";//el id me servirá en editar

$arrayCliente=[    
                "id"=>$id,
                "idFiscal"=>$_REQUEST["idFiscal"],
                "contact_phone_number"=>$_REQUEST["contact_phone_number"],
                "contact_name"=>$_REQUEST["contact_name"],
                "contact_email"=>$_REQUEST["contact_email"],
                "company_phone_number"=>$_REQUEST["company_phone_number"],
                "company_name"=>$_REQUEST["company_name"],
                "company_address"=>$_REQUEST["company_address"],

                ];

//pagina invisible
$controlador= new clientsController();

if ($_REQUEST["evento"]=="crear"){
    $controlador->crear ($arrayCliente);
}

if ($_REQUEST["evento"]=="modificar"){
    $controlador->editar ($id, $arrayCliente);
}