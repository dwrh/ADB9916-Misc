<?php


include('sqlConnection.php');

if (isset($_GET['tid'])) {

    if (isset($_GET['location'])) {
        $location = $_GET['location'];
        $pieces = explode(",", $location);
        $lat = $pieces[0];
        $long = $pieces[1];
    }
    
    $epc = $_GET['epc'];
    $tid = $_GET['tid'];

    $test = "RFIDEPCTest";

    $dsn = "mysql:host=localhost;dbname=bearec5_animals;charset=utf8";
    $opt = array(
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    );

    try {
        $pdo = new PDO($dsn,USERNAME,PASSWORD, $opt);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $query = $pdo->prepare(" INSERT INTO `RFIDEPC` "
                . " (`AID`, `MeansofArrival`, `MeansofDeparture`, `EventType`, `DateTime`,"
                . "`CurrentManager`, `ManagerMobile`, `EventLat`, `EventLong`)"
                . " VALUES (:aid, :MeansofArrival, :MeansofDeparture, :EventType, UTC_TIMESTAMP(), :CurrentManager,"
                . " :ManagerMobile, :EventLat, :EventLong);");
        $query->bindValue(':aid', $tid);
        $query->bindValue(':MeansofArrival', $epc);
        $query->bindValue(':MeansofDeparture', $test);
        $query->bindValue(':EventType', $test);
        $query->bindValue(':CurrentManager', $test);
        $query->bindValue(':ManagerMobile', $test);
        $query->bindValue(':EventLat', $lat);
        $query->bindValue(':EventLong', $long);
        $query->execute();
        $query = null;
        $pdo = null;
        echo "Scan event submitted successfully using default setting";
        }
    catch (PDOException $e) {
    echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}
else {
echo "Error: for use with Send Grok only";
} 



?>
