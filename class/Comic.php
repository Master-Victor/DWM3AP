<?php

class Comic
{
    //atributo
    protected $id;
    protected $personaje;
    protected $serie;
    protected $volumen;
    protected $numero;
    protected $titulo;
    protected $publicacion;
    protected $guion;
    protected $arte;
    protected $bajada;
    protected $portada;
    protected $precio;
    //METODOS

    //Getter -> es un metodo

    public function getId()
    {
        return $this->id;
    }

    public function getPersonaje()
    {
        return $this->personaje;
    }

    public function getSerie()
    {
        return $this->serie;
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

    public function getGuion()
    {
        return $this->guion;
    }

    public function getArte()
    {
        return $this->arte;
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

    //Setter -> es un metodo

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setPersonaje(string $personaje): void
    {
        $this->personaje = $personaje;
    }

    public function setSerie(string $serie)
    {
        $this->serie = $serie;
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

    public function setGuion(string $guion)
    {
        $this->guion = $guion;
    }

    public function setArte(string $arte)
    {
        $this->arte = $arte;
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

    //metodo
    public function catalogo_completo(): array
    {
        $catalogo = [];

        $miArchivoJson = file_get_contents('./includes/productos.json');
        $JSON_DATA = json_decode($miArchivoJson);

        foreach ($JSON_DATA as $value) {
            //creo una instancia del comic -> ahora tengo un objeto comic
            $comic = new self();
            //relleno los atributos
            $comic->id = $value->id;
            $comic->personaje = $value->personaje;
            $comic->serie = $value->serie;
            $comic->volumen = $value->volumen;
            $comic->numero = $value->numero;
            $comic->titulo = $value->titulo;
            $comic->publicacion = $value->publicacion;
            $comic->guion = $value->guion;
            $comic->arte = $value->arte;
            $comic->bajada = $value->bajada;
            $comic->portada = $value->portada;
            $comic->precio = $value->precio;
            //agrego a mi catalogo
            //array_push($catalogo, $comic);
            
            $catalogo []= $comic;
        }

        return $catalogo;
    }

    public function catalogo_x_personaje(string $personaje){
        $catalogo = $this->catalogo_completo();

        $resultado = [];

        foreach( $catalogo as $comic ){
            if( $comic->personaje == $personaje ){
                $resultado []= $comic;
            }
        }

        return $resultado;
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
        return $this->serie . " Vol.". $this->volumen . " #".$this->numero;
    }
    /**
     * Devuelve el precio de la unidad, formateado correctamente
     * utilizando number_format 2000,50
     * https://www.php.net/manual/en/function.number-format.php
     */
    public function precio_formateado(): string
    {
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
}
