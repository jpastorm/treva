<?php
include "../../config.php";
include "../../utils.php";


$dbConn =  connect($db);

$_POST = json_decode(file_get_contents("php://input"), true);

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';


/*
  listar todos los posts o solo uno
 */
if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
    if (isset($_GET['id_usuario']))
    {

      //Mostrar un post
      $sql = $dbConn->prepare("SELECT * FROM usuario where id_usuario=:id_usuario");
      $sql->bindValue(':id_usuario', $_GET['id_usuario']);
      $sql->execute();
      header("HTTP/1.1 200 OK");
      echo json_encode(  $sql->fetch(PDO::FETCH_ASSOC)  );
      exit();
	  }
    else {
      //Mostrar lista de post
      $sql = $dbConn->prepare("SELECT * FROM usuario");
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
  $opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
    switch (opcion){
      case 1:

        $input = $_POST;
        $sql = "INSERT INTO usuario
        (nombre, apellido_pat, apellido_mat, correo,
        usuario, contrasenia, celular, id_tipousuario)
        VALUES
        (:nombre, :apellido_pat, :apellido_mat, :correo,
        :usuario, :contrasenia, :celular, :id_tipousuario)";
        $statement = $dbConn->prepare($sql);
        bindAllValues($statement, $input);
        $statement->execute();
        $postId = $dbConn->lastInsertId();

        if($postId)
        {
          $input['id_usuario'] = $postId;
          header("HTTP/1.1 200 OK");
          echo json_encode($input);
          exit();
        }

        break;  
      case 2:

        if( isset($_POST['id_usuario']) && isset($_POST['usuario']) ){
          $myObj->estado = 'TRUE';
          $myObj->mensaje = "Lo que sea";
          echo json_encode($myObj);
          session_start();
          $_SESSION["id_usuario"]=$id_usuario;
          $_SESSION["usuario"]=$usuario;
        }else{
          $myObj->estado = 'FALSE';
          $myObj->mensaje = "Lo que no sea";
          echo json_encode($myObj);
        }
        break;
    }
    
    
}

//Borrar
if ($_SERVER['REQUEST_METHOD'] == 'DELETE')
{
	$id = $_GET['id_usuario'];
  $statement = $dbConn->prepare("DELETE FROM usuario where id_usuario=:id_usuario");
  $statement->bindValue(':id_usuario', $id);
  $statement->execute();
	header("HTTP/1.1 200 OK");
	exit();
}

//Actualizar
// PARA EL PUT LOS DATOS SE ENVIAN DE MANERA DIFERENTE EJEMPLO:http://localhost/WebAPITREVA_V1/usuario.php?id_usuario=2&correo=jpastor123@gmail.com
if ($_SERVER['REQUEST_METHOD'] == 'PUT')
{
    $input = $_GET;
    $postId = $input['id_usuario'];
    $fields = getParams($input);

    $sql = "UPDATE usuario
          SET $fields
          WHERE id_usuario='$postId'
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