<?php

require('db-connect.php');

$shipid = $_GET['shipid'];
$ammoid = $_GET['ammoid'];


$sql = "DELETE FROM tSpaceship_Ammunition WHERE SpaceshipFID = '$shipid' AND AmmunitionholdFID = '$ammoid';";

$result = $conn->query($sql);


if ($result) {
    header('Location: ../View/fv_datenbank.php');
} else {
    echo "Es ist ein Fehler aufgetreten: " . $conn->error;
}
