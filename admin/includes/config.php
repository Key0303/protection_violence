<?php
define('HOST','localhost');
define('USER','root');
define('PASS','');
define('DB_NAME','protection_violence');

try{

    $conexao=new PDO('mysql:host=localhost;dbname=protection_violence','root','')
}
catch(ExceptionPDO $erro){
    echo"Erro ao conectar-se ao banco de dados=>" .$erro->getMessage();
}




?>