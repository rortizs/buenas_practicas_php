<?php

class Conexion
{
    //** function static public se almacena */
    public static function conectar()
    {
        $link = new PDO("mysql:host=localhost;dbname=prueba1", "root", "");
        $link->exec("set name utf8");

        return $link;
    }
}
