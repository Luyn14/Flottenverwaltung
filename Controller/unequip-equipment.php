<?php

require('db-connect.php');

$eid = $_GET['eid'];
$sid = $_GET['sid'];


$sql = "DELETE FROM tSpaceship_Shipequipment WHERE SpaceshipFID = '$sid' AND ShipequipmentFID = '$eid';";

$result = $conn->query($sql);


if ($result) {
    header('Location: ../View/fv_uebersicht.php');
} else {
    echo "Es ist ein Fehler aufgetreten: " . $conn->error;
}
