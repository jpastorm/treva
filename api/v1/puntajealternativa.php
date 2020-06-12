<?php
include "../../config.php";
include "../../utils.php";


$dbConn =  connect($db);

/*
  listar todos los posts o solo uno
 */
if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
    if (isset($_GET['id_puntajealt']))
    {
        //Mostrar un post
        $sql = $dbConn->prepare("SELECT * FROM puntajealternativa where id_puntajealt=:id_puntajealt");
        $sql->bindValue(':id_puntajealt', $_GET['id_puntajealt']);
        $sql->execute();
        header("HTTP/1.1 200 OK");
        echo json_encode(  $sql->fetch(PDO::FETCH_ASSOC)  );
        exit();
    }
    else {
        //Mostrar lista de post
        $sql = $dbConn->prepare("SELECT * FROM puntajealternativa");
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
    $sql = "INSERT INTO puntajealternativa
          (id_alternativa)
          VALUES
          (:id_alternativa)";
    $statement = $dbConn->prepare($sql);
    bindAllValues($statement, $input);
    $statement->execute();
    $postId = $dbConn->lastInsertId();
    if($postId)
    {
        $input['id_puntajealt'] = $postId;
        header("HTTP/1.1 200 OK");
        echo json_encode($input);
        exit();
    }
}

//Borrar
if ($_SERVER['REQUEST_METHOD'] == 'DELETE')
{
    $id = $_GET['id_puntajealt'];
    $statement = $dbConn->prepare("DELETE FROM puntajealternativa where id_puntajealt=:id_puntajealt");
    $statement->bindValue(':id_puntajealt', $id);
    $statement->execute();
    header("HTTP/1.1 200 OK");
    exit();
}

//Actualizar
// PARA EL PUT LOS DATOS SE ENVIAN DE MANERA DIFERENTE EJEMPLO:http://localhost/WebAPITREVA_V1/usuario.php?id_usuario=2&correo=jpastor123@gmail.com
if ($_SERVER['REQUEST_METHOD'] == 'PUT')
{
    $input = $_GET;
    $postId = $input['id_puntajealt'];
    $fields = getParams($input);

    $sql = "UPDATE puntajealternativa
          SET $fields
          WHERE id_puntajealt='$postId'
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
