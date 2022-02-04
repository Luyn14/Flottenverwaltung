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
$CrewID = $_GET['CrewID'];

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
} else {
    header("Location: ../view/fv_edit-crew.php?id=$CrewID&Prename=$isPrenameValid&Lastname=$isLastnameValid&Birthday=$isBirthdayValid&Password=$isPasswordValid&CrewroleFID=$isCrewroleFIDValid&Shipname=$isShipnameValid");
}
