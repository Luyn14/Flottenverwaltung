<?php

require('db-connect.php');

$Cargoamount = $_POST['Cargoamount'];
$CargoID = $_GET['cid'];
$ShipID = $_GET['sid'];


$sql = "UPDATE tSpaceship_Cargo SET Cargoamount ='$Cargoamount'
WHERE CargoholdFID = $CargoID;";

$result = $conn->query($sql);

if ($result) {
    header('Location: ../View/fv_datenbank.php');
} else {
    echo "Es ist ein Fehler aufgetreten: " . $conn->error;
}
