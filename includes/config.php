<?php
define('host','localhost');
define('user','root');
define('pass','');
define('dbname','protection_violence');

try{

    $conexao=new PDO('mysql:host=localhost;dbname=protection_violence','root','');
    $conexao->setAttribute(PDO::ATT_ERRMODE,PDO::ERRMODE_EXCEPTION);
}

catch(PDOException $erro){
    echo"Erro ao conectar-se ao banco de dados=>"  .$erro->getMessage();
}



?>