SELECT * FROM categoria;
SELECT * FROM detallepregunta;
SELECT * FROM formulario;
SELECT * FROM plazodeentrega;
SELECT * FROM pregunta;
SELECT * FROM tipousuario;
SELECT * FROM usuario;

# Consulta de puntaje de cada formulario
SELECT p.id_pregunta,p.descripcion,d.puntaje FROM pregunta AS p
INNER JOIN detallepregunta AS d ON d.id_pregunta = p.id_pregunta;

# Consulta de los nombre de los usuarios que crearon el formulario
SELECT f.titulo, f.descripcion, f.estado, f.link, f.fecha, f.hora, CONCAT(u.nombre," ",u.apellido_pat," ",u.apellido_mat) AS "Usuario" FROM formulario AS f
INNER JOIN usuario AS u ON u.id_usuario = f.id_usuario;

# contamos el numero de formulario realizados por usuario
SELECT f.titulo, f.descripcion, f.estado, f.link, f.fecha, f.hora, CONCAT(u.nombre," ",u.apellido_pat," ",u.apellido_mat) AS "Usuario",COUNT(*) AS "NUMERO DE FORMULARIOS" FROM formulario AS f
INNER JOIN usuario AS u ON u.id_usuario = f.id_usuario GROUP BY u.nombre;

# Consulta de puntaje de un formulario especifico
SELECT p.id_pregunta,p.descripcion,count(d.puntaje) AS 'Puntaje',
CASE
    WHEN d.puntaje = 1 THEN 'Malo'
    WHEN d.puntaje = 2 THEN 'Insuficiente'
    WHEN d.puntaje = 3 THEN 'Regular'
    WHEN d.puntaje = 4 THEN 'Bueno'
    WHEN d.puntaje = 5 THEN 'Excelente'
END
AS 'Opciones'
FROM pregunta AS p
INNER JOIN detallepregunta AS d ON d.id_pregunta = p.id_pregunta
INNER JOIN formulario AS f ON f.id_formulario = p.id_formulario
WHERE f.id_formulario = 1 AND p.id_pregunta = 6
GROUP BY d.puntaje
ORDER BY d.puntaje;

#CONSULTA DE PREGUNTAS POR FORMULARIO
SELECT COUNT(id_pregunta) AS 'Numero' FROM pregunta
WHERE id_formulario = 1

#TOTAL DE RESPUESTAS
SELECT COUNT(d.id_detallepregunta) AS 'Participantes' FROM detallepregunta AS d
INNER JOIN pregunta AS p ON p.id_pregunta = d.id_pregunta
WHERE p.id_formulario = 1 

# Consulta de puntaje de un formulario especifico
SELECT p.id_pregunta,p.descripcion,count(d.puntaje) AS 'Puntaje',
CASE
    WHEN d.puntaje = 1 THEN 'Malo'
    WHEN d.puntaje = 2 THEN 'Insuficiente'
    WHEN d.puntaje = 3 THEN 'Regular'
    WHEN d.puntaje = 4 THEN 'Bueno'
    WHEN d.puntaje = 5 THEN 'Excelente'
END
AS 'Opciones',
CASE 
	WHEN d.puntaje = 1 THEN 'rgb(242,28,27)'
	WHEN d.puntaje = 2 THEN 'rgb(234,86,21)'
	WHEN d.puntaje = 3 THEN 'rgb(249,184,16)'
	WHEN d.puntaje = 4 THEN 'rgb(124,202,83)'
	WHEN d.puntaje = 5 THEN 'rgb(76,183,19)'
END
AS 'Colores'
FROM pregunta AS p
INNER JOIN detallepregunta AS d ON d.id_pregunta = p.id_pregunta
INNER JOIN formulario AS f ON f.id_formulario = p.id_formulario
WHERE f.id_formulario = 1 AND p.id_pregunta = 1
GROUP BY d.puntaje
ORDER BY d.puntaje;

#TOTAL DE RESPUESTAS
SELECT d.id_detallepregunta,p.descripcion,d.puntaje AS 'Puntaje',d.id_pregunta FROM detallepregunta AS d
INNER JOIN pregunta AS p ON p.id_pregunta = d.id_pregunta
WHERE p.id_formulario = 1

#CONSULTA DE PREGUNTAS POR FORMULARIO
SET @numero=0;
SELECT id_pregunta AS 'Numero',@numero:=@numero+1 AS 'Posicion' FROM pregunta
WHERE id_formulario = 1;

SELECT COUNT(id_pregunta) AS 'Total' FROM pregunta
WHERE id_formulario = 1;
