<?php

include('HeadBEAR.php') ;

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
// if(($handle = fopen("AID_Tags.csv", "r")) !== FALSE) {

// 	$rid = 0 ;
// 	$row = 0;
// 		while (($data = fgetcsv($handle, 500, ',')) !== FALSE) {
// 			$num = count($data);
// 			for ($col = 0; $col < $num; $col++) {
// 				$dtarr[$row][$col] = $data[$col];
// 			}
// 			if ($dtarr[$row][0] == $AID) {
// 				$rid = $row ;
//  			}
// 			$row++;
// 		}

// // echo $rid, ' ', $row, ' ', $AID ;

// // End CSV open statement and close CSV file
// }
// fclose($handle);
?>


<!DOCTYPE
td PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>
	<head>
		<link rel='stylesheet' href="CAPSIM_Styles.css" />
		<script type="text/javascript">
            var ownCheck = false;
            
            function startLoad() {
                getLocation();
                setLinkID();
            }
            
            function validateForm() {
                var radioEvent = document.getElementsByName("EventType");
                
                var EventValid = false;
                var i = 0;
                while (!EventValid && i < radioEvent.length) {
                    if (radioEvent[i].checked) EventValid = true;
                    i++;        
                }
                
                var radioMeansofArrival = document.getElementsByName("MeansofArrival");
                var MeansofArrivalValid = false;

                i = 0;
                while (!MeansofArrivalValid && i < radioMeansofArrival.length) {
                    if (radioMeansofArrival[i].checked) MeansofArrivalValid = true;
                    i++;        
                }
    
    			var radioMeansofDeparture = document.getElementsByName("MeansofDeparture");
                var MeansofDepartureValid = false;

                i = 0;
                while (!MeansofDepartureValid && i < radioMeansofDeparture.length) {
                    if (radioMeansofDeparture[i].checked) MeansofDepartureValid = true;
                    i++;        
                }

                var formValid = MeansofDepartureValid && MeansofArrivalValid && EventValid;
                if (!formValid) { alert("Form is incomplete!");
                    return formValid;
                }
                else {
                    var OwnMobValid = true;
                    var textOwnMob = document.forms["animalScan"]["mgrmob"].value;
                    if (textOwnMob == null || textOwnMob == "") {
                        OwnMobValid = false;
                    }

                    var OwnValid = true;
                    var textOwn = document.forms["animalScan"]["mgrnam"].value;
                    if (textOwn == null || textOwn == "") {
                        OwnValid = false;
                    }
                    
                    if (OwnMobValid && OwnValid) {
                        ownCheck = true;
                    }
                    if (!ownCheck) {
                        ownCheck = true;
                        alert ("Current Manager or Manager mobile is missing. Press submit again to proceed with Current Manager or Manager mobile missing")
                        return false;
                    }
                    return true;
                }
            }
            
            function setLinkID() {
                var pathArray = window.location.search;
                var aniaid = window.location.search.split('AID=')[1];
                var regisPath = "db_register.php" + pathArray;
                var eventPath = "db_event.php" + pathArray;
                var homePath = "dbase.php" + pathArray;
                var updatePath = "db_update.php" + pathArray;
                var scanmanPath = "db_scanman.php" + pathArray;
                document.getElementById("menuregis").setAttribute("href", regisPath);
                document.getElementById("menuevent").setAttribute("href", eventPath);
                document.getElementById("menuscan").setAttribute("href", homePath);
                document.getElementById("menuupdate").setAttribute("href", updatePath);
                document.getElementById("menuscanman").setAttribute("href", scanmanPath);
                document.getElementById("aid").setAttribute("value", aniaid);

            }
           
            
            
        
            
            function showLocation(position) {
                var latitude = position.coords.latitude;
                var longitude = position.coords.longitude;
                var loc = latitude + " , " + longitude;
                var strLink = "https://www.google.com/maps?q=" + loc;
                document.getElementById("locationvalue").innerHTML = loc;
                document.getElementById("maplocation").setAttribute("href", strLink);
                document.getElementById("lat").setAttribute("value", latitude);
                document.getElementById("long").setAttribute("value", longitude);
             }

             function errorHandler(err) {
                var msg;
                switch(err.code) {
                  case 0:
                    msg = "Unable to find your location";
                    break;
                  case 1:
                    msg = "Permission denied in finding your location";
                    break;
                  case 2:
                    msg = "Your location is currently unknown";
                    break;
                  case 3:
                    msg = "Attempt to find location took too long";
                    break;
                  default:
                    break;
                }
                alert(msg);
             }

             function getLocation(){

                if(navigator.geolocation){
                   // timeout at 60000 milliseconds (60 seconds)
                   var options = {timeout:60000};
                   navigator.geolocation.getCurrentPosition(showLocation, errorHandler, options);
                }
                else{
                   alert("Sorry, browser does not support geolocation!");
                }
             }
              
        </script>


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

		<li class="menuparent"><a id="menuregis" class="menuparent">Register</a>
        <li class="menuparent"><a id="menuupdate" class="menuparent">Manual Registration</a>
		<li class="menuparent"><a id="menuevent" class="menuparent">Event</a>
        <li class="menuparent"><a id="menuscanman" class="menuparent">Manual Scan</a>
		<li class="menuparent"><a id="menuscan" class="menuparent">Home</a>
        

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

