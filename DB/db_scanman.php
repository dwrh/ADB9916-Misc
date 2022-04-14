<?php

include('HeadBEAR.php');
include('sqlConnection.php');

$REG = 10;
$AID = (isset($_GET['AID']) === true) ? $_GET['AID'] : '' ;
$CTY = substr($AID,0,3) ;

// echo $AID, $CTY ;

include('Map_Data_Asia.php') ;

for ($i=0; $i < 24; $i++) {
	if ($mapLabel[$i][1] == $CTY) {
		$MAP = $mapLabel[$i][2] ;
 	}
}

// echo $MAP ;

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
// Open CSV file and read in data
//if(($handle = fopen("AID_Tags.csv", "r")) !== FALSE) {
//
//	$rid = 0 ;
//	$row = 0;
//		while (($data = fgetcsv($handle, 500, ',')) !== FALSE) {
//			$num = count($data);
//			for ($col = 0; $col < $num; $col++) {
//				$dtarr[$row][$col] = $data[$col];
//			}
//			if ($dtarr[$row][0] == $AID) {
//				$rid = $row ;
// 			}
//			$row++;
//		}
//
//// echo $rid, ' ', $row, ' ', $AID ;
//
//// End CSV open statement and close CSV file
//}
//fclose($handle);
//------------------------------------------------------------------------------------------------------------------
// Open connect to MySQL and read in data
$dsn = "mysql:host=localhost;dbname=bearec5_animals;charset=utf8";
$opt = array(
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
);

if (isset($_POST['submit'])) { 
        $display = "display: none;";
        $aid = $_POST['aid'];
        $lat =  $_POST['lat'];
        $long = $_POST['long'];
        $time = $_POST['time'];
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
                            . " VALUES (:aid, :MeansofArrival, :MeansofDeparture, :EventType, :Time, :CurrentManager,"
                            . " :ManagerMobile, :EventLat, :EventLong);");
                    $query->bindValue(':aid', $aid);
                    $query->bindValue(':MeansofArrival', $defaultvalue[1]);
                    $query->bindValue(':MeansofDeparture', $defaultvalue[2]);
                    $query->bindValue(':EventType', $defaultvalue[3]);
                    $query->bindValue(':Time', $time);
                    $query->bindValue(':CurrentManager', $defaultvalue[5]);
                    $query->bindValue(':ManagerMobile', $defaultvalue[6]);
                    $query->bindValue(':EventLat', $lat);
                    $query->bindValue(':EventLong', $long);
                    $query->execute();
                    $query = null;
                    $pdo = null;
                    $message = "Scan event submitted successfully using default setting";
                }
                else {
                    $message = "Default setting expired! Please sumbit default setting again.";
                }
            }
            else {
                $message = "Error:  Default event has not been entered yet.";
            }
        } catch (PDOException $e) {
            echo '{"error":{"text":'. $e->getMessage() .'}}'; 
        }
}
    else {
        $display = "display: inline;";
        $message = "Enter location and time (in UTC) then click button to submit scan event using default event setting";
    } 


?>


<!DOCTYPE
td PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
<link rel='stylesheet' href="CAPSIM_Styles.css" />
<script type="text/javascript"><!--

    function startLoad() {
        getAid();
    }
    
    function getAid() {
        var pathArray = window.location.search;
        var aniaid = window.location.search.split('AID=')[1];
        document.getElementById("aid").setAttribute("value", aniaid);
    }

    function validateForm() {

        var locationValid = true;
        var locationget = document.forms["scanform"]["lat"].value;
        if (locationget == null || locationget == "") {
            locationValid = false;
        }

        var locationValid2 = true;
        var locationget2 = document.forms["scanform"]["long"].value;
        if (locationget2 == null || locationget2 == "") {
            locationValid2 = false;
        }

        var formValid = locationValid2 && locationValid;
        if (!formValid) { alert("Please manually input location as latitude, longitude");
            return formValid;
        }

        var timeValid = true;
        var texttime = document.forms["scanform"]["time"].value;
        if (texttime == null || texttime == "") {
            timeValid = false;
        }
        if (!timeValid) { alert("Please manually input time (in UTC)");
            return timeValid;
        }
        return true;


    }
      
// --></script>

</head>

<body onload="startLoad()">
    
	<div id="transport-image" class="title-image" style="background: url('images/<?=$CTY?>.png') top center no-repeat;" >
		<div class="container">

        	<div class="image-holder">
            	<div class="title-holder">
                	  <span><?=$MAP?></span>                	
               </div>
			</div>

<div class="container">
<div id="header_nav">
<div class="navigation flotlef"><div id="menuwrapper">
<ul id="primary-nav">


	<li class="menuparent"><a class="menuparent" href="db_register.php?AID=<?=$AID?>">Register</a>
    <li class="menuparent"><a class="menuparent" href="db_update.php?AID=<?=$AID?>">Manual Registration</a>    
	<li class="menuparent"><a class="menuparent" href="db_event.php?AID=<?=$AID?>">Event</a>
    <li class="menuparent"><a class="menuparent" href="db_scanman.php?AID=<?=$AID?>">Manual Scan</a>
	<li class="menuparent"><a class="menuparent" href="dbase.php?AID=<?=$AID?>">Home</a>
    

<!-- 	<li class="menuparent"><a class="menuparent" href="http://www.adb.org/projects/39542-022/main">Registration</a>
	<li class="menuparent"><a class="menuparent" href="http://www.adb.org/projects/39542-022/main">Event</a>
	<li class="menuparent"><a class="menuparent" href="http://www.adb.org/projects/39542-022/main">Scan</a> -->
	</ul>
</div>
</div>
</div>

<!-- end container --></div>

<!-- end header --> 

<script type="text/javascript"><!--
// --></script>
        
    </div><!-- end wrap_all -->
</div>

<div class="container">

<div id="content-area">

<form name="scanform" action="" onsubmit="return validateForm()" method="post">
            <p><input type="submit" name="submit" value="Submit animal event using default setting." style="<?=$display?>; font-size:18px; font-weight: bold;"/>    <label style="<?=$display?>"></label>   </p>
            <pre style="color:red" id="scanMsg"><?= $message; ?></pre>
            <p><input id="aid" type="hidden" name="aid"/></p>

            <p><label><h2> Animal ID:<span class="lastitem"><?=$AID?></span> </h2></label></p>
            <p><label><h2> Date/Time (YYYY-MM-DD HH:MM:SS) UTC time:  <input type="text" name="time"> </h2></label></p>    
            <p><label><h2> Location: <input type="text" name="lat"> , <input type="text" name="long"></h2></label></p> 
            
</form>

        </div><!-- end content area -->

	<!-- end container --></div>

		</div>
		<div class="clear"></div>
	</div>

</body>
</html>
