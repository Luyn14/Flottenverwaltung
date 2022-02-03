<?php

require('../Controller/db-connect.php');

session_start();

$sql1 = "SELECT * FROM tShipequipment WHERE Equipmentsize = 1 ORDER BY ShipequipmentID ASC;";
$result1 = $conn->query($sql1);

$sql2 = "SELECT * FROM tShipequipment WHERE Equipmentname = 'Shieldgenerator' ORDER BY Equipmentsize ASC;";
$result2 = $conn->query($sql2);

$sql3 = "SELECT * FROM tSpaceship ORDER BY SpaceshipID ASC;";
$result3 = $conn->query($sql3);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Equipment Ausrüsten</title>
</head>

<body>
    <h3 class="text-center">Equipment ausrüsten </h3>
    <form method="POST" action="../Controller/save-equip-equipment.php">
        <input type="hidden" name="id" value="">
        <div class="mb-3">
            <label for="Equipmentname" class="form-label">Equipmentname</label> <br>
            <select name="Equipmentname" class="custom-select custom-select-lg mb-3">
                <?php while ($row1 = $result1->fetch_assoc()) { ?>
                    <option value="<?php echo $row1['Equipmentname']; ?>"><?php echo $row1['Equipmentname']; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="Equipmentsize" class="form-label">Equipmentgrösse</label> <br>
            <select name="Equipmentsize" class="custom-select custom-select-lg mb-3">
                <?php while ($row2 = $result2->fetch_assoc()) { ?>
                    <option value="<?php echo $row2['Equipmentsize']; ?>"><?php echo $row2['Equipmentsize']; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="Equipmentamount" class="form-label">Equipmentamount</label>
            <input type="text" class="form-control" id="Equipmentamount" aria-describedby="emailHelp" name="Equipmentamount" value="">
        </div>
        <div class="mb-3">
            <label for="SpaceshipID" class="form-label">Shipname</label> <br>
            <select name="SpaceshipID" id="SpaceshipID" class="custom-select custom-select-lg mb-3">
                <?php while ($row3 = $result3->fetch_assoc()) { ?>
                    <option value="<?php echo $row3['SpaceshipID']; ?>"><?php echo $row3['Shipname']; ?></option>
                <?php } ?>
            </select>
        </div>

        <button type=" submit" name="submit" class="btn btn-primary">Submit</button>
        <a href="fv_datenbank.php" class="btn btn-danger">Zurück</a>
    </form>

</body>