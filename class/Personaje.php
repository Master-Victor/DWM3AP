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

    /**
     * Inserta un nuevo personaje a la base de datos
     * @param string $nombre
     * @param string $alias
     * @param string $creador Creador o creadores del personaje, separados por comas
     * @param int $primera_aparicion El año en el que el personaje hizo su primera aparición (4 dígitos)
     * @param string $biografia 
     * @param string $imagen ruta a un archivo .jpg o .png 
     */
    public function insert($nombre, $alias, $creador, $primera_aparicion, $biografia, $imagen)
    {
        $conexion = (new Conexion())->getConexion();
        $query = "INSERT INTO `personajes` (`id`, `nombre`, `alias`, `biografia`, `creador`, `primera_aparicion`, `imagen`) VALUES (NULL, :nombre, :alias, :biografia,:creador, :primera_aparicion, :imagen);";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute([
            'nombre' => $nombre,
            'alias' => $alias,
            'biografia' => $biografia,
            'creador' => $creador,
            'primera_aparicion' => $primera_aparicion,
            'imagen' => $imagen,
        ]);
    }

    /**
     * Devuelve los datos de un personaje en particular
     * @param int $id El ID único del personaje 
     */
    public function get_x_id(int $id): ?Personaje
    {
        $conexion = (new Conexion())->getConexion();
        $query = "SELECT * FROM personajes WHERE id = :id";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute([
            'id' => $id
        ]);

        $resultado = $PDOStatement->fetch();

        if(!$resultado){
            return null;
        }

        return $resultado;

    }   
    /**
     * Edita un personaje a la base de datos
     * @param string $nombre
     * @param string $alias
     * @param string $creador Creador o creadores del personaje, separados por comas
     * @param int $primera_aparicion El año en el que el personaje hizo su primera aparición (4 dígitos)
     * @param string $biografia 
     * @param string $imagen ruta a un archivo .jpg o .png 
     * @param int $id El ID único del personaje
     */ 
    public function edit($nombre, $alias, $creador, $primera_aparicion, $biografia, $imagen, $id)
    {
        $conexion = (new Conexion())->getConexion();
        $query = "UPDATE `personajes` SET `nombre` = '$nombre', `alias` = '$alias', `biografia` = '$biografia', `creador` = '$creador', `primera_aparicion` = '$primera_aparicion', `imagen` = '$imagen' WHERE `personajes`.`id` = $id";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute();
    }

    public function delete($id)
    {
        $conexion = (new Conexion())->getConexion();
        $query = "DELETE FROM `personajes` WHERE `personajes`.`id` = :id";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute([
            'id' => $id
        ]);
    }

    /**
     * Get the value of nombre
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     */
    public function setNombre($nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of biografia
     */
    public function getBiografia()
    {
        return $this->biografia;
    }

    /**
     * Set the value of biografia
     */
    public function setBiografia($biografia): self
    {
        $this->biografia = $biografia;

        return $this;
    }

    /**
     * Get the value of creador
     */
    public function getCreador()
    {
        return $this->creador;
    }

    /**
     * Set the value of creador
     */
    public function setCreador($creador): self
    {
        $this->creador = $creador;

        return $this;
    }

    /**
     * Get the value of primera_aparicion
     */
    public function getPrimeraAparicion()
    {
        return $this->primera_aparicion;
    }

    /**
     * Set the value of primera_aparicion
     */
    public function setPrimeraAparicion($primera_aparicion): self
    {
        $this->primera_aparicion = $primera_aparicion;

        return $this;
    }

    /**
     * Get the value of imagen
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * Set the value of imagen
     */
    public function setImagen($imagen): self
    {
        $this->imagen = $imagen;

        return $this;
    }

    /**
     * Get the value of alias
     */
    public function getAlias()
    {
        return $this->alias;
    }
}
