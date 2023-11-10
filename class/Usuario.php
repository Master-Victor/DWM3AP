<?PHP

class Usuario
{
    protected $id;
    protected $email;
    protected $nombre_usuario;
    protected $nombre_completo;
    protected $password;
    protected $rol;
    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Get the value of nombre_usuario
     */ 
    public function getNombre_usuario()
    {
        return $this->nombre_usuario;
    }

    /**
     * Get the value of nombre_completo
     */ 
    public function getNombre_completo()
    {
        return $this->nombre_completo;
    }

    /**
     * Get the value of rol
     */ 
    public function getRol()
    {
        return $this->rol;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    public function usuario_x_username($username){
        $conexion = (new Conexion())->getConexion();
        $query = "SELECT * FROM usuarios WHERE nombre_usuario = '$username'";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute();

        $result = $PDOStatement->fetch();

        if( !$result ){
            return null;
        }
        return $result;
    }
}


