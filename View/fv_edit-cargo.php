<?php

require('../Controller/db-connect.php');

session_start();

$id = 0;
$c_id = $_GET['c_id'];

if (!empty($_GET)) {

    $id = $_GET['id'];

    $sql = "SELECT * FROM tSpaceship
            JOIN tSpaceship_Cargo ON tSpaceship_Cargo.SpaceshipFID=tSpaceship.SpaceshipID
            JOIN tCargohold ON tCargohold.CargoholdID=tSpaceship_Cargo.CargoholdFID
            WHERE SpaceshipID = $id";

    $result = $conn->query($sql);

    $row = $result->fetch_assoc();
}

$sql2 = "SELECT Shipname, SpaceshipID FROM tSpaceship 
        ORDER BY SpaceshipID ASC;";
$result2 = $conn->query($sql2);

$sql3 = "SELECT * FROM tCargohold";
$result3 = $conn->query($sql3);

$sql4 = "SELECT * FROM tCargohold
        JOIN tSpaceship_Cargo ON tSpaceship_Cargo.CargoholdFID=tCargohold.CargoholdID
        JOIN tSpaceship ON tSpaceship.SpaceshipID=tSpaceship_Cargo.SpaceshipFID
        WHERE CargoholdID = '$c_id' AND SpaceshipID = '$id'";
$result4 = $conn->query($sql4);
$CargoholdID_ar = $result4->fetch_assoc();
$CargoholdID = $CargoholdID_ar['CargoholdID'];
$Cargoamount = $CargoholdID_ar['Cargoamount'];
$SpaceshipID = $CargoholdID_ar['SpaceshipID'];

$sql5 = "SELECT * FROM tCrew
        JOIN tCrew_Spaceship ON tCrew_Spaceship.CrewFID=tCrew.CrewID
        JOIn tSpaceship On tSpaceship.SpaceshipID=tCrew_Spaceship.SpaceshipFID
        WHERE CrewID = '$id'";
$result5 = $conn->query($sql5);
$Shipname_ar = $result5->fetch_assoc();
$Shipname = $Shipname_ar['Shipname'];



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Crew Hinzufügen</title>
</head>

<body>
    <div class="container">
        <h3 class="text-center"> Cargo Bearbeiten </h3>
        <form method="POST" action="../Controller/edit-crew.php">
            <div class="mb-3">
                <label for="Shipname" class="form-label">Shipname</label> <br>
                <select name="Shipname" class="custom-select custom-select-lg mb-3">
                    <?php while ($row2 = $result2->fetch_assoc()) { ?>
                        <option value="<?php echo $row2['SpaceshipID']; ?>" <?php if ($row2['SpaceshipID'] == $SpaceshipID) { ?> selected <?php }; ?>><?php echo $row2['Shipname']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="Cargoname" class="form-label">Cargoname</label> <br>
                <select name="Cargoname" class="custom-select custom-select-lg mb-3">
                    <?php while ($row3 = $result3->fetch_assoc()) { ?>
                        <option value="<?php echo $row3['CargoholdID']; ?>" <?php if ($row3['CargoholdID'] == $CargoholdID) { ?> selected <?php }; ?>><?php echo $row3['Cargoname']; ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="Birthday" class="form-label">Cargoamount</label>
                <input type="text" class="form-control" id="Birthday" name="Birthday" value="<?php echo $Cargoamount ?>">
            </div>
            <button type=" submit" name="submit" class="btn btn-primary">Submit</button>
            <a href="fv_datenbank.php" class="btn btn-danger">Zurück</a>
        </form>
    </div>

</body>