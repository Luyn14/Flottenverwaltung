<?php

require('../Controller/db-connect.php');


$sql2 = "SELECT Shipname, SpaceshipID FROM tSpaceship ORDER BY SpaceshipID ASC;";
$result2 = $conn->query($sql2);

$sql3 = "SELECT * FROM tCrewrole";
$result3 = $conn->query($sql3);

$isPrenameValid = True;
$isLastnameValid = True;
$isBirthdayValid = True;
$isPasswordValid = True;
$isCrewroleFIDValid = True;
$isShipnameValid = True;

if (isset($_GET['Prename'])) {
    $isPrenameValid = $_GET['Prename'];
    $isLastnameValid = $_GET['Lastname'];
    $isBirthdayValid = $_GET['Birthday'];
    $isPasswordValid = $_GET['Password'];
    $isCrewroleFIDValid = $_GET['CrewroleFID'];
    $isShipnameValid = $_GET['Shipname'];
}
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
    <title>Crew Hinzufügen</title>
    <style>
        body {
            background-image: url("");
            background-color: #FFFFFF;
        }
    </style>
</head>

<body>
    <div class="container">
        <h3 class="text-center"> Neues Crewmitglied erfassen </h3>
        <form method="POST" class="needs-validation" novalidate action="../Controller/save-crew.php">
            <input type="hidden" name="id" value="">
            <div class="mb-3">
                <label for="Prename" class="form-label">Firstname</label>
                <input type="text" class="form-control" id="Prename" aria-describedby="emailHelp" name="Prename" value="" required>
                <?php if ($isPrenameValid == false) { ?>
                    <h6 id="notValid">Vorname fehlt, ist falsch!</h6>
                <?php } ?>
            </div>
            <div class="mb-3">
                <label for="Lastname" class="form-label">Lastname</label>
                <input type="text" class="form-control" id="Lastname" name="Lastname" value="" required>
                <?php if ($isLastnameValid == false) { ?>
                    <h6 id="notValid">Nachname fehlt, ist falsch!</h6>
                <?php } ?>
            </div>
            <div class="mb-3">
                <label for="Birthday" class="form-label">Birthday</label>
                <input type="text" class="form-control" id="Birthday" name="Birthday" value="" required>
                <?php if ($isBirthdayValid == false) { ?>
                    <h6 id="notValid">Geburtstag fehlt, ist falsch!</h6>
                <?php } ?>
            </div>
            <div class="mb-3">
                <label for="Password" class="form-label">Password</label>
                <input type="text" class="form-control" id="Password" name="Password" value="" required>
                <?php if ($isPasswordValid == false) { ?>
                    <h6 id="notValid">Passwort fehlt, ist falsch!</h6>
                <?php } ?>
            </div>
            <div class="mb-3">
                <label for="CrewroleFID" class="form-label">Crewrole</label> <br>
                <select name="CrewroleFID" class="custom-select custom-select-lg mb-3">
                    <?php while ($row3 = $result3->fetch_assoc()) { ?>
                        <option value="<?php echo $row3['CrewroleID']; ?>"><?php echo $row3['Rolename']; ?></option>
                    <?php } ?>
                </select>
                <?php if ($isCrewroleFIDValid == false) { ?>
                    <h6 id="notValid">Crewrole fehlt!</h6>
                <?php } ?>
            </div>
            <div class="mb-3">
                <label for="Shipname" class="form-label">Spaceshipname</label> <br>
                <select name="Shipname" class="custom-select custom-select-lg mb-3">
                    <?php while ($row2 = $result2->fetch_assoc()) { ?>
                        <option value="<?php echo $row2['Shipname']; ?>"><?php echo $row2['Shipname']; ?></option>
                    <?php } ?>
                </select>
                <?php if ($isShipnameValid == false) { ?>
                    <h6 id="notValid">Schiffsname fehlt, ist falsch!</h6>
                <?php } ?>
            </div>
            <button type=" submit" name="submit" class="btn btn-primary">Submit</button>
            <a href="fv_uebersicht.php" class="btn btn-danger">Zurück</a>
        </form>
    </div>
</body>