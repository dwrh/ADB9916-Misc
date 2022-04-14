<?php

include('sqlConnection.php');

if (isset($_POST['submit'])) { 
    $lat =  $_POST['lat'];
    $long = $_POST['long'];
    $aid = $_POST['aid'];
    $ownnam = $_POST['mgrnam'];
    $ownmob = $_POST['mgrmob'];
    $EventType = $_POST['EventType'];
    $MeansofArrival = $_POST['MeansofArrival'];
    $MeansofDeparture = $_POST['MeansofDeparture'];

    $null = NULL;
    $index = "1";
    $valid = 1;

    // Open connect to MySQL and read in data
    $dsn = "mysql:host=localhost;dbname=bearec5_animals;charset=utf8";
    $opt = array(
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    );
    try {
        $pdo = new PDO($dsn,USERNAME,PASSWORD, $opt);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); 
        $query = $pdo->prepare(" UPDATE `Temporary` "
                . "SET `MeansofArrival` = :MeansofArrival, `MeansofDeparture` = :MeansofDeparture, `EventType` = :EventType, `DateTime` = CURRENT_TIMESTAMP,"
                . "`CurrentManager` = :CurrentManager, `ManagerMobile` = :ManagerMobile, `EventLat` = :EventLat, `EventLong` = :EventLong,"
                . "`valid` = :valid"
                . " WHERE `index` = :index ;");
        $query->bindValue(':MeansofArrival', $MeansofArrival);
        $query->bindValue(':MeansofDeparture', $MeansofDeparture);
        $query->bindValue(':EventType', $EventType);
        $query->bindValue(':CurrentManager', $ownnam);
        $query->bindValue(':ManagerMobile', $ownmob);
        $query->bindValue(':EventLat', $lat);
        $query->bindValue(':EventLong', $long);
        $query->bindValue(':valid', $valid);
        $query->bindValue(':index', $index);
        $query->execute();
        $query = null;

        // $eventscheduler = $pdo->prepare("SET GLOBAL event_scheduler = ON;"
        //                                 . "SELECT @@event_scheduler;"
        //                                 . "CREATE EVENT cleanup"
        //                                 . "ON SCHEDULE AT CURRENT_TIMESTAMP + INTERVAL 1 HOUR"
        //                                 . "DO"
        //                                 . "UPDATE `Temporary` SET `MeansofArrival`=NULL,`MeansofDeparture`=NULL,`EventType`=NULL,`DateTime`=NULL,`CurrentManager`=NULL,`ManagerMobile`=NULL,`EventLat`=NULL, `valid`=0,`EventLong`=NULL WHERE 1;"
        // $eventscheduler->execute();
        // $eventscheduler = null;
        $pdo = null;

        echo "Set default event successful! ";
        $link_address = "dbase.php?AID=" . $aid;
        echo "<a href='$link_address'>Return to homepage</a>";
        
    } catch (PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }    
}
else { 
    echo "Please set the default event. "; 
    $link_address = "db_event.php?";
    echo "<a href='$link_address'>Return</a>";
}
?>
