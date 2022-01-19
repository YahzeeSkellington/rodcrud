<?php

include('database.php');

$database->query("DELETE FROM `users` WHERE id='" . $_GET['id'] . "'");

header("Location: users.php");
