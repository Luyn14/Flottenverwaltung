<?php

require('db-connect.php');

$CrewID = $_GET['CrewID'];


$sql = "DELETE FROM tCrew WHERE CrewID = '$CrewID';";

$result = $conn->query($sql);


if ($result) {
    header('Location: ../View/fv_uebersicht.php');
} else {
    echo "Es ist ein Fehler aufgetreten: " . $conn->error;
}
