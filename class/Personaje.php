<?php

class Personaje
{

    protected $id;
    protected $nombre;
    protected $alias;
    protected $biografia;
    protected $creador;
    protected $primera_aparicion;
    protected $imagen;

    /**
     * Devuelve el listado completo de personajes en sistema
     */
    public function lista_completa(): array
    {

        $resultado = [];

        $conexion = (new Conexion())->getConexion();
        $query = "SELECT * FROM personajes";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute();

        $resultado = $PDOStatement->fetchAll();

        return $resultado;
    }

    public function insert()
    {
        $conexion = (new Conexion())->getConexion();
        $query = "INSERT INTO `personajes` (`id`, `nombre`, `alias`, `biografia`, `creador`, `primera_aparicion`, `imagen`) VALUES (NULL, 'asd', 'asd', 'asd', 'asd', '1990', 'asdasd');";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute();
    }
}
