<?php
include "../../config.php";
include "../../utils.php";


$dbConn =  connect($db);

/*
  listar todos los posts o solo uno
 */

if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
    if (isset($_GET['id_formulario']))
    {
        //Mostrar un post
        $sql = $dbConn->prepare("SELECT * FROM formulario where id_formulario=:id_formulario");
        $sql->bindValue(':id_formulario', $_GET['id_formulario']);
        $sql->execute();
        header("HTTP/1.1 200 OK");
        echo json_encode(  $sql->fetch(PDO::FETCH_ASSOC)  );
        exit();
    }
    else {
		if(isset($_GET['id_usuario']))
		{
		//mostrar los formularios de un usuario por id
		$sql = $dbConn->prepare("SELECT * FROM formulario where id_usuario=:id_usuario order by fecha DESC");
			 $sql->bindValue(':id_usuario', $_GET['id_usuario']);
        $sql->execute();
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 OK");
          echo json_encode( $sql->fetchAll()  );
        exit();
		}else{
        //Mostrar lista de post
        $sql = $dbConn->prepare("SELECT * FROM formulario");
        $sql->execute();
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 OK");
        echo json_encode( $sql->fetchAll()  );
        exit();
		}
    }
}

// Crear un nuevo post
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $input = $_POST;
    $sql = "INSERT INTO formulario
          (titulo, descripcion, estado, link, fecha, hora, id_usuario)
          VALUES
          (:titulo, :descripcion, :estado, :link, :fecha, :hora, :id_usuario)";
    $statement = $dbConn->prepare($sql);
    bindAllValues($statement, $input);
    $statement->execute();
    $postId = $dbConn->lastInsertId();
    if($postId)
    {
        $input['id_formulario'] = $postId;
        header("HTTP/1.1 200 OK");
        echo json_encode($input);
        exit();
    }
}

//Borrar
if ($_SERVER['REQUEST_METHOD'] == 'DELETE')
{
    $id = $_GET['id_formulario'];
    $statement = $dbConn->prepare("DELETE FROM formulario where id_formulario=:id_formulario");
    $statement->bindValue(':id_formulario', $id);
    $statement->execute();
    header("HTTP/1.1 200 OK");
    exit();
}

//Actualizar
// PARA EL PUT LOS DATOS SE ENVIAN DE MANERA DIFERENTE EJEMPLO:http://localhost/WebAPITREVA_V1/usuario.php?id_usuario=2&correo=jpastor123@gmail.com
if ($_SERVER['REQUEST_METHOD'] == 'PUT')
{
    $input = $_GET;
    $postId = $input['id_formulario'];
    $fields = getParams($input);

    $sql = "UPDATE formulario
          SET $fields
          WHERE id_formulario='$postId'
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
