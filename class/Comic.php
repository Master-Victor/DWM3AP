<?php

class Comic
{
    //atributo
    protected $id;
    protected $personaje_principal_id;
    protected $serie_id;
    protected $volumen;
    protected $numero;
    protected $titulo;
    protected $publicacion;
    protected $guionista_id;
    protected $artista_id;
    protected $bajada;
    protected $portada;
    protected $origen;
    protected $editorial;    
    protected $personajes_secundarios;
    protected $precio;
    //METODOS

    //Getter -> es un metodo

    public function getId()
    {
        return $this->id;
    }

    public function getVolumen()
    {
        return $this->volumen;
    }

    public function getNumero()
    {
        return $this->numero;
    }

    public function getTitulo()
    {
        return $this->titulo;
    }

    public function getPublicacion()
    {
        return $this->publicacion;
    }

    public function getBajada()
    {
        return $this->bajada;
    }

    public function getPortada()
    {
        return $this->portada;
    }

    public function getPrecio()
    {
        return $this->precio;
    }

    public function getPersonajeSecundario()
    {
        return $this->personajes_secundarios;
    }
    //Setter -> es un metodo

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setVolumen(string $volumen)
    {
        $this->volumen = $volumen;
    }

    public function setNumero(string $numero)
    {
        $this->numero = $numero;
    }

    public function setTitulo(string $titulo)
    {
        $this->titulo = $titulo;
    }

    public function setPublicacion(string $publicacion)
    {
        $this->publicacion = $publicacion;
    }

    public function setBajada(string $bajada)
    {
        $this->bajada = $bajada;
    }

    public function setPortada(string $portada)
    {
        $this->portada = $portada;
    }

    public function setPrecio(string $precio)
    {
        $this->precio = $precio;
    }

    public function getEditorial(){
        return $this->editorial;
    }

    public function getOrigen(){
        return $this->origen;
    }

    public function getArtistaId(){
        return $this->artista_id;
    }

    public function getGuionistaId(){
        return $this->guionista_id;
    }

    public function getSerieId(){
        return $this->serie_id;
    }

    public function getPersonajePrincipalId(){
        return $this->personaje_principal_id;
    }

    //metodo
    public function catalogo_completo(): array
    {
        $catalogo = [];
        $conexion = (new Conexion())->getConexion();
        $query = "SELECT comics.*,GROUP_CONCAT(comic_x_personaje.id_personaje) AS personajes_secundarios FROM comics LEFT JOIN comic_x_personaje ON comic_x_personaje.id_comic = comics.id GROUP BY comics.id";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute();

        $catalogo = $PDOStatement->fetchAll();

        // $miArchivoJson = file_get_contents('./includes/productos.json');
        // $JSON_DATA = json_decode($miArchivoJson);

        // foreach ($JSON_DATA as $value) {
        //     //creo una instancia del comic -> ahora tengo un objeto comic
        //     $comic = new self();
        //     //relleno los atributos
        //     $comic->id = $value->id;
        //     $comic->personaje = $value->personaje;
        //     $comic->serie = $value->serie;
        //     $comic->volumen = $value->volumen;
        //     $comic->numero = $value->numero;
        //     $comic->titulo = $value->titulo;
        //     $comic->publicacion = $value->publicacion;
        //     $comic->guion = $value->guion;
        //     $comic->arte = $value->arte;
        //     $comic->bajada = $value->bajada;
        //     $comic->portada = $value->portada;
        //     $comic->precio = $value->precio;
        //     //agrego a mi catalogo
        //     //array_push($catalogo, $comic);
            
        //     $catalogo []= $comic;
        // }

        return $catalogo;
    }

    public function catalogo_x_personaje(int $id_personaje){
        $catalogo = [];
        $conexion = (new Conexion())->getConexion();
        $query = "SELECT comics.*,GROUP_CONCAT(comic_x_personaje.id_personaje) AS personajes_secundarios FROM comics LEFT JOIN comic_x_personaje ON comic_x_personaje.id_comic = comics.id WHERE comics.personaje_principal_id = $id_personaje GROUP BY comics.id";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute();

        $catalogo = $PDOStatement->fetchAll();

        return $catalogo;
    }

    public function catalogo_x_id(int $id){
        $catalogo = $this->catalogo_completo();

        foreach( $catalogo as $comic ){
            if( $comic->id == $id ){
                return $comic;
            }
        }

        return [];
    }

