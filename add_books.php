<?php include('header.php'); ?>


<?php

if (!isset($_SESSION['admin_logged_in'])) {
    header('location: login.php');
    exit;
  }
  
?>
 
<body>
<?php include('side_bar.php'); ?>

<div id="main-content">
    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Reiciendis beatae ex vitae dolores distinctio at eius laudantium eum voluptate sed ad voluptatem perspiciatis alias expedita necessitatibus, obcaecati deserunt odio animi!</p>
    <div class="container mt-5">
    <form action="create_books.php" enctype="multipart/form-data" method="POST">
        <p class="text-center">
            <?php if (isset($_GET['error'])) {  ?>
                <p class="text-center text-danger"><?php echo $_GET['error']; ?></p>
            <?php } ?>
        </p>
        <p class="text-center">
            <?php if (isset($_GET['books_added'])) {  ?>
                <p class="text-center text-success"><?php echo $_GET['books_added']; ?></p>
            <?php } ?>
        </p>
        <div class="row">
            <div class="col-md-6 col-sm-12 my-2">
                <input type="text" class="form-control" placeholder="book title" aria-label="book title" name="title">
            </div>
            <div class="col-md-6 col-sm-12 my-2">
                <input type="text" class="form-control" placeholder="book description" aria-label="book description" name="description">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-12 my-2">
                <input type="text" class="form-control" placeholder="author" aria-label="author" name="author">
            </div>
            <div class="col-md-6 col-sm-12 my-2">
                <input type="file" class="form-control " placeholder="image" aria-label="image" name="image">
            </div>
        </div>
        <div class="row">
        <div class="col-md-6 col-sm-12 my-2">
                <input type="number" class="form-control " placeholder="no of copies" aria-label="" name="no_of_copies">
            </div>
        </div>
        <button type="submit" class="btn btn-primary" name="create_book">Submit</button>
    </form>
</div>


    <!-- =======================FOOTER======================= -->
    <div class="footer">
        &copy; <?php echo date('Y') ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>