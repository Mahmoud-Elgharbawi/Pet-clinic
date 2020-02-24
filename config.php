<?php

$dsn = 'mysql:host=localhost:3306;dbname=pets';//data source name ( localhost , database name)
$user='root';
$pass='';

try{
    $connect = new PDO($dsn,$user,$pass);//start connection with pdo
    $connect ->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}catch(PDOExeption $e){
    echo "fail";
    echo $e ->getMessage();
}
?>
