<?PHP

class Serie
{
    protected $id;
    protected $nombre;
    protected $historia;


    /**
     * Devuelve los datos de una serie en particular
     * @param int $id El ID único de la serie 
     * @return serie[]
     */
    public function lista_completa(): array
    {
        $conexion = Conexion::getConexion();
        $query = "SELECT * FROM serie";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute();

        $result = $PDOStatement->fetchAll();


        return $result;
    }

    /**
     * Devuelve los datos de una serie en particular
     * @param int $id El ID único de la serie 
     */
    public function get_x_id(int $id): ?Serie
    {
        $conexion = Conexion::getConexion();
        $query = "SELECT * FROM serie WHERE id = $id";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute();

        $result = $PDOStatement->fetch();

        if (!$result) {
            return null;
        }
        return $result;
    }

    /**
     * Get the value of nombre
     */ 
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Get the value of historia
     */ 
    public function getHistoria()
    {
        return $this->historia;
    }

    

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }
}
