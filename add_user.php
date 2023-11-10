<?php
include('header.php');

$length = 9;

function randomNumber($length) {
    $number = '';
    
    for ($i = 0; $i < $length; $i++) {
        $number .= random_int(0, 5);
    }

    return $number;
}

if (!isset($_SESSION['admin_logged_in'])) {
    header('location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_user'])) {
    $username = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $number = $_POST['number'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];

    $stmt = $conn->prepare("INSERT INTO users (user_name, user_password, user_email, user_number, user_gender, user_address, member_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('sssssss', $username, $password, $email, $number, $gender, $address, $member_id);

    if ($stmt->execute()) {
        // Get the ID of the newly inserted user
        $user_id = mysqli_insert_id($conn);

        // Generate and update MEMBER_ID for the user
        $member_id = 'user-' . randomNumber($length);

        // Update the user with the generated MEMBER_ID
        $stmt2 = $conn->prepare("UPDATE users SET member_id = ? WHERE user_id = ?");
        $stmt2->bind_param('ss', $member_id, $user_id);
        $stmt2->execute();

        header('location:user.php?user_added=This user has been added successfully');
    } else {
        header('location:user.php?failed=Error occurred, try again');
    }
}
?>

  


<body>
    <?php include('side_bar.php'); ?>

    <div id="main-content">
        <h1 class="text-center">Add new user</h1>
        <div class="container mt-5">
            <form action="" enctype="multipart/form-data" method="POST">
                <p class="text-center">
                    <?php if (isset($_GET['failed'])) {  ?>
                <p class="text-center text-danger"><?php echo $_GET['error']; ?></p>
            <?php } ?>
            </p>
            <p class="text-center">
                <?php if (isset($_GET['user_added'])) {  ?>
            <p class="text-center text-success"><?php echo $_GET['user_added']; ?></p>
        <?php } ?>
        </p>
        <div class="row">
            <div class="col-md-6 col-sm-12 my-2">
                <input type="text" class="form-control" placeholder="username" aria-label="username" name="name">
            </div>
            <div class="col-md-6 col-sm-12 my-2">
                <input type="text" class="form-control" placeholder="password" aria-label="password" name="password">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-12 my-2">
                <input type="text" class="form-control" placeholder="email" aria-label="email" name="email">
            </div>
            <div class="col-md-6 col-sm-12 my-2">
                <input type="text" class="form-control " placeholder="number" aria-label="number" name="number">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-12 my-2">
                <input type="text" class="form-control " placeholder="address" aria-label="address" name="address">
            </div>
            <div class="col-md-6 col-sm-12 my-2">
            <select name="gender" id="user_gender"  >
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
            </div>
            <!-- 
            <div class="col-md-6 col-sm-12 my-2">
                <input type="file" class="form-control " placeholder="image" aria-label="image" name="image">
            </div> -->
        </div>

        <button type="submit" class="btn btn-primary" name="add_user">Submit</button>
            </form>
        </div>




        <!-- =======================FOOTER======================= -->
        <div class="footer">
            &copy; <?php echo date('Y') ?>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>