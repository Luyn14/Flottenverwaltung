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
    <title>Flottenverwaltung_Titelseite</title>
</head>

<body>
    <div class="container">
        <h1 class="text-center"> Flottenverwaltung </h1>
        <form method="POST" action="../Controller/login.php">

            <div class="row">
                <div class="col-3 col-xs-3 col-md-3 col-lg-3 col-xl-3">
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
                <div class="col-1 col-xs-3 col-md-3 col-lg-4 col-xl-6">
                    <h4>Willkommen zur Offizielen Flottenverwaltungs Webseite</h4>
                    <img src="..." class="card-img-top" alt="...">
                    <br><br><br><br><br><br><br>
                </div>

                <div class="col">
                    <div class="card" style="width: 18rem;">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                    <div class="card" style="width: 18rem;">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                    <div class="card" style="width: 18rem;">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
            </div>

    </div>


</body>

</html>