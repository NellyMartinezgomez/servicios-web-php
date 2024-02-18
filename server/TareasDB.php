<?php

class TareasDB

protected $mysqli;
    
const LOCALHOST = 'localhost';
const USER      = 'root';
const PASSWORD  = '';
const DATABASE  = 'agenda';

/*
 *  Constructor de clase inicializada la variable mysqli
 */
public function __construct()
{
    try{
        $this->mysqli = new mysqli(self::LOCALHOST, self::USER, self::PASSWORD, self::DATABASE);
    }catch(mysqli_sql_exception $e){
        http_response_code(500);
        exit;
    }
}
/*
 * Funcion que retorna un registro por medio de una id
 */
public function getOneById($id = 0)
{
    // Se prepara la consulta con prepare por medio de la conexion que tenemos
    $sql = '
        SELECT
            *
        FROM
            tareas
        WHERE
            id = ?
    ';
    
    $stmt = $this->mysqli->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    
    $result = $stmt->get_result();
    $tarea  = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    
    return $tarea;
}