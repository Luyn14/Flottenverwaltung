<?php

require('db-connect.php');

require('validation.php');

$validation = new Validation();

$Shipname = "";

if (!empty($_POST)) {

    $Shipname = $_POST['Shipname'];

    $isShipnameValid = $validation->validateText($Shipname);
}

$DivisionID = $_POST['DivisionID'];
$ShiproleID = $_POST['ShiproleID'];
$DestinationID = $_POST['DestinationID'];
$MoonID = $_POST['MoonID'];

if ($isShipnameValid == true) {

    $sql = "SELECT DestmoonID FROM tDest_Moon WHERE DestinationFID = '$DestinationID' AND MoonFID = '$MoonID';";

    $result = $conn->query($sql);

    $DestmoonID_ar = $result->fetch_assoc();

    $DestmoonID = $DestmoonID_ar['DestmoonID'];

    $sql = "INSERT INTO tSpaceship (Shipname, DivisionFID, SpaceshiproleFID, DestmoonFID) VALUES ('$Shipname', '$DivisionID', '$ShiproleID', '$DestmoonID');";

    $result = $conn->query($sql);

    /*------------------------*/



    if ($result) {
        header('Location: ../View/fv_uebersicht.php');
    } else {
        echo "Es ist ein Fehler aufgetreten: " . $conn->error;
    }
} else {
    header("Location: ../view/fv_add-spaceship.php?Shipname=$isShipnameValid");
}
