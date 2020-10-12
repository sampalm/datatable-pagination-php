<?php

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "blog";

$con = mysqli_connect($host, $user, $pass, $dbname);

if(!$con) {
    die("Erro de conexão: ". mysqli_connect_error());   
}