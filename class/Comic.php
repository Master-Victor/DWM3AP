<?php

class Comic
{
    //atributo
    protected $id;
    protected $personaje_principal;
    protected $serie;
    protected $volumen;
    protected $numero;
    protected $titulo;
    protected $publicacion;
    protected $guionista;
    protected $artista;
    protected $bajada;
    protected $portada;
    protected $origen;
    protected $editorial;    
    protected $personajes_secundarios;
    protected $personajes_secundarios_ids;
    protected $precio;
    protected $createValues = ['id', 'volumen','numero','titulo','publicacion','bajada','portada','origen','editorial','precio'];

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
        return $this->artista->getId();
    }

    public function getGuionistaId(){
        return $this->guionista->getId();
    }

    public function getSerieId(){
        return $this->serie->getId();
    }

    public function getPersonajePrincipalId(){
        return $this->personaje_principal->getId();
    }

    //metodo

    public function createComic($comicData){
        $comic = new self();
        foreach( $this->createValues as $value ){
            $comic->{$value} = $comicData[$value];
        }
        /** Busco una serie por id y lo traigo y asigno a mi comic */
        $comic->serie = (new Serie())->get_x_id($comicData['serie_id']);
        $comic->personaje_principal = (new Personaje())->get_x_id($comicData['personaje_principal_id']);
        $comic->guionista = ( new Guionista())->get_x_id($comicData['guionista_id'] );
        $comic->artista = ( new Artista())->get_x_id($comicData['artista_id'] );

        $personajes_secundarios_ids = explode(",", $comicData['personajes_secundarios']);
        $comic->personajes_secundarios_ids = $personajes_secundarios_ids;
        $personajes_secundarios = [];
        if( !empty($personajes_secundarios_ids[0]) ){
            foreach( $personajes_secundarios_ids as $id ){
                $personajes_secundarios []= (new Personaje())->get_x_id($id);
            }
        }
        $comic->personajes_secundarios = $personajes_secundarios;
        return $comic;
    }

    public function catalogo_completo(): array
    {
        $catalogo = [];
        $conexion = Conexion::getConexion();
        $query = "SELECT comics.*,GROUP_CONCAT(comic_x_personaje.id_personaje) AS personajes_secundarios FROM comics LEFT JOIN comic_x_personaje ON comic_x_personaje.id_comic = comics.id GROUP BY comics.id";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);
        $PDOStatement->execute();

        while( $result = $PDOStatement->fetch() ){
            $catalogo []= $this->createComic($result);
        }

        return $catalogo;
    }

    public function catalogo_x_personaje(int $id_personaje){
        $catalogo = [];
        $conexion = Conexion::getConexion();
        $query = "SELECT comics.*,GROUP_CONCAT(comic_x_personaje.id_personaje) AS personajes_secundarios FROM comics LEFT JOIN comic_x_personaje ON comic_x_personaje.id_comic = comics.id WHERE comics.personaje_principal_id = $id_personaje GROUP BY comics.id";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);
        $PDOStatement->execute();

        while( $result = $PDOStatement->fetch() ){
            $catalogo []= $this->createComic($result);
        }

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
        return $this->guionista->getNombreCompleto();
    }

    public function getArte()
    {
        return $this->artista->getNombreCompleto(); 
    }

    public function catalogo_x_artista(int $artista_id){
        $catalogo = [];
        $conexion = Conexion::getConexion();
        $query = "SELECT * FROM comics WHERE comics.artista_id = $artista_id";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute();

        $catalogo = $PDOStatement->fetchAll();

        return $catalogo;
    }

    public function catalogo_x_guionista(int $guionista_id){
        $catalogo = [];
        $conexion = Conexion::getConexion();
        $query = "SELECT * FROM comics WHERE comics.guionista_id = $guionista_id";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute();

        $catalogo = $PDOStatement->fetchAll();

        return $catalogo;
    }

    public function catalogo_x_rango(int $min, int $max){ 
        $catalogo = [];
        $conexion = Conexion::getConexion();
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

        return $conexion->lastInsertId();
    }

    public function edit($titulo, $personaje_principal_id, $serie_id, $guionista_id, $artista_id, $volumen, $numero, $publicacion, $origen, $editorial, $bajada, $portada, $precio, $id_comic){
        $conexion = Conexion::getConexion();
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
        $conexion = Conexion::getConexion();
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
        $conexion = Conexion::getConexion();
        $query = "DELETE FROM comic_x_personaje WHERE id_comic = $comic_id";   
        $PDOStatement = $conexion->prepare($query);  
        $PDOStatement->execute();
    }

    public function delete(){
        $conexion = Conexion::getConexion();
        $query = "DELETE FROM comics WHERE id = $this->id";  
        $PDOStatement = $conexion->prepare($query);  
        $PDOStatement->execute();
    }

    public function getPersonajeSecundarioIds(){
        return $this->personajes_secundarios_ids;
    }
}
