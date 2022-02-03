<?php

require('../Controller/db-connect.php');

session_start();

$id = 0;

if (!empty($_GET)) {

    $id = $_GET['id'];

    $sql = "SELECT * FROM tCrew 
            JOIN tCrewrole ON tCrewrole.CrewroleID=tCrew.CrewroleFID
            WHERE CrewID = $id";

    $result = $conn->query($sql);

    $row = $result->fetch_assoc();
}

$sql2 = "SELECT Shipname, SpaceshipID FROM tSpaceship 
        ORDER BY SpaceshipID ASC;";
$result2 = $conn->query($sql2);

$sql3 = "SELECT * FROM tCrewrole";
$result3 = $conn->query($sql3);

$sql4 = "SELECT * FROM tCrew
        JOIN tCrewrole ON tCrewrole.CrewroleID=tCrew.CrewroleFID
        WHERE CrewID = '$id'";
$result4 = $conn->query($sql4);
$CrewroleID_ar = $result4->fetch_assoc();
$CrewroleID = $CrewroleID_ar['CrewroleID'];

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
    <h3 class="text-center"> Crewmitglied Bearbeiten </h3>
    <form method="POST" action="../Controller/edit-crew.php">
        <input type="hidden" name="id" value="">
        <div class="mb-3">
            <label for="Prename" class="form-label">Firstname</label>
            <input type="text" class="form-control" id="Prename" aria-describedby="emailHelp" name="Prename" value="<?php if (isset($row)) {
                                                                                                                        echo $row['Prename'];
                                                                                                                    } ?>">
        </div>
        <div class="mb-3">
            <label for="Lastname" class="form-label">Lastname</label>
            <input type="text" class="form-control" id="Lastname" name="Lastname" value="<?php if (isset($row)) {
                                                                                                echo $row['Lastname'];
                                                                                            } ?>">
        </div>
        <div class="mb-3">
            <label for="Birthday" class="form-label">Birthday</label>
            <input type="text" class="form-control" id="Birthday" name="Birthday" value="<?php if (isset($row)) {
                                                                                                echo $row['Birthday'];
                                                                                            } ?>">
        </div>
        <div class=" mb-3">
            <label for="Password" class="form-label">Password</label>
            <input type="text" class="form-control" id="Password" name="Password" value="<?php if (isset($row)) {
                                                                                                echo $row['Password'];
                                                                                            } ?>">
        </div>
        <div class="mb-3">
            <label for="CrewroleFID" class="form-label">Crewrole</label> <br>
            <select name="CrewroleFID" class="custom-select custom-select-lg mb-3">
                <?php while ($row3 = $result3->fetch_assoc()) { ?>
                    <option value="<?php echo $row3['CrewroleID']; ?>" <?php if ($row3['CrewroleID'] == $CrewroleID) { ?> selected <?php }; ?>><?php echo $row3['Rolename']; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="Shipname" class="form-label">Spaceshipname</label> <br>
            <select name="Shipname" class="custom-select custom-select-lg mb-3">
                <?php while ($row2 = $result2->fetch_assoc()) { ?>
                    <option value="<?php echo $row2['Shipname']; ?>" <?php if ($row2['Shipname'] == $Shipname) { ?> selected <?php }; ?>><?php echo $row2['Shipname']; ?></option>
                <?php } ?>
            </select>
        </div>
        <label for="CrewID"></label>
        <input type="text" class="form-control" id="CrewID" name="CrewID" value=<?php if (isset($row)) {
                                                                                    echo $row['CrewID'];
                                                                                } ?>>
        <button type=" submit" name="submit" class="btn btn-primary">Submit</button>
        <a href="fv_uebersicht.php" class="btn btn-danger">Zurück</a>
    </form>

</body>