<?php
$servernimi = "localhost";
$kasutajanimi = "maria";
$parool = "1234";
$andmebaas = "diploma";
$yhendus = new mysqli($servernimi, $kasutajanimi, $parool, $andmebaas);
$yhendus->set_charset('UTF8');
//ühenduse kontroll
if(!$yhendus){
    die('Ei saa ühendust andmebaasiga');
}
