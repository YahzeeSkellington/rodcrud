<?php
session_start();

$database = new mysqli('localhost', 'yahzee', 'secret', 'rodcrud');

if ($database->connect_errno) {
    print_r("Connection failed!");
}
/*
if ($database->query("SELECT * FROM `users` WHERE role='admin'") === false) {
    header("Location: install.php");
}

*/
