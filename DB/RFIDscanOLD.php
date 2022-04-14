<?php


include('sqlConnection.php');

if (isset($_POST['tid'])) {

    if (isset($_POST['location'])) {
        $location = $_POST['location'];
        $pieces = explode(",", $location);
        $lat = $pieces[0];
        $long = $pieces[1];
    }
    
    $tid = $_POST['tid'];

    $dsn = "mysql:host=localhost;dbname=bearec5_animals;charset=utf8";
    $opt = array(
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    );
    try {
        $pdo = new PDO($dsn,USERNAME,PASSWORD, $opt);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $query = $pdo->prepare(" SELECT * FROM `RFIDinfo` WHERE `tid` = :tid ");
        $query->bindValue(':tid', $tid);
        $query->execute();
        $rows = $query->fetchAll(PDO::FETCH_NUM);
        $col = 0;
        $rid = 0;        
        foreach ($rows[0] as $ele) {
            $dtarr[$rid][$col] = $ele;
            $col++;
        }
        $aid =  $dtarr[$rid][1];
        $query = null;
        $pdo = null;
    } catch (PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }



    $valid = 1;
    try {
        $pdo = new PDO($dsn,USERNAME,PASSWORD, $opt);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

        $check = $pdo->prepare("SELECT count(*) FROM `Temporary` WHERE `valid` = :valid ");
        $check->bindValue(':valid', $valid);
        $check->execute();
        $rows = $check->fetch(PDO::FETCH_NUM);
        if ($rows[0] != 0) {

            $query = $pdo->prepare(" SELECT *, CURRENT_TIMESTAMP AS timeNow FROM `Temporary` WHERE `valid` = :valid ");
            $query->bindValue(':valid', $valid);
            $query->execute();
            $rows = $query->fetchAll(PDO::FETCH_NUM);
            $col = 0;      
            foreach ($rows[0] as $ele) {
                $defaultvalue[$col] = $ele;
                $col++;
            }
            $savedTime  = strtotime($defaultvalue[4]);
            $currentTime = strtotime($defaultvalue[10]);
            $differenceInSeconds = $currentTime - $savedTime;
            if ($differenceInSeconds <= 3600) {
                $query = null;
                $query = $pdo->prepare(" INSERT INTO `AnimalEvent` "
                        . " (`AID`, `MeansofArrival`, `MeansofDeparture`, `EventType`, `DateTime`,"
                        . "`CurrentManager`, `ManagerMobile`, `EventLat`, `EventLong`)"
                        . " VALUES (:aid, :MeansofArrival, :MeansofDeparture, :EventType, UTC_TIMESTAMP(), :CurrentManager,"
                        . " :ManagerMobile, :EventLat, :EventLong);");
                $query->bindValue(':aid', $aid);
                $query->bindValue(':MeansofArrival', $defaultvalue[1]);
                $query->bindValue(':MeansofDeparture', $defaultvalue[2]);
                $query->bindValue(':EventType', $defaultvalue[3]);
                $query->bindValue(':CurrentManager', $defaultvalue[5]);
                $query->bindValue(':ManagerMobile', $defaultvalue[6]);
                $query->bindValue(':EventLat', $lat);
                $query->bindValue(':EventLong', $long);
                $query->execute();
                $query = null;
                $pdo = null;
                echo "Scan event submitted successfully using default setting";
            }
            else {
                echo "Default setting expired! Please sumbit default setting again.";
            }
        }
        else {
            echo "Error:  Default event has not been entered yet.";
        }
    } catch (PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}

else {
    echo "Error: for use with Send Grok only";
} 



?>
