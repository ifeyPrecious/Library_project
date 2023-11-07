<?php include('header.php'); ?>
<?php 
if (isset($_POST['book_btn']) && isset($_POST['book_id'])) {
    // GET THE BOOK ID
    $book_id = $_POST['book_id']; 

    // Connect to the database

    $stmt = $conn->prepare("SELECT * FROM books WHERE id = ?");

    $stmt->bind_param('i', $book_id);

    $stmt->execute();

    $book_details = $stmt->get_result();

} else {
    header('location:books.php');
    exit;
}
?>

<body>
<?php include('side_bar.php'); ?>

<div id="main-content">
   
    <h1 class="offset-3">The Book Details</h1>
    <div class="container mt-5">
        <?php foreach($book_details as $detail) { ?>
            <div class="main-row">
                <div class="row">
                    <div class="col">
                        <div class="custom-card mb-4" style="background-color: #ffc0cb; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);">
                            <div class="custom-card-body">
                                <p class="custom-card-text" style="display: flex; justify-content: center; align-items: center;">
                                    <img src="./assects/imgs/<?php echo $detail['image'] ?>" width="390" alt="" style="border-radius: 50%; box-shadow: 6px 4px 2px 1px rgba(220, 20, 60, 0.6);" class="details-image">
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col my-2">
                    <h2>Book title</h2>
                        <p class="form-control-static" aria-label="book title">
                         
                            <?php echo $detail['book_title'] ?>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col my-2">
                    <h2>Book description</h2>
                        <p class="form-control-static" aria-label="book description">
                       
                            <?php echo $detail['book_description'] ?>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col my-2">
                    <h2>Author</h2>
                        <p class="form-control-static" aria-label="author">
                         
                            <?php echo $detail['author'] ?>
                        </p>
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
