<?php include('database.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="assets/style.css">
    <script src="assets/jquery-3.6.0.min.js"></script>
    <script src="assets/script.js"></script>
</head>
<body>
    <div class="wrapper">
        <main class="content_main">
            <div class="container">
                <header>
                    <h1>Install Application</h1>
                </header>

                <?php
                $table_users = "CREATE TABLE IF NOT EXISTS `users` (
                    `id` int(11) NOT NULL AUTO_INCREMENT,
                    `username` varchar(100) NOT NULL UNIQUE,
                    `password` varchar(100) NOT NULL,
                    `role` varchar(100) NOT NULL,
                    PRIMARY KEY (`id`))";

                $table_movies = "CREATE TABLE IF NOT EXISTS `movies` (
                    `id` int(11) NOT NULL AUTO_INCREMENT,
                    `title` varchar(100) NOT NULL,
                    `poster` varchar(150),
                    `description` varchar(150) NOT NULL,
                    PRIMARY KEY (`id`))";
                ?>

                <?php $movies = $database->query($table_movies); ?>

                <?php $users = $database->query($table_users); ?>

                <?php if (mysqli_num_rows($database->query("SELECT * FROM `users` WHERE role='admin'")) == 0) { ?>
                    <?php if (isset($_REQUEST['username'])) { ?>
                        <?php
                        $username = stripcslashes($_REQUEST['username']);
                        $username = mysqli_real_escape_string($database, $username);
                        $password = stripcslashes($_REQUEST['password']);
                        $password = mysqli_real_escape_string($database, $password);
                        $role = 'admin';
                        ?>

                        <?php if ($database->query("INSERT into `users` (username, password, role) VALUES ('$username', '" . md5($password) . "', '$role')")) { ?>
                            <?php $_SESSION['username'] = $username; ?>
                            <?php $_SESSION['role'] = $role; ?>
                            <?php header("Location: index.php"); ?>
                        <?php } ?>
                    <?php } ?>

                    <header>
                        <h2>Create Admin Account</h2>
                    </header>

                    <form action="" method="post" class="form_column">
                        <div class="input_row">
                            <input type="text" name="username" id="username" placeholder="Username">
                        </div>

                        <div class="input_row">
                            <input type="password" name="password" id="password" placeholder="Password">
                        </div>

                        <div class="input_row">
                            <input type="submit" value="Register">
                        </div>
                    </form>
                <?php } else { ?>
                    <?php header("Location: index.php"); ?>
                <?php } ?>
            </div>
        </main>
    </div>
</body>
</html>
