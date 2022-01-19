<?php include('header.php'); ?>

<?php if (isset($_SESSION['message'])) { ?>
    <?php echo $_SESSION['message']; ?>
<?php } ?>

<?php $movies = $database->query("SELECT * from `movies`"); ?>

<?php if (mysqli_num_rows($movies) != 0) { ?>
    <table>
        <thead>
            <tr>
                <th>Poster</th>
                <th>Title</th>
                <th>Description</th>

                <?php if (isset($_SESSION['username'])) { ?>
                    <th>View</th>
                <?php } ?>

                <?php if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'premium') { ?>
                    <th>Download</th>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($movies as $movie) { ?>
                <tr>
                    <td class="td_poster">
                        <?php if (!empty($movie['poster'])) { ?>
                            <img src="posters/<?= $movie['poster']; ?>" alt="<?= $movie['title']; ?>">
                        <?php } ?>
                    </td>
                    <td class="td_title"><?php echo $movie['title']; ?></td>
                    <td><?php echo $movie['description']; ?></td>

                    <?php if (isset($_SESSION['username'])) { ?>
                        <td><a href="https://www.google.com/search?q=<?= $movie['title']; ?>">View</a></td>
                    <?php } ?>

                    <?php if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'premium') { ?>
                        <td><a href="https://www.google.com/search?q=<?= $movie['title']; ?>+download">Download</a></td>
                    <?php } ?>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } else { ?>
    <div class="message info">No movies were added.</div>
<?php } ?>

<?php include('footer.php'); ?>
