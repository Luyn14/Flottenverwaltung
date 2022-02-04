<?php

require('../Controller/db-connect.php');

session_start();
if (!isset($_SESSION['loggedIn']) || !$_SESSION['loggedIn']) {
    header('Location: flottenverwaltung_Titelseite.php');
}

$eid = 0;
$sid = 0;

if (!empty($_GET)) {

    $eid = $_GET['eid'];
    $sid = $_GET['sid'];

    $sql = "SELECT * FROM tShipequipment 
    JOIN tSpaceship_Shipequipment ON tSpaceship_Shipequipment.ShipequipmentFID=tShipequipment.ShipequipmentID
    WHERE ShipequipmentID = $eid AND SpaceshipFID = $sid;";

    $result = $conn->query($sql);

    $row = $result->fetch_assoc();
}

$sql2 = "SELECT Shipname, SpaceshipID FROM tSpaceship 
        WHERE SpaceshipID = $sid;";
$result2 = $conn->query($sql2);
$row2 = $result2->fetch_assoc();



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="stylesheet.css">
    <script src="../Controller/javascript.js"></script>
    <title>Crew Entfernen</title>
</head>

<body>
    <h3 class="text-center"> Equipment Abrüsten </h3>
    <form method="POST" action="">
        <div class="container">
            <div class="center">
                <div class="col">
                    <div class="card" style="width: 25rem;">
                        <h4 class="card-body">
                            <table style="width:100%">
                                <h3>
                                    <tr>
                                        <td>
                                            <b>Equipmentname:</b>
                                        </td>
                                        <td><?php echo $row['Equipmentname'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <b>Equipmentsize:</b>
                                        </td>
                                        <td><?php echo $row['Equipmentsize'] ?></td>
                                    </tr>
                                </h3>
                                <h4>
                                    <tr>
                                        <td>
                                            <b>Equipmentamount:</b>
                                        </td>
                                        <td><?php echo $row['Equipmentamount'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <b>Spaceship:</b>
                                        </td>
                                        <td><?php echo $row2['Shipname'] ?></td>
                                    </tr>
                                </h4>
                            </table>
                            <div class="col text-center">
                                <div class="break">
                                    Equipment abrüsten?<br>
                                </div>
                                <div class="break2">
                                    <a href="../Controller/unequip-equipment.php?eid=<?php echo $eid ?>&sid=<?php echo $sid ?>" class="btn btn-primary">Ja </a>
                                    <a href="fv_uebersicht.php" class="btn btn-danger">Nein</a>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
    </form>

</body>