<?php include('header.php'); ?>

<header>
    <h2>Register</h2>
</header>

<?php if (isset($_REQUEST['username'])) { ?>
    <?php
    $username = stripcslashes($_REQUEST['username']);
    $username = mysqli_real_escape_string($database, $username);
    $password = stripcslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($database, $password);
    $role = 'standard';
    ?>

    <?php if (mysqli_num_rows($database->query("SELECT * FROM `users` WHERE username='$username'")) == 0) { ?>
        <?php if ($database->query("INSERT into `users` (username, password, role) VALUES ('$username', '" . md5($password) . "', '$role')")) { ?>
            <?php $_SESSION['username'] = $username; ?>
            <?php header("Location: index.php"); ?>
        <?php } else { ?>
            <div class="message error">Registration failed. Try again.</div>
        <?php } ?>
    <?php } else { ?>
        <div class="message error">Username already exists. Try again.</div>
    <?php } ?>
<?php } ?>

<form action="" method="post" class="form_column">
    <div class="input_row">
        <input type="text" name="username" id="username" placeholder="Username" required>
    </div>

    <div class="input_row">
        <input type="password" name="password" id="password" placeholder="Password" required>
    </div>

    <div class="input_row">
        <input type="submit" value="Register">
    </div>
</form>

<?php include('footer.php'); ?>
