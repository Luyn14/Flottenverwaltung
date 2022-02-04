<?php

require('../Controller/db-connect.php');

session_start();
if (!isset($_SESSION['loggedIn']) || !$_SESSION['loggedIn']) {
    header('Location: flottenverwaltung_Titelseite.php');
}

$cargoid = 0;
$shipid = 0;

if (!empty($_GET)) {

    $cargoid = $_GET['cargoid'];
    $shipid = $_GET['shipid'];

    $sql = "SELECT * FROM tSpaceship_Cargo 
            JOIN tCargohold ON tCargohold.CargoholdID=tSpaceship_Cargo.CargoholdFID
            WHERE CargoholdID = $cargoid AND SpaceshipFID = $shipid";

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
    <title>Fracht Entfernen</title>
</head>

<body>
    <h3 class="text-center"> Fracht Entfernen </h3>
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
                                            <b>Frachtname:</b>
                                        </td>
                                        <td><?php echo $row['Cargoname'] ?></td>
                                    </tr>
                                </h3>
                                <h4>
                                    <tr>
                                        <td>
                                            <b>Frachtmenge:</b>
                                        </td>
                                        <td><?php echo $row['Cargoamount'] ?></td>
                                    </tr>
                                </h4>
                            </table>
                            <div class="col text-center">
                                <div class="break">
                                    Fracht entfernen?<br>
                                </div>
                                <div class="break2">
                                    <a href="../Controller/delete-cargo.php?shipid=<?php echo $shipid ?>&cargoid=<?php echo $cargoid ?>" class="btn btn-primary">Ja </a>
                                    <a href="fv_datenbank.php" class="btn btn-danger">Nein</a>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
    </form>

</body>