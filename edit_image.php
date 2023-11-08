<?php include('header.php'); ?>

<?php

if (isset($_GET['id'])) {
    $book_id = $_GET['id'];
    $book_title = $_GET['book_title'];
} else {
    header('location:books.php');
}


$stmt = $conn->prepare("SELECT * FROM books WHERE id = ?");

$stmt->bind_param('i', $book_id);

$stmt->execute();

$edits = $stmt->get_result();
?>


<body>
    <?php include('side_bar.php'); ?>

    <div id="main-content">

        <h1 class="offset-3">EDIT IMAGE</h1>
        <div class="container mt-5">
            <?php foreach ($edits as $edit) { ?>
                <div class="main-row">
                    <div class="row">
                        <div class="col">
                            <div class="custom-card mb-4" style="background-color: #ffc0cb; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);">
                                <div class="custom-card-body">
                                    <p class="custom-card-text" style="display: flex; justify-content: center; align-items: center;">
                                        <img src="./assects/imgs/<?php echo $edit['image'] ?>" width="390" alt="" style="border-radius: 50%; box-shadow: 6px 4px 2px 1px rgba(220, 20, 60, 0.6);" class="details-image">
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col my-2">
                            <h2>THE IMAGE</h2>

                            <form id="image" enctype="multipart/form-data" method="POST" action="update_image.php">

                                <p class="text-center"><?php if (isset($_GET['error'])) {  ?></p>
                                <p class="text-center text-danger"><?php echo $_GET['error']; ?></p>
                            <?php } ?>


                            <input type="hidden" name="book_id" value="<?php echo $book_id;  ?>">
                            <input type="hidden" name="book_title" value="<?php echo $book_title;  ?>">

                            <div class="form-group mt-2">
                                <label for="">image1</label>
                                <input type="file" class="form-control" id="image1" name="image1" placeholder="image1" required>
                            </div>

                             <div class="form-group mt-2">

        <input type="submit" class="btn btn-primary" id="create_image" name="update_image" value="Update">
    </div>
                            </form>

                        </div>
                    </div>
                </div>
            <?php } ?>

        </div>
    </div>


</body>

<!-- =======================FOOTER======================= -->
<footer class="pt-2 mt-3 text-center border-top" id="main-content">
    &copy; <?php echo date('Y') ?>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>