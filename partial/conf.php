<?php
$servernimi = "localhost";
$kasutajanimi = "maria";
$parool = "admin123";
$andmebaas = "diploma";
$yhendus = new mysqli($servernimi, $kasutajanimi, $parool, $andmebaas);
$yhendus->set_charset('UTF8');
//ühenduse kontroll
if(!$yhendus){
    die('Ei saa ühendust andmebaasiga');
}