<form name="animalScan" action="dataevent.php" onsubmit="return validateForm()" method="post" enctype="multipart/form-data">

<p><input id="lat" type="hidden" name="lat"/></p>
<p><input id="long" type="hidden" name="long"/></p>
<p><input id="aid" type="hidden" name="aid"/></p>


<p><label><h2> Date/Time : <span class="lastitem"><? echo date("l \, j F Y \, G:i:s "); ?></span></h2></label></p>    

<p><label><h2> Location: <a id="maplocation"> <span id="locationvalue" class="lastitem"></span></a></h2></label></p>

<p><label><h2> Event Type </h2></label></p>    
<p><input type='radio' name='EventType' required value="FarmDep" />         <label> Farm Departure </label>   </p>
<p><input type='radio' name='EventType' value="MktArr" />          <label> Market Arrival </label>   </p>
<p><input type='radio' name='EventType' value="MktDep" />          <label> Market Departure </label> </p>
<p><input type='radio' name='EventType' value="Transit" />         <label> Transit </label>          </p>
<p><input type='radio' name='EventType' value="Inspect" />         <label> Inspection </label>       </p>
<p><input type='radio' name='EventType' value="AbaArr" />          <label> Abattoir Arrival </label> </p>
<p><input type='radio' name='EventType' value="Death" />  			<label> Slaughter/death of animal </label> </p>
<p><input type='radio' name='EventType' value="Border" />          					<label> Border Crossing </label>  </p>

<p><label><h2> Current Manager : <input type="text" name="mgrnam" ></h2></label></p>    
<p><label><h2> Manager Mobile : <input type="text" name="mgrmob" ></h2></label></p>        

<p><input type="submit" name="submit" value="Submit"/>    <label> to set event as default for scanning. </label>   </p>

<p><label><h2> Report Animal </label> <a class="menuparent" href="dbmissing.php?cty=<?=$AID?>">Missing</a><h2></p>

		</div>
			 
            <div id="sidebar">

<p><label><h2> Means of Arrival </h2></label></p>    
<p><input type='radio' name='MeansofArrival' required value="ArrWalk" /><label> Walk </label> </p>
<p><input type='radio' name='MeansofArrival' value="ArrTruck" /><label> Truck </label> </p>
<p><input type='radio' name='MeansofArrival' value="ArrCar" /><label> Car </label> </p>
<p><input type='radio' name='MeansofArrival' value="ArrMoto" /><label> Moto </label> </p>
<p><input type='radio' name='MeansofArrival' value="ArrTrain" /><label> Train </label> </p>
<p><input type='radio' name='MeansofArrival' value="ArrBoat" /><label> Boat </label> </p>
<p><input type='radio' name='MeansofArrival' value="ArrAir" /><label> Air </label> </p>
<p><input type='radio' name='MeansofArrival' value="NA" /><label> N/A </label> </p>

<p><label><h2> Means of Departure </h2></label></p>    
<p><input type='radio' name='MeansofDeparture' required value="DepWalk" /><label> Walk </label></p>
<p><input type='radio' name='MeansofDeparture' value="DepTruck" /><label> Truck </label></p>
<p><input type='radio' name='MeansofDeparture' value="DepCar" /><label> Car </label></p>
<p><input type='radio' name='MeansofDeparture' value="DepMoto" /><label> Moto </label></p>
<p><input type='radio' name='MeansofDeparture' value="DepTrain" /><label> Train </label></p>
<p><input type='radio' name='MeansofDeparture' value="DepBoat" /><label> Boat </label></p>
<p><input type='radio' name='MeansofDeparture' value="DepAir" /><label> Air </label></p>
<p><input type='radio' name='MeansofDeparture' value="NA" /><label> N/A </label></p>
            </div>


		</div>
		<div class="clear"></div>
	</div>

</form>
</body>
</html>
