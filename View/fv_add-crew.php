<?php

require('../Controller/db-connect.php');

session_start();

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
    <title>Crew Hinzufügen</title>
</head>

<body>
    <h3 class="text-center"> Neues Crewmitglied erfassen </h3>
    <form method="POST" action="../Controller/save-crew.php">
        <input type="hidden" name="id" value="">
        <div class="mb-3">
            <label for="Prename" class="form-label">Firstname</label>
            <input type="text" class="form-control" id="Prename" aria-describedby="emailHelp" name="Prename" value="">
        </div>
        <div class="mb-3">
            <label for="Lastname" class="form-label">Lastname</label>
            <input type="text" class="form-control" id="Lastname" name="Lastname" value="">
        </div>
        <div class="mb-3">
            <label for="Birthday" class="form-label">Birthday</label>
            <input type="text" class="form-control" id="Birthday" name="Birthday" value="">
        </div>
        <div class="mb-3">
            <label for="Password" class="form-label">Password</label>
            <input type="text" class="form-control" id="Password" name="Password" value="">
        </div>
        <div class="mb-3">
            <label for="CrewroleFID" class="form-label">Crewrole</label> <br>
            <select name="CrewroleFID" class="custom-select custom-select-lg mb-3">
                <?php while ($row3 = $result3->fetch_assoc()) { ?>
                    <option value="<?php echo $row3['CrewroleID']; ?>"><?php echo $row3['Rolename']; ?></option>
                <?php } ?>
            </select>
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
        <a href="fv_uebersicht.php" class="btn btn-danger">Zurück</a>
    </form>

</body>