<?php
require_once('config/db.php');

class ClientModel
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = db::conexion();
    }

    public function insert(array $client): ?int //devuelve entero o null
    {
        try{

        
        $sql = "INSERT INTO clients(idFiscal, contact_name, contact_email , contact_phone_number , company_email)  VALUES (?, ?, ?, ?,?);";
        $sentencia = $this->conexion->prepare($sql);
        $arrayDatos = [
            $client["idFiscal"],
            $client["contact_name"],
            $client["contact_email"],
            $client["contact_phone_number"],
            $client["company_email"],

        ];
        $resultado = $sentencia->execute($arrayDatos);

        /*Pasar en el mismo orden de los ? execute devuelve un booleano. 
        True en caso de que todo vaya bien, falso en caso contrario.*/
        //Así podriamos evaluar
        return ($resultado == true) ? $this->conexion->lastInsertId() : null;
        }catch (Exception $e) {
            echo 'Excepción capturada: ',  $e->getMessage(), "<bR>";
            return null;
        }
    }
    public function read(int $id): ?stdClass
    {
        $sentencia = $this->conexion->prepare("SELECT * FROM clients WHERE id=:id");
        $arrayDatos = [":id" => $id];
        $resultado = $sentencia->execute($arrayDatos);
        // ojo devuelve true si la consulta se ejecuta correctamente
        // eso no quiere decir que hayan resultados
        if (!$resultado) return null;
        //como sólo va a devolver un resultado uso fetch
        // DE Paso probamos el FETCH_OBJ
        $client = $sentencia->fetch(PDO::FETCH_OBJ);
      
        //fetch duevelve el objeto stardar o false si no hay persona
        return ($client == false) ? null : $client;
    }

    public function readAll():array 
{
    $sentencia = $this->conexion->query("SELECT * FROM clients;");
//usamos método query
    $clients = $sentencia->fetchAll(PDO::FETCH_OBJ);    
    return $clients;
 }

public function delete (int $id):bool
{
    $sql="DELETE FROM clients WHERE id =:id";
    try {
        $sentencia = $this->conexion->prepare($sql);
        //devuelve true si se borra correctamente
        //false si falla el borrado
        $resultado= $sentencia->execute([":id" => $id]);
        return ($sentencia->rowCount ()<=0)?false:true;
    }  catch (Exception $e) {
        echo 'Excepción capturada: ',  $e->getMessage(), "<bR>";
        return false;
    }
}

public function edit (int $idFiscal, array $arrayCliente):bool{
    try {
            $sql="UPDATE clients SET idFiscal = :$idFiscal, contact_email=:contact_email, ";
            $sql.= "contact_name = :contact_name, contact_phone_number= :contact_phone_number, company_email=:company_email ";
            $sql.= " WHERE id = :id;";
            $arrayDatos=[
                    ":idFiscal"=>$idFiscal,
                    ":contact_email"=>$arrayCliente["contact_email"],
                    ":contact_name"=>$arrayCliente["contact_name"],
                    ":contact_phone_number"=>$arrayCliente["contact_phone_number"],
                    ":company_email"=>$arrayCliente["company_email"],
                    ];
            $sentencia = $this->conexion->prepare($sql);
            return $sentencia->execute($arrayDatos); 

            

    } catch (Exception $e) {
            echo 'Excepción capturada: ',  $e->getMessage(), "<br>";
            return false;
            }
}

public function search (string $idFiscal):array{
    $sentencia = $this->conexion->prepare("SELECT * FROM clients WHERE ifFiscal LIKE :idFiscal");
    //ojo el si ponemos % siempre en comillas dobles "
    $arrayDatos=[":idFiscal"=>"%$idFiscal%" ];
    $resultado = $sentencia->execute($arrayDatos);
    if (!$resultado) return [];
    $clients = $sentencia->fetchAll(PDO::FETCH_OBJ); 
    return $clients; 
    }
}
