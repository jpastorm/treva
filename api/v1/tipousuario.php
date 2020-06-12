<?php
include "../../config.php";
include "../../utils.php";


$dbConn =  connect($db);

$_POST = json_decode(file_get_contents("php://input"), true);
/*
  listar todos los posts o solo uno
 */
if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
    if (isset($_GET['id_tipousuario']))
    {
        //Mostrar un post
        $sql = $dbConn->prepare("SELECT * FROM tipousuario where id_tipousuario=:id_tipousuario");
        $sql->bindValue(':id_tipousuario', $_GET['id_tipousuario']);
        $sql->execute();
        header("HTTP/1.1 200 OK");
        echo json_encode(  $sql->fetch(PDO::FETCH_ASSOC)  );
        exit();
    }
    else {
        //Mostrar lista de post
        $sql = $dbConn->prepare("SELECT * FROM tipousuario");
        $sql->execute();
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 OK");
        echo json_encode( $sql->fetchAll()  );
        exit();
    }
}

// Crear un nuevo post
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $input = $_POST;
    $sql = "INSERT INTO tipousuario
          (id_tipousuario, descripcion)
          VALUES
          (:id_tipousuario, :descripcion)";
    $statement = $dbConn->prepare($sql);
    bindAllValues($statement, $input);
    $statement->execute();
    $postId = $dbConn->lastInsertId();
    if( $postId = $input['id_tipousuario'])
    {       
        header("HTTP/1.1 200 OK");
        echo json_encode($input);
        exit();
    }
}

//Borrar
if ($_SERVER['REQUEST_METHOD'] == 'DELETE')
{
    $id = $_GET['id_tipousuario'];
    $statement = $dbConn->prepare("DELETE FROM tipousuario where id_tipousuario=:id_tipousuario");
    $statement->bindValue(':id_tipousuario', $id);
    $statement->execute();
    header("HTTP/1.1 200 OK");
    exit();
}

//Actualizar
// PARA EL PUT LOS DATOS SE ENVIAN DE MANERA DIFERENTE EJEMPLO:http://localhost/WebAPITREVA_V1/usuario.php?id_usuario=2&correo=jpastor123@gmail.com
if ($_SERVER['REQUEST_METHOD'] == 'PUT')
{
    $input = $_GET;
    $postId = $input['id_tipousuario'];
    $fields = getParams($input);

    $sql = "UPDATE tipousuario
          SET $fields
          WHERE id_tipousuario='$postId'
           ";

    $statement = $dbConn->prepare($sql);
    bindAllValues($statement, $input);

    $statement->execute();
    header("HTTP/1.1 200 OK");
    exit();
}


//En caso de que ninguna de las opciones anteriores se haya ejecutado
header("HTTP/1.1 400 Bad Request");

?>