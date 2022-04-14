<?php

include('sqlConnection.php');

if (isset($_POST['submit'])) { 
    $lat =  $_POST['lat'];
    $long = $_POST['long'];
    $aid = $_POST['aid'];
    $time = $_POST['time'];
    $ownnam = $_POST['ownnam'];
    $ownmob = $_POST['ownmob'];
    $Specie = $_POST['Specie'];

    $passwordUpdate = $_POST['password'];
    $AIDMother = $_POST['Mother'];
    $AIDFather = $_POST['AIDFather'];
    $breed = (isset($_POST['breed']) === true) ? $_POST['breed'] : '' ;
    $dairy = (isset($_POST['dairy']) === true) ? $_POST['dairy'] . " " : '' ;
    $meat = (isset($_POST['meat']) === true) ? $_POST['meat'] . " " : '' ;
    $egg = (isset($_POST['egg']) === true) ? $_POST['egg'] . " " : '' ;
    $breeding = (isset($_POST['breeding']) === true) ? $_POST['breeding'] . " " : '' ;
    $traction = (isset($_POST['traction']) === true) ? $_POST['traction'] . " " : '' ;
    $sex = $_POST['sex'];
    $bday = $_POST['bday'];
    $production = "$dairy" . "$meat" . "$egg" . "$breeding" . "$traction";
    $production = trim($production);
    $null = NULL;
    $path = NULL;

    //checkPassword
    $updateOk = 0;
    if ($passwordUpdate == "Roland-Holst") {
        $updateOk = 1;
    }
    //Uploading picture
    if ( isset( $_FILES["fileToUpload"] ) && !empty( $_FILES["fileToUpload"]["name"] ) ) {
        if ( is_uploaded_file( $_FILES['fileToUpload']['tmp_name'] ) && $_FILES['fileToUpload']['error'] === 0 ) {
            $fileType = pathinfo($_FILES["fileToUpload"]["name"],PATHINFO_EXTENSION);
            $target_dir = "/home/bearec5/public_html/ADB_LITS/DB/uploads/";
            $target_file = $target_dir . $aid . "." . $fileType;
            $uploadOk = 1;
            //Check if picture is real or fake image
            $checkValidPic = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($checkValidPic !== false) {
                    $uploadOk = 1;
                } else {
                    $uploadOk = 0;
            }
            // Check if file already exists
            if (file_exists($target_file) && $updateOk == 0) {
                echo "Error: animal already in database! ";
                $link_address = "dbase.php?AID=" . $aid;
                echo "<a href='$link_address'>Return</a>";
                exit();
            }

            if (file_exists($target_file) && $updateOk == 1) {
                unlink($target_file);
            }
 
            // Check file size
            if ($_FILES["fileToUpload"]["size"] > 10000000) {
                $uploadOk = 0;
            }
            // Allow certain file formats
            if($fileType != "jpg" && $fileType != "png" && $fileType != "jpeg" && $fileType != "gif" ) {
                $uploadOk = 0;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Error: Picture uploaded error. Please go back and try again ";
                $link_address = "dbase.php?AID=" . $aid;
                echo "<a href='$link_address'>Return</a>";
                exit();
            // if everything is ok, try to upload file
            } else {
                if (!move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    $path = "ERROR";
                    echo "Sorry, there was an error uploading your file.";
                } else {
                    $path = "uploads/" . $aid . "." . $fileType;
                }
            }
        }
    }

    // Open connect to MySQL and read in data
    $dsn = "mysql:host=localhost;dbname=bearec5_animals;charset=utf8";
    $opt = array(
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    );
    try {
        $pdo = new PDO($dsn,USERNAME,PASSWORD, $opt);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $check = $pdo->prepare("SELECT count(*) FROM `AnimalsInfo` WHERE `AID` = :AID AND `Species` IS NOT NULL AND `Species` != ''");
        $check->bindValue(':AID', $aid);
        $check->execute();
        $rows = $check->fetch(PDO::FETCH_NUM);
        if ($rows[0] == 1 && $updateOk == 0 ) {
            echo "Error: animal already in database ";
            $link_address = "dbase.php?AID=" . $aid;
            echo "<a href='$link_address'>Return</a>";
            exit();
        }  
        $query = $pdo->prepare(" UPDATE `AnimalsInfo` "
                . "SET `Species` = :Species, `Breed` = :Breed, `Production` = :Production, `Sex` = :Sex,"
                . "`DOB` = :DOB, `AIDMother` = :AIDMother, `AIDFather` = :AIDFather, `OriginalOwnerName` = :ownnam,"
                . "`OriginalOwnerPhone` = :ownmob, `OriginalOwnerLat` = :lat, `OriginalOwnerLong` = :long, `PicPath` = :PicPath, `datetime` = :time"
                . " WHERE `AID` = :AID ;");
        $query->bindValue(':AID', $aid);
        $query->bindValue(':Species', $Specie);
        $query->bindValue(':Breed', $breed);
        $query->bindValue(':Production', $production);
        $query->bindValue(':Sex', $sex);
        $query->bindValue(':DOB', $bday);
        $query->bindValue(':AIDMother', $AIDMother);
        $query->bindValue(':AIDFather', $AIDFather);
        $query->bindValue(':ownnam', $ownnam);
        $query->bindValue(':ownmob', $ownmob);
        $query->bindValue(':lat', $lat);
        $query->bindValue(':long', $long);
        $query->bindValue(':PicPath', $path);
        $query->bindValue(':time', $time);
        $query->execute();
        $query = null;
        $pdo = null;
        echo "Animal registration successful! ";
        $link_address = "dbase.php?AID=" . $aid;
        echo "<a href='$link_address'>Return</a>";
        
    } catch (PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }    
}
else { 
    echo "Please submit the form. "; 
    $link_address = "dbase.php?";
    echo "<a href='$link_address'>Return</a>";
}
?>
