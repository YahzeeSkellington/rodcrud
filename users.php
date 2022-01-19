<?php include('header.php'); ?>

<?php $users = $database->query("SELECT * FROM `users` WHERE role='standard' OR role='premium'"); ?>

<header>
    <h1>Users</h1>
</header>

<?php if (mysqli_num_rows($users) != 0) { ?>
    <table>
        <thead>
            <tr>
                <th>User</th>
                <th>Role</th>
                <th colspan="2">Tools</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user) { ?>
                <tr>
                    <td><?= $user['username']; ?></td>
                    <td><?= $user['role']; ?></td>
                    <td><a href="user_update.php?user=<?= $user['id']; ?>" class="button small">Update</a></td>
                    <td><a href="user_delete.php?user=<?= $user['id']; ?>" class="button small">Delete</a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } else { ?>
    <div class="message info">No users were found.</div>
<?php } ?>

<?php include('footer.php'); ?>
