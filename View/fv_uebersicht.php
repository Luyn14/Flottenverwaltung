<?php
require('../Controller/db-connect.php');

session_start();
if (!isset($_SESSION['loggedIn']) || !$_SESSION['loggedIn']) {
    header('Location: flottenverwaltung_Titelseite.php');
}

$sql1 = "SELECT * FROM tSpaceship 
        JOIN tSpaceshiprole ON tSpaceshiprole.SpaceshiproleID=tSpaceship.SpaceshiproleFID
        JOIN tDivision ON tDivision.DivisionID=tSpaceship.DivisionFID
        JOIN tFleet ON tFleet.FleetID=tDivision.FleetFID
        JOIN tDest_Moon ON tDest_Moon.DestmoonID=tSpaceship.DestmoonFID
        JOIN tMoon ON tMoon.MoonID=tDest_Moon.MoonFID
        JOIN tDestination ON tDestination.DestinationID=tDest_Moon.DestinationFID
        ORDER BY SpaceshipID ASC";
$result1 = $conn->query($sql1);

$sql2 = "SELECT * FROM tCrew 
        JOIN tCrewRole ON tCrewRole.CrewroleID=tCrew.CrewroleFID
        JOIN tCrew_Spaceship ON tCrew_Spaceship.CrewFID=tCrew.CrewID
        JOIN tSpaceship ON tSpaceship.SpaceshipID=tCrew_Spaceship.SpaceshipFID
        ORDER BY CrewID ASC";
$result2 = $conn->query($sql2);

$sql3 = "SELECT * FROM tShipequipment 
        JOIN tSpaceship_Shipequipment ON tSpaceship_Shipequipment.ShipequipmentFID=tShipequipment.ShipequipmentID
        JOIN tSpaceship ON tSpaceship.SpaceshipID=tSpaceship_Shipequipment.SpaceshipFID
        ORDER BY ShipequipmentID ASC, Equipmentsize ASC, Equipmentamount ASC";
$result3 = $conn->query($sql3);

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
    <title>Flotten-Übersicht</title>
</head>

<body>
    <div class="container">
        <h1 class="text-center" id="text-underlay-log"> Flotten-Übersicht </h1>
    </div>
    <div class="container">
        <button type="button" class="btn btn-info" onclick="myCrew()">Crew</button>
        <button type="button" class="btn btn-info" onclick="myShip()">Ship</button>
        <button type="button" class="btn btn-info" onclick="myEquipment()">Equipment</button>
        <div id="crew_style">
            <h1 class="text-center">Crew</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">CrewID</th>
                        <th scope="col">Prename</th>
                        <th scope="col">Lastname</th>
                        <th scope="col">Birthday</th>
                        <th scope="col">Password</th>
                        <th scope="col">Crewrole</th>
                        <th scope="col">Spaceship</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row2 = $result2->fetch_assoc()) {

                    ?>

                        <tr>
                            <th scope="row"><?php echo $row2['CrewID'] ?></th>
                            <td><?php echo $row2['Prename'] ?></td>
                            <td><?php echo $row2['Lastname'] ?></td>
                            <td><?php echo $row2['Birthday'] ?></td>
                            <td><?php echo $row2['Password'] ?></td>
                            <td><?php echo $row2['Rolename'] ?></td>
                            <td><?php echo $row2['Shipname'] ?></td>
                            <td><a href="fv_edit-crew.php?id=<?php echo $row2['CrewID']; ?>" class="btn btn-primary">Bearbeiten</a>
                            <td><a href="fv_delete-crew.php?id=<?php echo $row2['CrewID']; ?>" class="btn btn-danger">Löschen</a>

                        </tr>

                    <?php

                    }

                    ?>
                </tbody>
            </table>
            <a href="fv_add-crew.php" class="btn btn-primary">Neues Crew Mitglied</a>
        </div>
        <div id="ship_style">
            <h1 class="text-center">Ship</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">SpaceshipID</th>
                        <th scope="col">Shipname</th>
                        <th scope="col">Shiprole</th>
                        <th scope="col">Divisionname</th>
                        <th scope="col">Planetenname</th>
                        <th scope="col">Mondname / Planetside</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row1 = $result1->fetch_assoc()) {

                    ?>

                        <tr>
                            <th scope="row"><?php echo $row1['SpaceshipID'] ?></th>
                            <td><?php echo $row1['Shipname'] ?></td>
                            <td><?php echo $row1['Rolename'] ?></td>
                            <td><?php echo $row1['Divisionname'] ?></td>
                            <td><?php echo $row1['Destinationname'] ?></td>
                            <td><?php echo $row1['Moonname'] ?></td>
                            <td><a href="fv_delete-spaceship.php?id=<?php echo $row1['SpaceshipID']; ?>" class="btn btn-danger">Löschen</a>

                        </tr>

                    <?php

                    }

                    ?>
                </tbody>
            </table>
            <a href="fv_add-spaceship.php" class="btn btn-primary">Neues Raumschiff hinzufügen</a>
        </div>
        <div id="equipment_style">
            <h1 class="text-center">Equipment</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">EquipmentID</th>
                        <th scope="col">Equipmentname</th>
                        <th scope="col">Equipmentsize</th>
                        <th scope="col">Equipmentamount</th>
                        <th scope="col">Shipname</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row3 = $result3->fetch_assoc()) {

                    ?>

                        <tr>
                            <th scope="row"><?php echo $row3['ShipequipmentID'] ?></th>
                            <td><?php echo $row3['Equipmentname'] ?></td>
                            <td><?php echo $row3['Equipmentsize'] ?></td>
                            <td><?php echo $row3['Equipmentamount'] ?></td>
                            <td><?php echo $row3['Shipname'] ?></td>
                            <td><a href="fv_unequip-equipment.php?eid=<?php echo $row3['ShipequipmentID'] ?>&sid=<?php echo $row3['SpaceshipID']; ?>" class="btn btn-danger">Löschen</a>
                        </tr>

                    <?php

                    }

                    ?>
                </tbody>
            </table>
            <a href="fv_equip-equipment.php" class="btn btn-primary">Equipment ausrüsten</a>
        </div>
    </div>
    <div class="container">
        <br>
        <a href="flottenverwaltung_Login.php" class="btn btn-danger">Zurück</a>

    </div>
</body>

</html>