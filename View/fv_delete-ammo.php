<?php

require('../Controller/db-connect.php');

session_start();
if (!isset($_SESSION['loggedIn']) || !$_SESSION['loggedIn']) {
    header('Location: flottenverwaltung_Titelseite.php');
}

$ammoid = 0;
$shipid = 0;

if (!empty($_GET)) {

    $ammoid = $_GET['ammoid'];
    $shipid = $_GET['shipid'];

    $sql = "SELECT * FROM tSpaceship_Ammunition 
            JOIN tAmmunitionhold ON tAmmunitionhold.AmmunitionholdID=tSpaceship_Ammunition.AmmunitionholdFID
            WHERE AmmunitionholdID = $ammoid AND SpaceshipFID = $shipid";

    $result = $conn->query($sql);

    $row = $result->fetch_assoc();
}

$sql2 = "SELECT Shipname, SpaceshipID FROM tSpaceship 
        ORDER BY SpaceshipID ASC;";
$result2 = $conn->query($sql2);
$row2 = $result2->fetch_assoc();

$sql3 = "SELECT * FROM tSpaceship 
        WHERE SpaceshipID = $shipid;";
$result3 = $conn->query($sql3);
$row3 = $result3->fetch_assoc();



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
    <title>Munition Entfernen</title>
</head>

<body>
    <h3 class="text-center"> Munition Entfernen </h3>
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
                                            <b>Raumschiff:</b>
                                        </td>
                                        <td><?php echo $row3['Shipname'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <b>Munitionsname:</b>
                                        </td>
                                        <td><?php echo $row['Ammunitionname'] ?></td>
                                    </tr>
                                </h3>
                                <h4>
                                    <tr>
                                        <td>
                                            <b>Munitionsmenge:</b>
                                        </td>
                                        <td><?php echo $row['Ammunitionamount'] ?></td>
                                    </tr>
                                </h4>
                            </table>
                            <div class="col text-center">
                                <div class="break">
                                    Munition entfernen?<br>
                                </div>
                                <div class="break2">
                                    <a href="../Controller/delete-ammo.php?shipid=<?php echo $shipid ?>&ammoid=<?php echo $ammoid ?>" class="btn btn-primary">Ja </a>
                                    <a href="fv_datenbank.php" class="btn btn-danger">Nein</a>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
    </form>

</body>