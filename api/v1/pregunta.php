<?php
include "../../config.php";
include "../../utils.php";


$dbConn =  connect($db);

/*
  listar todos los posts o solo uno
 */
if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
    if (isset($_GET['id_pregunta']))
    {
        //Mostrar un post
        $sql = $dbConn->prepare("SELECT * FROM pregunta where id_pregunta=:id_pregunta");
        $sql->bindValue(':id_pregunta', $_GET['id_pregunta']);
        $sql->execute();
        header("HTTP/1.1 200 OK");
        echo json_encode(  $sql->fetch(PDO::FETCH_ASSOC)  );
        exit();
    }
    else {
        //Mostrar lista de post
        $sql = $dbConn->prepare("SELECT * FROM pregunta");
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
    $sql = "INSERT INTO pregunta
          (descripcion, id_formulario)
          VALUES
          (:descripcion, :id_formulario)";
    $statement = $dbConn->prepare($sql);
    bindAllValues($statement, $input);
    $statement->execute();
    $postId = $dbConn->lastInsertId();
    if($postId)
    {
        $input['id_pregunta'] = $postId;
        header("HTTP/1.1 200 OK");
        echo json_encode($input);
        exit();
    }
}

//Borrar
if ($_SERVER['REQUEST_METHOD'] == 'DELETE')
{
    $id = $_GET['id_pregunta'];
    $statement = $dbConn->prepare("DELETE FROM pregunta where id_pregunta=:id_pregunta");
    $statement->bindValue(':id_pregunta', $id);
    $statement->execute();
    header("HTTP/1.1 200 OK");
    exit();
}

//Actualizar
// PARA EL PUT LOS DATOS SE ENVIAN DE MANERA DIFERENTE EJEMPLO:http://localhost/WebAPITREVA_V1/usuario.php?id_usuario=2&correo=jpastor123@gmail.com
if ($_SERVER['REQUEST_METHOD'] == 'PUT')
{
    $input = $_GET;
    $postId = $input['id_pregunta'];
    $fields = getParams($input);

    $sql = "UPDATE pregunta
          SET $fields
          WHERE id_pregunta='$postId'
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