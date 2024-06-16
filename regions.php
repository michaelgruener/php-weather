<?php 


function database($City){

    $servername = 'localhost';
    $username = 'root';
    $password = '1234';
    
    try {
        $conn = new PDO("mysql:host = $servername", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        $data = $conn->prepare("SELECT * FROM hallo.temps WHERE City = :City");
        $data->bindParam(':City', $City, PDO::PARAM_STR);
        if($City == 'all') {$data = $conn->prepare("SELECT Region FROM hallo.temps");};
        $data->execute();
        $data = $data->fetchAll();

    } catch(PDOException $e) {
        echo 'Database connection failed ' . $e->getMessage();
    }

    return $data;

}

?>