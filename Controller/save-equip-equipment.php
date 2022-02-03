<?php

require('db-connect.php');

$Equipmentname = $_POST['Equipmentname'];
$Equipmentsize = $_POST['Equipmentsize'];
$Equipmentamount = $_POST['Equipmentamount'];
$SpaceshipID = $_POST['SpaceshipID'];

$sql = "SELECT ShipequipmentID FROM tShipequipment WHERE Equipmentname = '$Equipmentname' AND Equipmentsize = $Equipmentsize;";

$result = $conn->query($sql);

$ShipequipmentID_ar = $result->fetch_assoc();

$ShipequipmentID = $ShipequipmentID_ar['ShipequipmentID'];

$sql = "INSERT INTO tSpaceship_Shipequipment (SpaceshipFID, ShipequipmentFID, Equipmentamount) VALUES ('$SpaceshipID', '$ShipequipmentID', '$Equipmentamount');";

$result = $conn->query($sql);

/*------------------------*/



if ($result) {
    header('Location: ../View/fv_uebersicht.php');
} else {
    echo "Es ist ein Fehler aufgetreten: " . $conn->error;
}
