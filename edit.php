<?php include('header.php'); ?>

<?php if (count($_POST) > 0) { ?>
    <?php
    $title = $_REQUEST['title'];
    $description = $_REQUEST['description'];
    ?>

    <?php if (isset($_FILES['poster'])) { ?>
        <?php
        $poster = $_FILES['poster'];
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

            <?php $database->query("UPDATE `movies` SET poster='$poster_filename' WHERE id='" . $_GET['id'] . "'"); ?>
        <?php } ?>
    <?php } ?>


    <?php if ($database->query("UPDATE `movies` SET title='$title', description='$description' WHERE id='" . $_GET['id'] . "'")) { ?>
        <div class="message success">Movie successfuly updated.</div>
    <?php } ?>
<?php } ?>

<?php $movie = mysqli_fetch_array($database->query("SELECT * FROM `movies` WHERE id='" . $_GET['id'] . "'")); ?>

<header>
    <h2>Edit Movie</h2>
</header>

<form action="" method="post" enctype="multipart/form-data" class="form_column">
    <div class="input_row">
        <input type="text" name="title" id="title" placeholder="Title" required value="<?= $movie['title']; ?>">
    </div>

    <div class="input_row">
        <div class="input_poster">
            <img src="posters/<?= $movie['poster']; ?>" alt="<?= $movie['title']; ?>">
            <input type="file" name="poster" id="poster">
        </div>
    </div>

    <div class="input_row">
        <textarea name="description" id="description" placeholder="Description" required><?= $movie['description']; ?></textarea>
    </div>

    <div class="input_row">
        <div class="input_column">
            <input type="submit" value="Save">
            <a href="admin.php">Cancel</a>
        </div>
    </div>
</form>

<?php include('footer.php'); ?>
