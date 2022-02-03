<?php

session_start();
session_destroy();

header('Location: ../View/flottenverwaltung_Titelseite.php');
