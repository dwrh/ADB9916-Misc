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

$dsn = "mysql:host=localhost;dbname=bearec5_animals;charset=utf8";
$opt = array(
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
);
try {
    $pdo = new PDO($dsn,USERNAME,PASSWORD, $opt);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $query = $pdo->prepare(" SELECT * FROM `AnimalsInfo` WHERE `AID` = :AID ");
    $query->bindValue(':AID', $AID);
    $query->execute();
    $rows = $query->fetchAll(PDO::FETCH_NUM);
    $col = 0;
    $rid = 0;        
    foreach ($rows[0] as $ele) {
        $dtarr[$rid][$col] = $ele;
        $col++;
    }
    $query = null;
    $pdo = null;
} catch (PDOException $e) {
    echo '{"error":{"text":'. $e->getMessage() .'}}'; 
}

if (isset($_POST['submit'])) { 
        $display = "display: none;";
        $aid = $_POST['aid'];
        $valid = 1;
        try {
            $pdo = new PDO($dsn,USERNAME,PASSWORD, $opt);
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            $check = $pdo->prepare("SELECT count(*) FROM `Temporary` WHERE `valid` = :valid ");
            $check->bindValue(':valid', $valid);
            $check->execute();
            $rows = $check->fetch(PDO::FETCH_NUM);
            if ($rows[0] == 0) {
                echo "Error:  Default event has not been entered yet.";
                exit();
            }

            $query = $pdo->prepare(" SELECT * FROM `Temporary` WHERE `valid` = :valid ");
            $query->bindValue(':valid', $valid);
            $query->execute();
            $rows = $query->fetchAll(PDO::FETCH_NUM);
            $col = 0;      
            foreach ($rows[0] as $ele) {
                $defaultvalue[$col] = $ele;
                $col++;
            }
            $query = null;
            $query = $pdo->prepare(" INSERT INTO `AnimalEvent` "
                    . " (`AID`, `MeansofArrival`, `MeansofDeparture`, `EventType`, `DateTime`,"
                    . "`CurrentManager`, `ManagerMobile`, `EventLat`, `EventLong`)"
                    . " VALUES (:aid, :MeansofArrival, :MeansofDeparture, :EventType, CURRENT_TIMESTAMP, :CurrentManager,"
                    . " :ManagerMobile, :EventLat, :EventLong);");
            $query->bindValue(':aid', $aid);
            $query->bindValue(':MeansofArrival', $defaultvalue[1]);
            $query->bindValue(':MeansofDeparture', $defaultvalue[2]);
            $query->bindValue(':EventType', $defaultvalue[3]);
            $query->bindValue(':CurrentManager', $defaultvalue[5]);
            $query->bindValue(':ManagerMobile', $defaultvalue[6]);
            $query->bindValue(':EventLat', $defaultvalue[7]);
            $query->bindValue(':EventLong', $defaultvalue[8]);
            $query->execute();
            $query = null;
            $pdo = null;
        } catch (PDOException $e) {
            echo '{"error":{"text":'. $e->getMessage() .'}}'; 
        }
}
    else {
        $display = "display: inline;";
    } 



?>


<!DOCTYPE
td PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
<link rel='stylesheet' href="CAPSIM_Styles.css" />

<script type="text/javascript"><!--
    
    function getAid() {
        var pathArray = window.location.search;
        var aniaid = window.location.search.split('AID=')[1];
        document.getElementById("aid").setAttribute("value", aniaid);
    }
// --></script>

</head>

<body onload="getAid()">
    
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

    <li class="menuparent"><a class="menuparent" href="db_register.php?AID=<?=$AID?>">Registration</a>
    <li class="menuparent"><a class="menuparent" href="db_event.php?AID=<?=$AID?>">Event</a>
    <li class="menuparent"><a class="menuparent" href="db_scan.php?AID=<?=$AID?>">Scan</a>

	</ul>
</div>
</div>
</div>

<!-- end container --></div>

<!-- end header --> 
    
    </div><!-- end wrap_all -->
</div>

<div class="container">

<div id="content-area">

<form action="" method="post">
    
            <p><input type="submit" name="submit" value="Submit" style="<?=$display?>"/>    <label style="<?=$display?>"> animal event using default setting. </label>   </p>

            <p><input id="aid" type="hidden" name="aid"/></p>
            <p> 
                <label>Animal ID:</label> <span class="lastitem"><?=$AID?></span>
            </p>
            <p> 
               <label>Species:</label> <span class="lastitem"><?=$dtarr[$rid][1]?></span>
            </p>         
            <p> 
                <label>Breed:</label> <span class="lastitem"><?=$dtarr[$rid][2]?></span>
            </p>          
            <p> 
                <label>Production Category:</label> <span class="lastitem"><?=$dtarr[$rid][3]?></span>
            </p>          
            <p> 
                <label>Sex:</label> <span class="lastitem"><?=$dtarr[$rid][4]?></span>
            </p>          
            <p> 
                <label>Birthdate:</label> <span class="lastitem"><?=$dtarr[$rid][5]?></span>
            </p>          
            <p> 
                <label>Paternal AID:</label> <a href = "dbase.php?AID=<?=$dtarr[$rid][6]?>" <span class="lastitem"><?=$dtarr[$rid][6]?></span> </a>
            </p>          
            <p> 
                <label>Maternal AID:</label> <a href = "dbase.php?AID=<?=$dtarr[$rid][7]?>" <span class="lastitem"><?=$dtarr[$rid][7]?></span> </a>
            </p>           
            <p> 
                <label>Owner Name:</label> <span class="lastitem"><?=$dtarr[$rid][8]?></span>
            </p>           
            <p> 
                <label>Owner Mobile:</label> <span class="lastitem"><?=$dtarr[$rid][9]?></span>
            </p>            
            <p> 
                <label>Owner Location:</label> <a href="https://www.google.com/maps?q=<?=$dtarr[$rid][10] . ',' . $dtarr[$rid][11]?>"<span class="lastitem"><?= '[' . $dtarr[$rid][10] . ', ' . $dtarr[$rid][11] . ']'?></span> </a>
            </p>
                       
        </form>

        </div><!-- end content area -->

	<!-- end container --></div>
			 
            <div id="sidebar">
                 <div class="widget flag-area">
                      <img style="margin-left: -225px;" src="<?=$dtarr[$rid][12]?>" alt="" width="400"/><br />
                  </div>
            </div>

		</div>
		<div class="clear"></div>
	</div>

</body>
</html>
