<?php
require_once "models/clientModel.php";

class clientsController { 
    private $model;

    public function __construct(){
        $this->model = new clientModel();
    }

    public function crear (array $arrayCliente):void {
        $id=$this->model->insert ($arrayCliente);
        ($id==null)?header("location:index.php?tabla=client&accion=crear&error=true&id={$id}"): header("location:index.php?tabla=client&accion=ver&id=".$id);
        exit ();
    }
    public function ver(int $id): ?stdClass
    {
        return $this->model->read($id);
    }
    public function listar ():array{
        return $this->model->readAll ();
   }
   public function borrar(int $id): void
{
    $cliente=$this->ver($id);
    $borrado = $this->model->delete($id);
    $redireccion = "location:index.php?accion=listar&tabla=client&evento=borrar&id={$id}&company_name={$cliente->company_name}&contact_phone_number={$cliente->contact_phone_number}";
    
    if ($borrado == false) $redireccion .=  "&error=true";
    header($redireccion);
    exit();
}
public function editar (int $id, array $arrayCliente):void {
    $editadoCorrectamente=$this->model->edit ($id, $arrayCliente);
    //lo separo para que se lea mejor en el word
    $redireccion="location:index.php?tabla=client&accion=editar";
    $redireccion.="&evento=modificar&id={$id}&company_name={$arrayCliente["company_name"]}&contact_phone_number={$arrayCliente["contact_phone_number"]}";
    $redireccion.=($editadoCorrectamente==false)?"&error=true":"";
    //vuelvo a la pagina donde estaba
    header ($redireccion);
    exit();
    }
    public function buscar (string $cliente):array {
        return $this->model->search ($cliente);
     }

}