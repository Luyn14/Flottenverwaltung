<?php

require('../Controller/db-connect.php');

session_start();

$sql1 = "SELECT * FROM tCargohold ORDER BY CargoholdID ASC;";
$result1 = $conn->query($sql1);

$sql2 = "SELECT Shipname, SpaceshipID FROM tSpaceship ORDER BY SpaceshipID ASC;";
$result2 = $conn->query($sql2);

$sql3 = "SELECT * FROM tCrewrole";
$result3 = $conn->query($sql3);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Fracht Hinzufügen</title>
</head>

<body>
    <h3 class="text-center"> Neue Fracht erfassen </h3>
    <form method="POST" action="../Controller/save-cargo.php">
        <input type="hidden" name="id" value="">
        <label for="Cargoname" class="form-label">Cargoname</label> <br>
        <select name="Cargoname" class="custom-select custom-select-lg mb-3">
            <?php while ($row1 = $result1->fetch_assoc()) { ?>
                <option value="<?php echo $row1['Cargoname']; ?>"><?php echo $row1['Cargoname']; ?></option>
            <?php } ?>
        </select>
        <div class="mb-3">
            <label for="Cargoamount" class="form-label">Cargoamount</label>
            <input type="text" class="form-control" id="Cargoamount" name="Cargoamount" value="">
        </div>
        <div class="mb-3">
            <label for="Shipname" class="form-label">Spaceshipname</label> <br>
            <select name="Shipname" class="custom-select custom-select-lg mb-3">
                <?php while ($row2 = $result2->fetch_assoc()) { ?>
                    <option value="<?php echo $row2['Shipname']; ?>"><?php echo $row2['Shipname']; ?></option>
                <?php } ?>
            </select>
        </div>
        <button type=" submit" name="submit" class="btn btn-primary">Submit</button>
        <a href="fv_datenbank.php" class="btn btn-danger">Zurück</a>
    </form>

</body>