    /**
     * Devuelve el nombre completo de la edición
     * Serie + Vol + Numero
     */
    public function nombre_completo(): string
    {
        return $this->getTitulo()." "."Vol.". $this->volumen . " #".$this->numero;
    }
    /**
     * Devuelve el precio de la unidad, formateado correctamente
     * utilizando number_format 2000,50
     * https://www.php.net/manual/en/function.number-format.php
     */
    public function precio_formateado(): string
    {
        // if( $this->descuento !== null ){ en caso que quieran un descuento
        //     return number_format($this->precio * $this->descueto, 2, ",", "."); 
        // }
        return number_format($this->precio, 2, ",", ".");
    }
        /**
     * Esta función devuelve las primeras x palabras de un párrafo 
     * @param int $cantidad Esta es la cantidad de palabras a extraer (Opcional)
     * limitar la cantidad de palabras de mi bajada a $cantidad
     */
    public function bajada_reducida(int $cantidad = 10): string
    {
    $resultado = "";

    $array = explode(" ", $this->bajada);
    if( count($array) <= $cantidad ){
        $resultado = $this->bajada;
    }else{
        $arrayRecotado = array_slice($array,0, $cantidad);
        $resultado = implode(" ", $arrayRecotado)."...";
    }

    return $resultado;

    }

    public function getGuionista()
    {
        $guionista = (new Guionista())->get_x_id($this->guionista_id);
        $nombre = $guionista->getNombreCompleto();
        return $nombre;
    }

    public function getArte(){
        $artista = (new Artista())->get_x_id($this->artista_id);
        $nombre = $artista->getNombreCompleto();
        return $nombre; 
    }

    public function catalogo_x_artista(int $artista_id){
        $catalogo = [];
        $conexion = (new Conexion())->getConexion();
        $query = "SELECT * FROM comics WHERE comics.artista_id = $artista_id";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute();

        $catalogo = $PDOStatement->fetchAll();

        return $catalogo;
    }

    public function catalogo_x_guionista(int $guionista_id){
        $catalogo = [];
        $conexion = (new Conexion())->getConexion();
        $query = "SELECT * FROM comics WHERE comics.guionista_id = $guionista_id";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute();

        $catalogo = $PDOStatement->fetchAll();

        return $catalogo;
    }

    public function catalogo_x_rango(int $min, int $max){ 
        $catalogo = [];
        $conexion = (new Conexion())->getConexion();
        $query = "SELECT * FROM comics WHERE comics.precio > $min AND comics.precio < $max";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute();

        $catalogo = $PDOStatement->fetchAll();

        return $catalogo;
    }

    public function insert( $titulo, $personaje_principal_id, $serie_id, $guionista_id, $artista_id, $volumen, $numero, $publicacion, $origen, $editorial, $bajada, $portada, $precio ) : string
    {
        $conexion = (new Conexion())-> getConexion();
        $query = "INSERT INTO `comics` (`id`, `titulo`, `personaje_principal_id`, `guionista_id`, `artista_id`, `serie_id`, `volumen`, `numero`, `publicacion`, `origen`, `editorial`, `bajada`, `portada`, `precio`) VALUES (NULL, '$titulo', '$personaje_principal_id', '$guionista_id', '$artista_id', '$serie_id', '$volumen', '$numero', '$publicacion', '$origen', '$editorial', '$bajada', '$portada', '$precio');";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute();

        return "Aca iria el id del comic que recien cree";
    }

    public function edit($titulo, $personaje_principal_id, $serie_id, $guionista_id, $artista_id, $volumen, $numero, $publicacion, $origen, $editorial, $bajada, $portada, $precio, $id_comic){
        $conexion = (new Conexion())->getConexion();
        $query = "UPDATE `comics` SET `titulo` = '$titulo', `personaje_principal_id` = '$personaje_principal_id', `artista_id` = '$artista_id', `volumen` = '$volumen', `numero` = '$numero', `publicacion` = '$publicacion', `origen` = '$origen', `editorial` = '$editorial', `bajada` = '$bajada', `portada` = '$portada', `precio` = '$precio' WHERE `comics`.`id` = $id_comic";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute();
    }

        /**
     * Crea un vinculo de personajes secundarios
     * @param int $comic_id
     * @param int $personaje_id
     */
    public function add_personajes_sec($comic_id, $personaje_id)
    {
        $conexion = (new Conexion())->getConexion();
        $query = "INSERT INTO comic_x_personaje VALUES (NULL, $comic_id, $personaje_id)";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute();
    }
    /**
     * Vaciar lista de personajes secundarios
     * @param int $comic_id
     */
    public function clear_personajes_sec($comic_id)
    {
        $conexion = (new Conexion())->getConexion();
        $query = "DELETE FROM comic_x_personaje WHERE id_comic = $comic_id";   
        $PDOStatement = $conexion->prepare($query);  
        $PDOStatement->execute();
    }
}
