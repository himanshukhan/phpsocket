<?php
$dbhost = "localhost:3307";
$dbname = "realtime";
$dbusername = "root";
$dbpassword = "";

$link = new \PDO("mysql:host=$dbhost;dbname=$dbname", $dbusername, $dbpassword);

$statement = $link->prepare("INSERT INTO messages(user, text, time)
    VALUES(:user, :text, :time)");
    $statement->execute(array(
        "user" => $_POST['user'],
        "text" => $_POST['text'],
        "time" => date("H:i:s")
    ));

if($statement){
    echo json_encode(array("status"=>true));
} else {
    echo json_encode(array("status"=>false));
}
?>
