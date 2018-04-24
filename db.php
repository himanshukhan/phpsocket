<?php
/* Connect to a MySQL database using driver invocation */
$dsn = 'mysql:dbname=realtime;host=localhost:3307';
$user = 'root';
$password = '';

try {
    $dbh = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}


$sth = $dbh->prepare("SELECT * FROM messages");
$sth->execute();


$result = $sth->fetchAll(PDO::FETCH_OBJ);
print_r($result);

?>
