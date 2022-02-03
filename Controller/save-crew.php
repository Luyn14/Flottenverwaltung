<?php

require('db-connect.php');

$Prename = $_POST['Prename'];
$Lastname = $_POST['Lastname'];
$Birthday = $_POST['Birthday'];
$Password = $_POST['Password'];
$CrewroleFID = $_POST['CrewroleFID'];
$Shipname = $_POST['Shipname'];


$sql = "SELECT SpaceshipID FROM tSpaceship WHERE Shipname = '$Shipname';";

$result = $conn->query($sql);

$SpaceshipFID_ar = $result->fetch_assoc();

$SpaceshipFID = $SpaceshipFID_ar['SpaceshipID'];

$sql = "INSERT INTO tCrew (Prename, Lastname, Birthday, Password, CrewroleFID) VALUES ('$Prename', '$Lastname', '$Birthday', '$Password' ,$CrewroleFID);";

$result = $conn->query($sql);

$sql = "SELECT CrewID FROM tCrew WHERE Prename = '$Prename' AND Lastname = '$Lastname';";

$result = $conn->query($sql);

$CrewFID_ar = $result->fetch_assoc();

$CrewFID = $CrewFID_ar['CrewID'];

$sql = "INSERT INTO tCrew_Spaceship (CrewFID, SpaceshipFID) VALUES ($CrewFID, $SpaceshipFID);";

$result = $conn->query($sql);

if ($result) {
    header('Location: ../View/fv_uebersicht.php');
} else {
    echo "Es ist ein Fehler aufgetreten: " . $conn->error;
}
