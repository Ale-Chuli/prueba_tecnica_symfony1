<?php

use App\Kernel;

require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

return function (array $context) {
    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};

// $host = '127.0.0.1';
// $port = '5432';
// $dbname = 'wines';
// $user = 'symfony';
// $password = 'a';

// try{
//     $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;";
//     $pdo = new PDO($dsn,$user,$password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    
//     echo "Conexión exitosa <br>";

//     $stmt = $pdo->query('SELECT version()');
//     $version = $stmt->fetch(PDO::FETCH_ASSOC);

//     echo "Version: ". $version['version'];
// }catch(PDOException $e){
//     echo "Error al conectar";
// }

?> 