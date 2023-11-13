<?php include('header.php'); ?>

<body>
    <!-- ================================Side bar =======================================-->
   <?php include('side_bar.php'); ?>

 
 <!--=========================== main=================================== -->
 <form action="">
<p class="text-center"><?php if (isset($_GET['login_success'])) {  ?></p>
            <p class="text-center text-success"><?php echo $_GET['login_success']; ?></p>
        <?php } ?>
</form>
 <main id="main-content">
    <h1>Welcome to presh Lib</h1>
    <p></p>

    <div class="row my-4 py-2">
        <div class="col-md-4 admin">
            <div class="custom-card mb-4">
                <div class="custom-card-body">
                    <h5 class="custom-card-title">Books</h5>
                    <p class="custom-card-text">See availabe books here.</p>
                    <a href="books.php" class=" btn confirm-button">View Books</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 admin">
            <div class="custom-card mb-4">
                <div class="custom-card-body">
                    <h5 class="custom-card-title">Members</h5>
                    <p class="custom-card-text">View your Members here</p>
                    <a href="user.php" class="btn confirm-button ">Members</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 admin">
            <div class="custom-card mb-4">
                <div class="custom-card-body">
                    <h5 class="custom-card-title">Available Copies</h5>
                    <p class="custom-card-text">View your available copies here </p>
                    <a href="copies.php" class="btn confirm-button ">Copies</a>
                </div>
            </div>
        </div>

    </div>
</main>







    <!-- =======================FOOTER======================= -->
    <footer class="pt-2 mt-3 text-center border-top" id="main-content">
        &copy;
        <?php echo date('Y') ?>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>