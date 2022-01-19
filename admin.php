<?php include('header.php'); ?>

<?php if (isset($_REQUEST['title'])) { ?>
    <?php
    $title = $_REQUEST['title'];
    $poster = $_FILES['poster'];
    $description = $_REQUEST['description'];

    $poster_directory = "posters/";
    $poster_filename = time() . "_" . basename($poster['name']);
    $poster_target_path = $poster_directory . $poster_filename;
    $poster_extension = pathinfo($poster_target_path, PATHINFO_EXTENSION);
    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
    ?>

    <?php if (in_array($poster_extension, $allowed_extensions)) { ?>
        <?php if (!move_uploaded_file($poster['tmp_name'], $poster_target_path)) { ?>
            <div class="message error">Failed tp upload image.</div>
        <?php } ?>
    <?php } ?>

    <?php if ($database->query("INSERT INTO `movies` (title, poster, description) VALUES ('$title', '$poster_filename', '$description')")) { ?>
        <div class="message success">Movie successfuly added.</div>
    <?php } ?>
<?php } ?>

<section>
    <header>
        <h2>Add Movie</h2>
    </header>

    <form action="" method="post" enctype="multipart/form-data" class="form_column">
        <div class="input_row">
            <input type="text" name="title" id="title" placeholder="Title" required>
        </div>

        <div class="input_row">
            <input type="file" name="poster" id="poster">
        </div>

        <div class="input_row">
            <textarea name="description" id="description" placeholder="Description" required></textarea>
        </div>

        <div class="input_row">
            <input type="submit" value="Add">
        </div>
    </form>
</section>

<section>
    <header>
        <h2>Search Movies</h2>
    </header>

    <form action="" method="post" class="form_column">
        <div class="input_row">
            <input type="search" name="search" id="search" value="<?= $_POST['search']; ?>">
        </div>

        <div class="input_row">
            <input type="submit" value="Search">
        </div>
    </form>
</section>


<?php if (isset($_REQUEST['search'])) { ?>
    <?php $movies = $database->query("SELECT * FROM `movies` WHERE title='" . $_REQUEST['search'] . "'"); ?>
<?php } else { ?>
    <?php $movies = $database->query("SELECT * FROM `movies`"); ?>
<?php } ?>

<section>
    <header>
        <h2>Movies Added</h2>
    </header>

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

                    <?php if ($_SESSION['role'] == 'admin') { ?>
                        <th colspan="2">Tools</th>
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
                            <td><a href="">View</a></td>
                        <?php } ?>

                        <?php if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'premium') { ?>
                            <td><a href="">Download</a></td>
                        <?php } ?>

                        <?php if ($_SESSION['role'] == 'admin') { ?>
                            <td><a href="edit.php?id=<?= $movie['id']; ?>" class="button small">Edit</a></td>
                            <td><a href="delete.php?id=<?= $movie['id']; ?>" class="button small">Delete</a></td>
                        <?php } ?>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <div class="message info">No movies were added/found.</div>
    <?php } ?>
</section>


<?php include('footer.php'); ?>
