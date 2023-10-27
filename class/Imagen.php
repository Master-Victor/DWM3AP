<?php

    class Imagen {
        static public function subirImagen($datosArchivo, $directorio) : string
        {
            $og_name = explode(".",$datosArchivo["imagen"]["name"]);
            $extension = end($og_name);
            $filename = time() . ".$extension";

            $fileUploaded = move_uploaded_file($datosArchivo["imagen"]["tmp_name"], "$directorio/$filename");

            if(!$fileUploaded){
                throw new Exception("No se pudo subir la imagen");
            }else{
                return $filename;
            }
        }
    }