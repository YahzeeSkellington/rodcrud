<?php include('database.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies</title>
    <link rel="stylesheet" href="assets/style.css">
    <script src="assets/jquery-3.6.0.min.js"></script>
    <script src="assets/script.js"></script>
</head>
<body>
    <div class="wrapper">
        <header class="header_main">
            <div class="container">
                <div class="row">
                    <h1><a href="index.php">Movies</a></h1>
                    <nav class="nav_main">
                        <?php if (isset($_SESSION['username'])) { ?>
                            <div class="username">Welcome <strong><?= $_SESSION['username']; ?></strong></div>
                        <?php } ?>
                        <ul>
                            <?php if (isset($_SESSION['username'])) { ?>
                                <li><a href="index.php">Home</a></li>

                                <?php if ($_SESSION['role'] == 'admin') { ?>
                                    <li><a href="admin.php">Admin</a></li>
                                    <li><a href="users.php">Users</a></li>
                                <?php } ?>

                                <li><a href="logout.php">Logout</a></li>
                            <?php } else { ?>
                                <li><a href="login.php">Login</a></li>
                                <li><a href="register.php">Register</a></li>
                            <?php } ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </header>

        <main class="content_main">
            <div class="container">
