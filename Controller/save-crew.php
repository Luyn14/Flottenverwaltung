<?php

require('db-connect.php');

require('validation.php');

$validation = new Validation();

$Prename = "";
$Lastname = "";
$Birthday = "";
$Password = "";
$CrewroleFID = "";
$Shipname = "";

if (!empty($_POST)) {
    $Prename = $_POST['Prename'];
    $Lastname = $_POST['Lastname'];
    $Birthday = $_POST['Birthday'];
    $Password = $_POST['Password'];
    $CrewroleFID = $_POST['CrewroleFID'];
    $Shipname = $_POST['Shipname'];

    $isPrenameValid = $validation->validateText($Prename);
    $isLastnameValid = $validation->validateText($Lastname);
    $isBirthdayValid = $validation->validateText($Birthday);
    $isPasswordValid = $validation->validateText($Password);
    $isCrewroleFIDValid = $validation->validateNumber($CrewroleFID);
    $isShipnameValid = $validation->validateText($Shipname);
}



if ($isPrenameValid == true && $isLastnameValid == true && $isBirthdayValid == true && $isPasswordValid == true && $isCrewroleFIDValid == true && $isShipnameValid == true) {
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
} else {
    header("Location: ../view/fv_add-crew.php?Prename=$isPrenameValid&Lastname=$isLastnameValid&Birthday=$isBirthdayValid&Password=$isPasswordValid&CrewroleFID=$isCrewroleFIDValid&Shipname=$isShipnameValid");
}
