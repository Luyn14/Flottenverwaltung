<?php

require('../Controller/db-connect.php');

session_start();

$id = 0;

if (!empty($_GET)) {

    $id = $_GET['id'];

    $sql = "SELECT * FROM tSpaceship 
            JOIN tDivision ON tDivision.DivisionID=tSpaceship.DivisionFID
            JOIN tSpaceshiprole ON tSpaceshiprole.SpaceshiproleID=tSpaceship.SpaceshiproleFID
            WHERE SpaceshipID = $id";

    $result = $conn->query($sql);

    $row = $result->fetch_assoc();
}

$sql2 = "SELECT Shipname, SpaceshipID FROM tSpaceship 
        ORDER BY SpaceshipID ASC;";
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
    <title>Raumschiff Löschen</title>
</head>

<body>
    <h3 class="text-center"> Raumschiff Löschen </h3>
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
                                            <b>SpaceshipID:</b>
                                        </td>
                                        <td><?php echo $row['SpaceshipID'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <b>Shipname:</b>
                                        </td>
                                        <td><?php echo $row['Shipname'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <b>Shiprole:</b>
                                        </td>
                                        <td><?php echo $row['Rolename'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <b>Divisionname:</b>
                                        </td>
                                        <td><?php echo $row['Divisionname'] ?></td>
                                    </tr>
                                </h3>
                            </table>
                            <div class="col text-center">
                                <div class="break">
                                    Raumschiff entfernen?<br>
                                </div>
                                <div class="break2">
                                    <a href="../Controller/delete-spaceship.php?SpaceshipID=<?php echo $id ?>" class="btn btn-primary">Ja </a>
                                    <a href="fv_uebersicht.php" class="btn btn-danger">Nein</a>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            <label for="CrewID"></label>

    </form>

</body>