<?php

include_once 'psl-config.php';

$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);
if ($mysqli->connect_error) {
    echo '<h2>Error conectando a la Base de Datos...</h2>';
    exit();
}
$mysqli->set_charset("utf8");