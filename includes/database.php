<?php

try {
    $host = $_ENV['DB_HOST'];
    $user = $_ENV['DB_USER'];
    $pass = $_ENV['DB_PASS'];
    $service = $_ENV['DB_SERVICE'];
    $database = $_ENV['DB_NAME'];

    $db = new PDO("mysql:host=$host;dbname=$database;charset=utf8", "$user", "$pass");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


} catch (PDOException $e) {
    // echo json_encode([
    //     "detalle" => $e->getMessage(),       
    //     "mensaje" => "Error de conexión bd",

    //     "codigo" => 5,
    // ]);
    // header('Location: /');
    // exit;
}
