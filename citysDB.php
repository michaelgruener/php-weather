<?php 

if(isset($_POST)){
    $data = file_get_contents("php://input");
    $data = json_decode($data, true);
    print_r(json_encode(databaseCitys($data)));
};

function databaseCitys($Region){

    $servername = 'localhost';
    $username = 'root';
    $password = '1234';
    
    try {
        $conn = new PDO("mysql:host = $servername", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        $data = $conn->prepare("SELECT City FROM hallo.temps WHERE Region = :Region");
        $data->bindParam(':Region', $Region, PDO::PARAM_STR);
        $data->execute();
        $data = $data->fetchAll();
        $Citys = array();
        for($i = 0; $i < count($data); $i++){
            $key = $data[$i]['City'];
            $Citys[] = $key;
        };

        $uniqueCitys= array_unique($Citys);

    } catch(PDOException $e) {
        echo 'Database connection failed ' . $e->getMessage();
    }

    return $uniqueCitys;

}

?>
