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
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero sed in nihil, natus recusandae similique qui accusantium quis eaque officiis cupiditate illo excepturi, reprehenderit odio tempora! Recusandae id totam sequi!</p>

    <div class="row my-4 py-2">
        <div class="col-md-4 admin">
            <div class="custom-card mb-4">
                <div class="custom-card-body">
                    <h5 class="custom-card-title">Products</h5>
                    <p class="custom-card-text">Manage your products here.</p>
                    <a href=" #" class=" btn confirm-button">View Products</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 admin">
            <div class="custom-card mb-4">
                <div class="custom-card-body">
                    <h5 class="custom-card-title">Orders</h5>
                    <p class="custom-card-text">View and manage customer orders.</p>
                    <a href="#" class="btn confirm-button ">View Orders</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 admin">
            <div class="custom-card mb-4">
                <div class="custom-card-body">
                    <h5 class="custom-card-title">Account</h5>
                    <p class="custom-card-text">View your account</p>
                    <a href="#" class="btn confirm-button ">View account</a>
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