<?php

require('db-connect.php');

$Prename = $_POST['Prename'];
$Lastname = $_POST['Lastname'];
$Birthday = $_POST['Birthday'];
$Password = $_POST['Password'];
$CrewroleFID = $_POST['CrewroleFID'];
$Shipname = $_POST['Shipname'];
$CrewID = $_POST['CrewID'];


$sql = "UPDATE tCrew SET Prename = '$Prename', Lastname = '$Lastname', Birthday = '$Birthday', Password = '$Password', CrewroleFID = '$CrewroleFID'
WHERE CrewID = $CrewID;";

$result = $conn->query($sql);

$sql = "SELECT SpaceshipID FROM tSpaceship WHERE Shipname = '$Shipname';";

$result = $conn->query($sql);

$SpaceshipFID_ar = $result->fetch_assoc();

$SpaceshipFID = $SpaceshipFID_ar['SpaceshipID'];

$sql = "UPDATE tCrew_Spaceship SET SpaceshipFID ='$SpaceshipFID'
WHERE CrewFID = $CrewID;";

$result = $conn->query($sql);

if ($result) {
    header('Location: ../View/fv_uebersicht.php');
} else {
    echo "Es ist ein Fehler aufgetreten: " . $conn->error;
}
