<?php

require('db-connect.php');

require('validation.php');

$validation = new Validation();

$Ammunitionname = "";
$Ammunitionamount = "";
$Shipname = "";

if (!empty($_POST)) {
    $Ammunitionname = $_POST['Ammunitionname'];
    $Ammunitionamount = $_POST['Ammunitionamount'];
    $Shipname = $_POST['Shipname'];

    $isAmmunitionamountValid = $validation->validateText($Ammunitionamount);
}

if ($isAmmunitionamountValid == true) {

    $sql = "SELECT AmmunitionholdID FROM tAmmunitionhold WHERE Ammunitionname = '$Ammunitionname';";

    $result = $conn->query($sql);

    $AmmunitionholdFID_ar = $result->fetch_assoc();

    $AmmunitionholdFID = $AmmunitionholdFID_ar['AmmunitionholdID'];

    $sql = "SELECT SpaceshipID FROM tSpaceship WHERE Shipname = '$Shipname';";

    $result = $conn->query($sql);

    $SpaceshipFID_ar = $result->fetch_assoc();

    $SpaceshipFID = $SpaceshipFID_ar['SpaceshipID'];

    $sql = "INSERT INTO tSpaceship_Ammunition (SpaceshipFID, AmmunitionholdFID, Ammunitionamount) VALUES ($SpaceshipFID, $AmmunitionholdFID, $Ammunitionamount);";

    $result = $conn->query($sql);

    if ($result) {
        header('Location: ../View/fv_datenbank.php');
    } else {
        echo "Es ist ein Fehler aufgetreten: " . $conn->error;
    }
} else {
    header("Location: ../view/fv_add-ammo.php?Ammunitionamount=$isAmmunitionamountValid");
}
