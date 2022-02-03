<?php

require('db-connect.php');

$shipid = $_GET['shipid'];
$cargoid = $_GET['cargoid'];


$sql = "DELETE FROM tSpaceship_Cargo WHERE SpaceshipFID = '$shipid' AND CargoholdFID = '$cargoid';";

$result = $conn->query($sql);


if ($result) {
    header('Location: ../View/fv_datenbank.php');
} else {
    echo "Es ist ein Fehler aufgetreten: " . $conn->error;
}
