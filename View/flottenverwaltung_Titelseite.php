<?php
require('../Controller/db-connect.php');
session_start();
if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']) {
    header('Location: flottenverwaltung_Login.php');
}

$sql = "SELECT * FROM tCrew";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="stylesheet.css">
    <title>Flottenverwaltung_Titelseite</title>
</head>

<body>
    <div class="container">
        <div class="container" id="loginT">
            <h1 id="text-underlay"> Flottenverwaltung </h1>
            <h4 id="text-underlay">Willkommen zur Offizielen Flottenverwaltungs Webseite</h4>
            <div class=" card" style="width: 25rem;" id="login">
                <div class="card-body">
                    <h5 class="card-title"><a href="fv_add-crew.php">Sign Up</a></h5>
                    <p class="card-text">Schon Angemeldet? Loggen sie sich ein.
                    <form method="POST" action="../Controller/login.php">
                        <div class="row">
                            <div class="col">
                                <h1> Login </h1>
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="username" class="form-control" id="username" name="username">
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password">
                                </div>

                                <?php
                                if (isset($_SESSION['loginFailed'])) {
                                    echo '<div class="mb-3"><span class="fw-bold text-danger">' . $_SESSION['loginFailed'] . '</span></div>';
                                    $_SESSION['loginFailed'] = null;
                                }
                                ?>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                    </p>
                </div>
            </div>
        </div>
    </div>


</body>

</html>