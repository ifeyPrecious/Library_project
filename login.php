<?php
include('header.php');
include('./server/connection.php');


if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in']) {
    header('location:index.php');
    exit;
}

if (isset($_POST['login-btn'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $name = $_POST['name'];
 
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header('location: login.php?error=Invalid email format');
        exit();
    }

  
    $stmt = $conn->prepare("SELECT admin_id, admin_name, admin_email, admin_password FROM admin WHERE admin_email = ? AND admin_name = ? LIMIT 1");
    $stmt->bind_param('ss', $email, $name);

    if ($stmt->execute()) {
        $stmt->bind_result($admin_id, $admin_name, $admin_email, $admin_hashed_password);
        $stmt->store_result();

        if ($stmt->num_rows == 1) {
            $stmt->fetch();
       
            if (password_verify($password, $admin_hashed_password)) {
                $_SESSION['admin_id'] = $admin_id;
                $_SESSION['admin_name'] = $admin_name;
                $_SESSION['admin_email'] = $admin_email;
                $_SESSION['admin_logged_in'] = true;

                header('location: index.php?login_success=Logged in successfully');
                exit();
            } else {
                header('location: login.php?error=Incorrect password');
                exit();
            }
        } else {
            header('location: login.php?error=Email or name not found in the database');
            exit();
        }
    } else {
        header('location: login.php?error=Something went wrong');
        exit();
    }
}
?>


<body>

    <div id="main-content">
    <div class="navbar-brand ">
                <h2 class="">PRESH LIB</h2>
            </div>

        <h1 class=" offset-2">Admin Login</h1>
        <div class="container ">
            <form action="login.php" method="post">
                <p class="text-center"><?php if (isset($_GET['error'])) {  ?></p>
                <p class="text-center text-danger"><?php echo $_GET['error']; ?></p>
            <?php } ?>
     
        <div class="row ">
            <div class="col-md-6 my-2">
                <label for="inputPassword4" class="form-label ">Name</label>
                <input type="text" class="form-control" placeholder="name" aria-label="name" name="name">
            </div>
        </div>
        <div class="row ">
            <div class="col-md-6 my-2">
                <label for="inputEmail4" class="form-label">Email</label>
                <input type="text" class="form-control" placeholder="email" aria-label="email" name="email">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 my-2">
                <label for="inputPassword4" class="form-label">Password</label>
                <input type="text" class="form-control" placeholder="password" aria-label="password" name="password">
            </div>
        </div>

        <button type="submit" class="btn btn-primary" name="login-btn">Login</button>

            </form>
        </div>
    </div>



    <!-- =======================FOOTER======================= -->
    <div class="footer">
        &copy; <?php echo date('Y') ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>