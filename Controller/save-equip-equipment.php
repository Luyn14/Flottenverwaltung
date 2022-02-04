<?php

require('db-connect.php');

require('validation.php');

$validation = new Validation();

$Equipmentamount = "";

if (!empty($_POST)) {

    $Equipmentamount = $_POST['Equipmentamount'];

    $isEquipmentamountValid = $validation->validateText($Equipmentamount);
}

$Equipmentname = $_POST['Equipmentname'];
$Equipmentsize = $_POST['Equipmentsize'];
$SpaceshipID = $_POST['SpaceshipID'];


if ($isEquipmentamountValid == true) {
    $sql = "SELECT ShipequipmentID FROM tShipequipment WHERE Equipmentname = '$Equipmentname' AND Equipmentsize = $Equipmentsize;";

    $result = $conn->query($sql);

    $ShipequipmentID_ar = $result->fetch_assoc();

    $ShipequipmentID = $ShipequipmentID_ar['ShipequipmentID'];

    $sql = "INSERT INTO tSpaceship_Shipequipment (SpaceshipFID, ShipequipmentFID, Equipmentamount) VALUES ('$SpaceshipID', '$ShipequipmentID', '$Equipmentamount');";

    $result = $conn->query($sql);

    /*------------------------*/



    if ($result) {
        header('Location: ../View/fv_uebersicht.php');
    } else {
        echo "Es ist ein Fehler aufgetreten: " . $conn->error;
    }
} else {
    header("Location: ../view/fv_equip-equipment.php?Equipmentamount=$isEquipmentamountValid");
}
