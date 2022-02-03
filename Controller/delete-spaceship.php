<?php

require('db-connect.php');

$SpaceshipID = $_GET['SpaceshipID'];


$sql = "DELETE FROM tSpaceship WHERE SpaceshipID = '$SpaceshipID';";

$result = $conn->query($sql);


if ($result) {
    header('Location: ../View/fv_uebersicht.php');
} else {
    echo "Es ist ein Fehler aufgetreten: " . $conn->error;
}
