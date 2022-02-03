<?php
require('db-connect.php');

if (empty($_POST)) {
    header('Location: ../View/flottenverwaltung_Login.php');
}

class LoginController
{

    function login(string $username, string $password): bool
    {

        $sql = "SELECT * FROM tCrew JOIN tCrewRole ON tCrewRole.CrewroleID=tCrew.CrewroleFID WHERE Prename = '$username' AND Password = '$password';";
        global $conn;
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $_SESSION['Prename'] = $row['Prename'];
            $_SESSION['Lastname'] = $row['Lastname'];
            $_SESSION['CrewID'] = $row['CrewID'];
            $_SESSION['Rolename'] = $row['Rolename'];
            return true;
        } else {
            return false;
        }
    }
}


session_start();

$username = $_POST['username'];
$password = $_POST['password'];

$controller = new LoginController();

if ($controller->login($username, $password)) {
    $_SESSION['loggedIn'] = true;

    header('Location: ../View/flottenverwaltung_Login.php');
} else {
    $_SESSION['loginFailed'] = "Benutzername/Passwort falsch";

    header('Location: ../View/flottenverwaltung_Titelseite.php');
}
