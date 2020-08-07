<?php
include "../../config.php";
include "../../utils.php";


$dbConn =  connect($db);

/*
  listar todos los posts o solo uno
 */
if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
    if (isset($_GET['id_detallepregunta']))
    {
        //Mostrar un post
        $sql = $dbConn->prepare("SELECT * FROM detallepregunta where id_detallepregunta=:id_detallepregunta");
        $sql->bindValue(':id_detallepregunta', $_GET['id_detallepregunta']);
        $sql->execute();
        header("HTTP/1.1 200 OK");
        echo json_encode(  $sql->fetch(PDO::FETCH_ASSOC)  );
        exit();
    }
    else {
    
        //Mostrar lista de post
        $sql = $dbConn->prepare("SELECT * FROM detallepregunta");
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
    $sql = "INSERT INTO detallepregunta
          (puntaje, id_pregunta)
          VALUES
          (:puntaje, :id_pregunta)";
    $statement = $dbConn->prepare($sql);
    bindAllValues($statement, $input);
    $statement->execute();
    $postId = $dbConn->lastInsertId();
    if($postId)
    {
        $input['id_detallepregunta'] = $postId;
        $mensaje = "se guardo el detalle pregunta correctamente";
        header("HTTP/1.1 200 OK");
        echo json_encode($mensaje);
        exit();
    }
}

//Borrar
if ($_SERVER['REQUEST_METHOD'] == 'DELETE')
{
    $id = $_GET['id_detallepregunta'];
    $statement = $dbConn->prepare("DELETE FROM detallepregunta where id_detallepregunta=:id_detallepregunta");
    $statement->bindValue(':id_detallepregunta', $id);
    $statement->execute();
    header("HTTP/1.1 200 OK");
    exit();
}

//Actualizar
// PARA EL PUT LOS DATOS SE ENVIAN DE MANERA DIFERENTE EJEMPLO:http://localhost/WebAPITREVA_V1/usuario.php?id_usuario=2&correo=jpastor123@gmail.com
if ($_SERVER['REQUEST_METHOD'] == 'PUT')
{
    $input = $_GET;
    $postId = $input['id_detallepregunta'];
    $fields = getParams($input);

    $sql = "UPDATE detallepregunta
          SET $fields
          WHERE id_detallepregunta='$postId'
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