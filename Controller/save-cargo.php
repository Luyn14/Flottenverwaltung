<?php

require('db-connect.php');

$Cargoname = $_POST['Cargoname'];
$Cargoamount = $_POST['Cargoamount'];
$Shipname = $_POST['Shipname'];


$sql = "SELECT CargoholdID FROM tCargohold WHERE Cargoname = '$Cargoname';";

$result = $conn->query($sql);

$CargoholdFID_ar = $result->fetch_assoc();

$CargoholdFID = $CargoholdFID_ar['CargoholdID'];

$sql = "SELECT SpaceshipID FROM tSpaceship WHERE Shipname = '$Shipname';";

$result = $conn->query($sql);

$SpaceshipFID_ar = $result->fetch_assoc();

$SpaceshipFID = $SpaceshipFID_ar['SpaceshipID'];

$sql = "INSERT INTO tSpaceship_Cargo (SpaceshipFID, CargoholdFID, Cargoamount) VALUES ($SpaceshipFID, $CargoholdFID, $Cargoamount);";

$result = $conn->query($sql);

if ($result) {
    header('Location: ../View/fv_datenbank.php');
} else {
    echo "Es ist ein Fehler aufgetreten: " . $conn->error;
}
