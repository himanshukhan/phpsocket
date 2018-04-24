<?php
$dbhost = "localhost:3307";
$dbname = "realtime";
$dbusername = "root";
$dbpassword = "";

$link = new \PDO("mysql:host=$dbhost;dbname=$dbname", $dbusername, $dbpassword);

$statement = $link->query("SELECT user,text,time FROM messages GROUP BY time ORDER BY id ASC", PDO::FETCH_ASSOC);

if($statement){
    $statement = $statement->fetchAll();
    echo json_encode(array("data"=>$statement));
} else {
    echo json_encode(array("data"=>$statement));
}
?>