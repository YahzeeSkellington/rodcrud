<?php

include('database.php');

$database->query("DELETE FROM `movies` WHERE id='" . $_GET['id'] . "'");

header("Location: index.php");
