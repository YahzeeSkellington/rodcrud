<?php include('header.php'); ?>

<?php if (isset($_POST['username'])) { ?>
    <?php
    $username = stripcslashes($_REQUEST['username']);
    $username = mysqli_real_escape_string($database, $username);
    $password = stripcslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($database, $password);
    ?>

    <?php $user_check = $database->query("SELECT * FROM `users` WHERE username='$username' AND password='" . md5($password) . "'"); ?>

    <?php if (mysqli_num_rows($user_check) == 1) { ?>
        <?php $user_data = mysqli_fetch_array($user_check); ?>
        <?php $_SESSION['username'] = $user_data['username']; ?>
        <?php $_SESSION['role'] = $user_data['role']; ?>
        <?php header("Location: index.php"); ?>
    <?php } else { ?>
        <?php header("Location: index.php"); ?>
    <?php } ?>
<?php } ?>

<header>
    <h2>Login</h2>
</header>

<form action="" method="post" class="form_column">
    <div class="input_row">
        <input type="text" name="username" id="username" placeholder="Username" required>
    </div>

    <div class="input_row">
        <input type="password" name="password" id="password" placeholder="Password" required>
    </div>

    <div class="input_row">
        <input type="submit" value="Login">
    </div>
</form>

<div class="message info small">Not registered yet? <a href="register.php">Register</a></div>

<?php include('footer.php'); ?>
