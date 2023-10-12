<?php

function titulo($vistas){
    return str_replace("_"," ", $vistas);
}

/**
 * Esta funcion devuelve las primeras x cantidad de palabras
 * @param string $texto Este es el texto a cortar
 * @param int $cantidad Esta es la cantidad de palabras a recortar
 * @return string Este es el texto recortado
 */
function recortar_palabras(string $texto, int $cantidad) : string
{
    //array
    //bool
    //float
    //int
    //string
    //object

    $resultado = "";
    $array = explode(" ", $texto);
    if( count($array) <= $cantidad ){
        $resultado = $texto;
    }else{
        $arrayRecotado = array_slice($array,0, $cantidad);
        $resultado = implode(" ", $arrayRecotado)."...";
    }

    return $resultado;
}
