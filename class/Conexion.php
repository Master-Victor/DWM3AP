<?PHP
    class Conexion{
        
        //atributos o propiedades

        public const DB_SERVER = "localhost:3463";
        public const DB_USER = "root";
        public const DB_PASS = "";
        public const DB_NAME = "tiendita";
        public const DB_DSN = "mysql:host=".self::DB_SERVER.";dbname=".self::DB_NAME.";charset=utf8mb4";

        protected PDO $db;
        //metodo contructor
        public function __construct()
        {
            try{
                $this->db = new PDO(self::DB_DSN, self::DB_USER, self::DB_PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
            }catch(Exception $e){
                die("ultimas palabras"); //exit
            }
        }
        //metodo
        

        /**
         * Función que devuelve una conexión PDO lista para usar
         *
         * @return PDO
         */
        public function getConexion(): PDO
        {
                return $this->db;
        }
    }