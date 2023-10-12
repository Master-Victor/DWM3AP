<?php
/**
 * @return array Devuelve un array con todos los comics
 */
function catalogo_completo() : array
{
    $archivo = file_get_contents('./includes/productos.json');
    $catalogo = json_decode($archivo, TRUE);
    return  $catalogo;
}

/**
 * @param string $personaje Es un texto que contiene el nombre del personaje a buscar
 * @return array Retorno un array con el personaje, en caso de no encontrar returno [ ]
 */
function catalogo_x_personaje( $personaje ) : array 
{
    $personajes = [];
    $catalogo = catalogo_completo();

    foreach( $catalogo as $comic ){
        if( $comic["personaje"] == $personaje ){
            //array_push($personajes, $comic);
            $personajes []= $comic;
        }
    }

    return $personajes;
}

/**
 * @param int $id identificador unico de mi comic
 * @return array Retorno el comic especifico
 */
function catalogo_x_id( int $id ) : array 
{
    $catalogo = catalogo_completo();

    foreach( $catalogo as $comic ){
        if( $comic["id"] == $id ){
            return $comic;
        }
    }

    return [];
}