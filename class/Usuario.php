<?PHP

class Usuario
{
    protected $id;
    protected $email;
    protected $nombre_usuario;
    protected $nombre_completo;
    protected $password;
    protected $roles;
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
        return $this->roles;
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

    /**
     * Set the value of email
     */
    public function setEmail($email): self {
        $this->email = $email;
        return $this;
    }

    /**
     * Set the value of nombre_usuario
     */
    public function setNombreUsuario($nombre_usuario): self {
        $this->nombre_usuario = $nombre_usuario;
        return $this;
    }

    /**
     * Set the value of nombre_completo
     */
    public function setNombreCompleto($nombre_completo): self {
        $this->nombre_completo = $nombre_completo;
        return $this;
    }

    /**
     * Set the value of password
     */
    public function setPassword($password): self {
        $this->password = $password;
        return $this;
    }

    /**
     * Set the value of rol
     */
    public function setRoles($roles): self {
        $this->roles = $roles;
        return $this;
    }

    public function guardar(){
        $conexion = (new Conexion())->getConexion();
        $query = "INSERT INTO `usuarios` (`id`, `email`, `nombre_usuario`, `nombre_completo`, `password`, `roles`) VALUES (NULL, '$this->email', '$this->nombre_usuario', '$this->nombre_completo', '$this->password', 'usuario')";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute();
    }
}


