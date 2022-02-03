<?php

require('../Controller/db-connect.php');

session_start();

$sql1 = "SELECT * FROM tDivision ORDER BY DivisionID ASC;";
$result1 = $conn->query($sql1);

$sql2 = "SELECT * FROM tSpaceshiprole ORDER BY SpaceshiproleID ASC;";
$result2 = $conn->query($sql2);

$sql3 = "SELECT * FROM tDestination ORDER BY DestinationID ASC;";
$result3 = $conn->query($sql3);

$sql4 = "SELECT * FROM tMoon ORDER BY MoonID ASC;";
$result4 = $conn->query($sql4);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Raumschiff Hinzufügen</title>
</head>

<body>
    <h3 class="text-center"> Neues Raumschiff erfassen </h3>
    <form method="POST" action="../Controller/save-spaceship.php">
        <input type="hidden" name="id" value="">
        <div class="mb-3">
            <label for="Shipname" class="form-label">Shipname</label>
            <input type="text" class="form-control" id="Shipname" aria-describedby="emailHelp" name="Shipname" value="">
        </div>
        <div class="mb-3">
            <label for="DivisionID" class="form-label">Division</label> <br>
            <select name="DivisionID" class="custom-select custom-select-lg mb-3">
                <?php while ($row1 = $result1->fetch_assoc()) { ?>
                    <option value="<?php echo $row1['DivisionID']; ?>"><?php echo $row1['Divisionname']; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="ShiproleID" class="form-label">Shiprole</label> <br>
            <select name="ShiproleID" class="custom-select custom-select-lg mb-3">
                <?php while ($row2 = $result2->fetch_assoc()) { ?>
                    <option value="<?php echo $row2['SpaceshiproleID']; ?>"><?php echo $row2['Rolename']; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="DestinationID" class="form-label">Planet</label> <br>
            <select name="DestinationID" id="DestinationID" class="custom-select custom-select-lg mb-3" onchange="availableMoons()">
                <?php while ($row3 = $result3->fetch_assoc()) { ?>
                    <option value="<?php echo $row3['DestinationID']; ?>"><?php echo $row3['Destinationname']; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="MoonID" class="form-label">Moon</label> <br>
            <select name="MoonID" id="MoonID" class="custom-select custom-select-lg mb-3">
                <?php while ($row4 = $result4->fetch_assoc()) { ?>
                    <option value="<?php echo $row4['MoonID']; ?>"><?php echo $row4['Moonname']; ?></option>
                <?php } ?>
            </select>
        </div>
        <button type=" submit" name="submit" class="btn btn-primary">Submit</button>
        <a href="fv_uebersicht.php" class="btn btn-danger">Zurück</a>
    </form>

</body>