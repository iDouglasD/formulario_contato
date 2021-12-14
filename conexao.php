<?php

// Credenciais de acesso ao DB
define('HOST', '127.0.0.1');
define('USER', 'root');
define('PASS', '');
define('DBNAME', 'contato_clientes');
define('PORT', '3308');

$conn = new PDO('mysql:host=' . HOST . ';port=' .PORT. ';dbname=' . DBNAME . ';', USER, PASS);

?>