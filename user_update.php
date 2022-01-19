<?php include('header.php'); ?>

<?php
if (count($_POST) > 0) {
    if ($database->query("UPDATE `users` SET role='" . $_POST['role'] . "' WHERE id='" . $_POST['user'] . "'")) {
        header("Location: users.php");
    }
}
?>

<?php $user = mysqli_fetch_array($database->query("SELECT * FROM `users` WHERE id='" . $_GET['user'] . "'")); ?>

<header>
    <h2>Update User</h2>
</header>

<form action="" method="post">
    <input type="hidden" name="user" value="<?= $user['id']; ?>">
    <table>
        <thead>
            <tr>
                <th>Username</th>
                <th>Role</th>
                <th>Tools</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?= $user['username']; ?></td>
                <td>
                    <select name="role" id="role" class="input small">
                        <option value="premium" <?= ($user['role'] == 'premium') ? 'selected' : NULL ?>>Premium</option>
                        <option value="standard" <?= ($user['role'] == 'standard') ? 'selected' : NULL ?>>Standard</option>
                    </select>
                </td>
                <td>
                    <input type="submit" value="Save" class="button small">
                </td>
            </tr>
        </tbody>
    </table>
</form>

<?php include('footer.php'); ?>
