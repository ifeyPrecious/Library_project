<?php include('header.php'); ?>

<?php
if (isset($_GET['id'])) {
    $book_id = $_GET['id'];


    $stmt = $conn->prepare("SELECT * FROM books WHERE id = ?");
    $stmt->bind_param('i', $book_id);
    $stmt->execute();
    $books = $stmt->get_result(); //[]

} elseif (isset($_POST['edit_btn'])) {
    $book_id = $_POST['book_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $author = $_POST['author'];

    $stmt = $conn->prepare("UPDATE books SET book_title = ?, book_description = ?, author = ? WHERE id = ?");

    $stmt->bind_param('sssi', $title, $description, $author, $book_id);

    if ($stmt->execute()) {
        header('Location: books.php?edit_success_message=Books has been updated successfully');
        exit;
    } else {
        header('Location: books.php?edit_error_message=Something went wrong, try again');
        exit;
    }
} else {
    header('books.php');
}

?>





<body>
    <?php include('side_bar.php'); ?>

    <div id="main-content">
        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Reiciendis beatae ex vitae dolores distinctio at eius laudantium eum voluptate sed ad voluptatem perspiciatis alias expedita necessitatibus, obcaecati deserunt odio animi!</p>
        <div class="container mt-5">
            <form action="edit_books.php"   method="POST">
                <p class="text-center">
                 

            </p>


            <?php if (!empty($books)) { // Check if $books is not empty before using foreach loop 
            ?>
                <?php foreach ($books as $book) { ?>
                    <input type="hidden" name="book_id" value="<?php echo $book['id']; ?>">
                    <div class="main-row">
                        <div class="row">
                            <div class="col ">
                                <input type="text" class="form-control" placeholder="book title" aria-label="book title" name="title" value="<?php echo $book['book_title']  ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col ">
                                <input type="text" class="form-control" placeholder="book description" aria-label="book description" name="description" value="<?php echo $book['book_description'] ?>">
                            </div>

                        </div>
                        <div class="row">
                            <div class="col ">
                                <input type="text" class="form-control" placeholder="author" aria-label="author" name="author" value="<?php echo $book['author'] ?>">
                            </div>
                        </div>
                    </div>
        </div>
        <input type="submit" class="btn btn-primary" name="edit_btn" value="Edit book">
        </form>
    </div>

<?php  } ?>
<?php  } ?>


<!-- =======================FOOTER======================= -->
<div class="footer">
    &copy; <?php echo date('Y') ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>