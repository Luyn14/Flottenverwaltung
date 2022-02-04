<?php

require('db-connect.php');

$Ammunitionamount = $_POST['Ammunitionamount'];
$AmmunitionID = $_GET['aid'];
$ShipID = $_GET['sid'];


$sql = "UPDATE tSpaceship_Ammunition SET Ammunitionamount ='$Ammunitionamount'
WHERE AmmunitionholdFID = $AmmunitionID;";

$result = $conn->query($sql);

if ($result) {
    header('Location: ../View/fv_datenbank.php');
} else {
    echo "Es ist ein Fehler aufgetreten: " . $conn->error;
}
