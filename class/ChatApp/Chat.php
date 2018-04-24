<?php
namespace ChatApp;


use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class Chat implements MessageComponentInterface {
    protected $clients;
    protected $dsn = 'mysql:dbname=realtime;host=localhost:3307';
    protected $user = 'root';
    protected $password = '';
    protected $dbh;
    protected $results;
    
    public function __construct() {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn) {
//        $this->clients->attach($conn);
//        $this->dbh = new \PDO($this->dsn, $this->user, $this->password);
//        $sth = $this->dbh->prepare("SELECT * FROM messages");
//        $sth->execute();
//        $this->results = $sth->fetchAll(\PDO::FETCH_OBJ);
        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
//        $this->dbh = new \PDO($this->dsn, $this->user, $this->password);
//        $sth = $this->dbh->prepare("SELECT * FROM messages");
//        $sth->execute();
//        $this->results = $sth->fetchAll(\PDO::FETCH_OBJ);
//        
//        $new_array = [];
//        
//        foreach($this->results as $result){
//            $new_array[$result->time] = $result;
//        }
//        
//        foreach ($this->clients as $client) {
//            if ($from !== $client) {
//                foreach($new_array as $new){
//                    $client->send(json_encode($new));
//                }
//            }
//        }
        
        foreach ($this->clients as $client) {
            if ($from !== $client) {
                $client->send($msg);
            }
        }
        
    }

    public function onClose(ConnectionInterface $conn) {
        $this->clients->detach($conn);
        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";
        $conn->close();
    }
}