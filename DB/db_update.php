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
//// Open CSV file and read in data
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
?>


<!DOCTYPE
td PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>
    <head>
        <link rel='stylesheet' href="CAPSIM_Styles.css" />

        <script type="text/javascript">
            var ownCheck = false;
            
            function startLoad() {
                setLinkID();
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
                
                var radioSpecie = document.getElementsByName("Specie");
                var SpecieValid = false;

                var i = 0;
                while (!SpecieValid && i < radioSpecie.length) {
                    if (radioSpecie[i].checked) SpecieValid = true;
                    i++;        
                }
                
                var radioSex = document.getElementsByName("sex");
                var SexValid = false;

                i = 0;
                while (!SexValid && i < radioSex.length) {
                    if (radioSex[i].checked) SexValid = true;
                    i++;        
                }
    
                var dobValid = true;
                var textdob = document.forms["animalForm"]["bday"].value;
                if (textdob == null || textdob == "") {
                    dobValid = false;
                }
                
                var fileToUploadValid = true;
                var fileToUpload = document.forms["animalForm"]["fileToUpload"].value;
                if (fileToUpload == null || fileToUpload == "") {
                    fileToUploadValid = false;
                }

                var formValid = dobValid && SpecieValid && SexValid && fileToUploadValid;
                if (!formValid) { alert("Form is incomplete!");
                    return formValid;
                }
                else {
                    var OwnMobValid = true;
                    var textOwnMob = document.forms["animalForm"]["ownmob"].value;
                    if (textOwnMob == null || textOwnMob == "") {
                        OwnMobValid = false;
                    }

                    var OwnValid = true;
                    var textOwn = document.forms["animalForm"]["ownnam"].value;
                    if (textOwn == null || textOwn == "") {
                        OwnValid = false;
                    }
                    
                    if (OwnMobValid && OwnValid) {
                        ownCheck = true;
                    }
                    if (!ownCheck) {
                        ownCheck = true;
                        alert ("Owner name or Owner mobile is missing. Press submit again to proceed with Owner name or Owner mobile missing")
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
                var HomePath = "dbase.php" + pathArray;
                var updatePath = "db_update.php" + pathArray;
                var scanmanPath = "db_scanman.php" + pathArray;
                document.getElementById("menuregis").setAttribute("href", regisPath);
                document.getElementById("menuevent").setAttribute("href", eventPath);
                document.getElementById("menuscan").setAttribute("href", HomePath);
                document.getElementById("menuupdate").setAttribute("href", updatePath);
                document.getElementById("menuscanman").setAttribute("href", scanmanPath);
                document.getElementById("aid").setAttribute("value", aniaid);
            }
            
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#anipic')
                            .attr('src', e.target.result)
                            .width(400)
                    };

                    reader.readAsDataURL(input.files[0]);
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

<form name="animalForm" action="dataupdate.php" onsubmit="return validateForm()" method="post" enctype="multipart/form-data">

<p><input id="aid" type="hidden" name="aid"/></p>
    
<p><label><h2> Date/Time (YYYY-MM-DD HH:MM:SS) UTC time:  <input type="text" name="time"> </h2></label></p>    

<p><label><h2> Location: <input type="text" name="lat"> , <input type="text" name="long"></h2></label></p> 

<p><label><h2> Owner : <input type="text" name="ownnam"></h2></label></p>    
<p><label><h2> Owner Mobile : <input type="text" name="ownmob"></h2></label></p>        

<p><label><h2> Species </h2></label></p>    
<p><input type="radio" name="Specie" required value="Cattle" />         <label> Cattle </label>   </p>
<p><input type='radio' name='Specie' value="Buffalo"/>         <label> Buffalo </label>   </p>
<p><input type='radio' name='Specie' value="Pig"/>         <label> Pig </label>   </p>
<p><input type='radio' name='Specie' value="Chicken"/>         <label> Chicken </label>   </p>
<p><input type='radio' name='Specie' value="Duck"/>         <label> Duck </label>   </p>

<p><label><h2> Breed : <input type="text" name="breed"></h2></label></p>    

<p><label><h2> Production Category </h2></label></p>    
<p><input type="checkbox" name="meat" value="meat"/>        <label> Meat </label>   </p>
<p><input type="checkbox" name="dairy" value="dairy"/>       <label> Dairy </label>   </p>
<p><input type="checkbox" name="egg" value="egg"/>         <label> Egg </label>   </p>
<p><input type="checkbox" name="breeding" value="breeding"/>    <label> Breeding </label>   </p>
<p><input type="checkbox" name="traction" value="traction"/>    <label> Traction </label>   </p>

<p><label><h2> Sex </h2></label></p>    
<p><input type="radio" name="sex" value="male" required/> Male</p>
<p><input type="radio" name="sex" value="female" required/> Female</p>


<p><label><h2> Animal age: <input type="text" name="bday" required> year(s) old </h2></label></p>

<p><label><h2> Mother AID: <input type="text" name="Mother"></h2></label></p>  
<p><label><h2> Father AID: <input type="text" name="AIDFather"></h2></label></p>

<p><label><h2> Password to update: <input type="password" name="password"></h2></label></p>    

<p><input type="submit" name="submit" value="Submit"/>    <label> Animal Record </label>   </p>


	</div>
			 
            <div id="sidebar">
                 <div style="margin-top: +110px;" class="widget flag-area">
                    <label><h2 style="margin-left: -150px;"> Animal Photo: <input type="file" name="fileToUpload" id="fileToUpload" accept="image/*" capture="camera" onchange="readURL(this);" required></h2></label>
                      <img style="margin-left: -275px;" id="anipic" src="" alt="" width="400"/><br />
	              </div>
            </div>

		</div>
		<div class="clear"></div>
	</div>




</form>
</body>
</html>
